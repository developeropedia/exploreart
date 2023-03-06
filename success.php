<?php

include "includes/header.php";


require_once('vendor/autoload.php'); // require Stripe library

$stripe = new \Stripe\StripeClient(SECRET_KEY); //initialize Stripe with secret key
\Stripe\Stripe::setApiKey(SECRET_KEY);


if (isset($_POST['stripeToken'])) { // check if form is submitted
    $user = findById("users", $_SESSION['user']);
    $plan = findById("plans", $_POST['plan_id']);

    $errors = array();
    $token = $_POST['stripeToken'];

    if (empty($errors)) {
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
//                    'source' => $token,
                ]);
                $customer_id = $customer->id;
            } catch (Exception $e) {
                $error = $e->getMessage();
                // handle errors
            }
        }

        if (!isset($error)) {
            $planId = $plan->id;
            // Check if the plan exists
            try {
                $plan = \Stripe\Plan::retrieve($planId);
            } catch (Exception $e) {
                // If the plan does not exist, create it
                $plan = \Stripe\Plan::create([
//                    'id' => $planId,
                    'amount' => $plan->price * 100, // amount in cents
                    'currency' => 'usd',
                    'interval' => 'month',
                    'product' => [
                        'name' => $plan->name,
                    ],
                ]);
            }

            try {
                $subscription = $stripe->subscriptions->create(array(
                    "customer" => $customer_id,
                    "items" => array(
                        array(
                            "plan" => $plan,
                        ),
                    ),
                    'payment_behavior' => 'default_incomplete',
                    'collection_method' => 'charge_automatically',
                ));
                $subscription_id = $subscription->id;

                var_dump($subscription);

            } catch (Exception $e) {
                $error = $e->getMessage();
                // handle errors
            }
        }
        if(isset($error)) {
            echo "Error: " . $error;
        }
    } else {
        echo "Error: <br>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

?>


    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12 text-center text-white my-3">
                    <h1 class="f-20 w-700 text-golden">
                        Simple And Flexible Pricing
                    </h1>
                    <p class="f-14 w-600 text-gray">Change or cancel your plan anytime</p>
                </div>
                <div class="col-lg-6 mx-auto">

                </div>
            </div>


        </div>
    </main>

<?php

include "includes/footer.php";

?>