<?php

include "includes/header.php";

$plan = findByQuery("SELECT * FROM subscriptions s INNER JOIN plans p ON p.id = s.plan_id WHERE s.user_id = {$_SESSION['user']} AND status = 1");

?>


    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12 text-center text-white my-3">
                    <h1 class="f-20 w-700 text-golden">
                        My Plan
                    </h1>
                    <p class="f-14 w-600 text-gray">Change or cancel your plan</p>
                </div>
                <?php if(!empty($plan)): ?>
                    <div class="col-lg-6 mx-auto">
                        <form action="pricing.php" id="subscription-form" method="post" class="form-reg">
                            <div class="d-flex justify-content-center align-items-center  flex-wrap">

                            </div>

                            <div>
                                <?php echo $msg ?? "" ?>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="f-18 w-300 text-white m-0 p-0 font-rubika">
                                    <?php echo $plan->name ?>
                                </h1>
                                <?php if($plan->bonus !== 0): ?>
                                    <h1 class="f-14 w-500 text-white m-0 p-0 card-tag ">
                                        <?php echo $plan->bonus ?>% Bonus
                                    </h1>
                                <?php endif; ?>
                            </div>
                            <hr class="border">
                            <div class="d-flex align-content-end justify-content-center">
                                <div class="d-flex justify-content-center align-items-end text-white font-rubika">
                                    <h1 class="f-25 w-300  m-0 p-0 me-1 mb-1">$</h1>
                                    <?php $price = explode(".", strval($plan->price)) ?>
                                    <h1 class="f-35 w-300  m-0 p-0"><?php echo $price[0] ?>.</h1>
                                    <h1 class="f-30 w-300  m-0 p-0"><?php echo $price[1] ?></h1>
                                </div>
                                <div class="d-flex justify-content-center  align-items-end text-white mb-1">
                                    <h1 class="f-20 w-500   m-0 p-0  text-gray">/</h1>
                                    <h1 class="f-20 w-500   m-0 p-0 text-gray">Month</h1>
                                </div>

                            </div>
                            <hr class="border">
                            <p class="text-white text-center f-16 w-500 "><b><?php echo $plan->credits ?></b> Credits</p>
                            <p class="text-white text-center f-16 w-500 ">Email Support</p>
                            <p class="text-white text-center f-16 w-500 ">Access to all features</p>
                            <hr class="border">

                            <div class="d-flex justify-content-center">
                                <button type="button" onclick="window.location.href = 'pricing.php'" class="sign-btn fw-bold">Change</button>
                                <button type="button" data-bs-target="#purchaseModal" data-bs-toggle="modal" class="sign-btn fw-bold">Cancel</button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="col-lg-6 mx-auto">
                        <form action="pricing.php" id="subscription-form" method="post" class="form-reg">
                            <p class="text-golden fw-bold text-center">You don't have any active plan! Purchase a plan here.</p>

                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="sign-btn fw-bold">Purchase Plan</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>


        </div>
    </main>

<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body d-flex justify-content-center">
                <div class="modal-body-content">
                    <div class="container-fluid p-0 m-0">
                        <div class="row p-0 m-0">
                            <p class="mb-0 pb-0 text-white d-flex justify-content-end" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                            </p>

                            <div class="col-lg-12">
                                <p class="text-golden text-center fw-bold f-20" id="purchase-text">Are you sure you want to cancel this plan</p>
                                <div class="d-flex justify-content-center">
                                    <img src="assets/images/cancel.svg" width="100" class="img-fluid" id="purchase-img" alt="">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="no-decoration" onclick="window.location.href = 'cancel.php'" data-confirm-id="1"><button class="slide-btn mt-4 mb-2" id="slider-purchase-btn"> <i class="bi bi-bag-x me-2"></i>Confirm</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include "includes/footer.php";

?>
