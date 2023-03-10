<?php

include "includes/header.php";

require_once('vendor/autoload.php');

$user = findById("users", $_SESSION['user']);
$subscription = findByQuery("SELECT * FROM subscriptions WHERE user_id = {$user->id} AND status = 1");
$plan = findById("plans", $subscription->plan_id);

// Set your API key
\Stripe\Stripe::setApiKey(SECRET_KEY);

// Retrieve the subscription ID from your database
$subscription_id = $subscription->subscription_id;

try {
    // Retrieve the subscription object
    $subscription = \Stripe\Subscription::retrieve($subscription_id);

    // Cancel the subscription
    $canceled_subscription = $subscription->cancel();

    update("subscriptions", ['status' => 0], "subscription_id", $subscription->id);

} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Handle the error
    $error = 'Error: ' . $e->getMessage();
}

?>


    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <?php if(isset($error) && !empty($error)): ?>
                    <p class="text-center text-golden fw-bold"><?php echo $error ?></p>
                <?php else: ?>
                    <div class="col-lg-12 text-center text-white my-3">
                        <h1 class="f-32 w-700 text-golden">
                            Plan Canceled!
                        </h1>
                        <p class="f-20 w-600 text-gray">Your plan was canceled! Subscribe to a plan to purchase art.</p>
                    </div>
                <?php endif; ?>
            </div>


        </div>
    </main>

<?php

include "includes/footer.php";

?>