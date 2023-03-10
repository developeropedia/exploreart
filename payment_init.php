<?php

// Include the function file
require_once "includes/functions.php";


require_once('vendor/autoload.php'); // require Stripe library

$stripe = new \Stripe\StripeClient(SECRET_KEY); //initialize Stripe with secret key
\Stripe\Stripe::setApiKey(SECRET_KEY);


if (isset($_POST['request_type'])) {
    $request_type = $_POST['request_type'];

    if($request_type == 'subscription') {
        $user = findById("users", $_SESSION['user']);
        $planDb = findById("plans", $_POST['planID']);

        $errors = array();
        $token = $_POST['token'];

        $customer_id = $user->customer_id;
        $customer = "";

        if(!empty($customer_id)) {
            try {
                $customer = \Stripe\Customer::retrieve(
                    $customer_id,
                    []
                );
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }
        }

        if(!isset($customer) || empty($customer)) {
            try {
                $customer = $stripe->customers->create([
                    'name' => $user->first_name . $user->last_name,
                    'email' => $user->email,
                    'source' => $token,
                ]);
                $customer_id = $customer->id;

                update("users", ['customer_id' => $customer_id], "id", $_SESSION['user']);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo json_encode(['error' => $error]);
                // handle errors
            }
        }

        if (!isset($error)) {
            $planId = $planDb->plan_id;
            // Check if the plan exists
            try {
                $plan = \Stripe\Plan::retrieve($planId);
            } catch (Exception $e) {
                try {
                    // If the plan does not exist, create it
                    $plan = \Stripe\Plan::create([
//                    'id' => $planId,
                        'amount' => $planDb->price * 100, // amount in cents
                        'currency' => 'usd',
                        'interval' => 'month',
                        'product' => [
                            'name' => $planDb->name,
                        ],
                    ]);

                    update("plans", ['plan_id' => $plan->id], "id", $planDb->id);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo json_encode(['error' => $error]);
                }
            }

            if(!isset($error)) {
                try {
                    $subscription = $stripe->subscriptions->create(array(
                        "customer" => $customer_id,
                        "items" => array(
                            array(
                                "plan" => $plan,
                            ),
                        ),
                        'payment_behavior' => 'default_incomplete',
                        'expand' => ['latest_invoice.payment_intent'],
                        'collection_method' => 'charge_automatically',
                    ));

//                    echo json_encode(['sub' => $subscription]);

                    if($subscription) {
                        update("users", ['customer_id' => $customer->id, 'subscription_id' => $subscription->id], 'id', $_SESSION['user']);

                        $output = [
                            'subscriptionId' => $subscription->id,
                            'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                            'customerId' => $customer->id
                        ];

                        echo json_encode($output);
                    }

                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo json_encode(['error' => $error]);
                    // handle errors
                }
            }
        }
        if(isset($error)) {
            echo json_encode(['error' => $error]);
        }
    }


    if($request_type == "process_payment") {
        $subscriptionId = $_POST['subscriptionId'];
        $customerId = $_POST['customerId'];
        $payment_intent = $_POST['payment_intent'];
        $plan = findById("plans", $_POST['planID']);
        $user = findById("users", $_SESSION['user']);

        if(!empty($payment_intent) && $payment_intent['status'] == 'succeeded') {
            $payment_id = insert("subscriptions",
                [
                    'user_id' => $_SESSION['user'],
                    'plan_id' => $plan->id,
                    'subscription_id' => $subscriptionId,
                    'customer_id' => $customerId,
                    'payment_intent_id' => $payment_intent['id'],
                    'status' => 1
                ]);

            $userCredits = $plan->credits + (($plan->credits / 100) * $plan->bonus);
            update("users", ['subscription_id' => $subscriptionId, 'credits' => $userCredits], "id", $_SESSION['user']);

            echo json_encode(['payment_id' => base64_encode($payment_id)]);
        } else {
            echo json_encode(['error' => "Payment failed, Try again later!"]);
        }
    }
}

?>