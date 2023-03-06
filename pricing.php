<?php

include "includes/header.php";

$plans = findAll("plans");

?>


    <main>
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-12 text-center text-white my-3">
                    <h1 class="f-20 w-700 text-golden">
                        Simple And Flexible Pricing
                    </h1>
                    <p class="f-14 w-600 text-gray">Change or cancel your plan anytime</p>
                </div>
                  <?php if(!empty($plans)): ?>
                  <?php foreach ($plans as $plan): ?>
                      <div class="col-lg-4 mb-3 mx-auto">
                          <div class="pricing-card">
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
                              <p class="text-golden f-16 w-500 mt-2 text-center">Start in minutes</p>
                              <hr class="border">
                              <p class="text-white text-center f-16 w-500 "><b><?php echo $plan->credits ?></b> Credits</p>
                              <p class="text-white text-center f-16 w-500 ">Email Support</p>
                              <p class="text-white text-center f-16 w-500 ">Access to all features</p>
                              <hr class="border">

                              <div class="d-flex justify-content-center">
                                  <a href="<?php echo isset($_SESSION['user']) ? 'payment.php?id=' . $plan->id : 'signup.php' ?>"><button class="cart-btn2 fw-bold">BUY</button></a>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
            </div>


        </div>
    </main>

<?php

include "includes/footer.php";

?>