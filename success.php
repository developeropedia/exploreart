<?php

include "includes/header.php";

if(!isset($_GET['id'])) {
    redirect("index.php");
}

$subscription = findById("subscriptions", base64_decode($_GET['id']));
$plan = findById("plans", $subscription->plan_id);

?>


    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12 text-center text-white my-3">
                    <h1 class="f-32 w-700 text-golden">
                        Thank You!
                    </h1>
                    <p class="f-20 w-600 text-gray">You have subscribed to <span class="text-golden"><?php echo $plan->name ?></span> plan</p>
                    <p class="f-20 w-600 text-gray">You have received <span class="text-golden"><?php echo $plan->credits + (($plan->credits / 100) * $plan->bonus) ?> credits</span> at the rate of
                        <span class="text-golden">$<?php echo $plan->price ?>/Month</span>
                    </p>
                </div>
                <div class="col-lg-6 mx-auto">

                </div>
            </div>


        </div>
    </main>

<?php

include "includes/footer.php";

?>