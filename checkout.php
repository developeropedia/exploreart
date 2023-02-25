<?php

include "includes/header.php";

?>


    <main>
        <div class="container-fluid mt-3">
            <form action="" class="row">
                <div class="col-lg-8 mb-3 ">
                    
                    <div  class="form-reg">
                            <h1 class="f-16 w-600 text-golden">Purchase Credits - <span class="f-25 mb-0">500</span></h1>
                        <hr class="border">
                        <div class="mb-3">
                            <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">Name on Record</label>
                            <input type="text" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">CheckMarket</label>
                            <input type="email" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">Address</label>
                            <input type="password" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address 1">
                            <input type="password" class="form-control sign-input mt-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address 2 (Optional)">
                          </div>
                          <div class="d-flex">
                            <div class="mb-3 me-2">
                                <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">Postal Code</label>
                                <input type="email" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                              </div>
                              <div class="mb-3 w-100">
                                <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">City</label>
                                <input type="email" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                              </div>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1 " class="form-label text-gray f-14 w-500 ">Country</label>
                            <input type="text" class="form-control sign-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                          </div>
                          <!-- <div class="d-flex justify-content-end">
                            <a href="index.html"><button class="sign-btn">Create</button></a>
                        </div> -->
                    </div>

                </div>
                <div class="col-lg-4  mb-3">
                    <div class="form-reg">
                        <h1 class="f-16 w-600 text-golden">Order Summary</h1>
                        <hr class="border">
                        <div class="data-row">
                            <div class="d-flex align-items-center justify-content-between">

                                <p class="f-14 w-400 ms-2 text-gray">
                                    SubTotal
                                </p>
                                <p class="f-14 w-500 ms-2 text-gray">
                                    $529.00
                                </p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">

                                <p class="f-14 w-400 ms-2 mb-0 pb-0 text-gray">
                                    Standrad Shipping
                                </p>
                                <p class="f-14 w-500 ms-2 mb-0 pb-0 text-gray">
                                    $71.00
                                </p>
                            </div>
                        </div>
                        <hr class="border">
                        <div class="data-row">
                            <div class="d-flex align-items-center justify-content-between">

                                <p class="f-20 w-600 ms-2 mb-0 pb-0 text-gray">
                                    Total
                                </p>
                                <p class="f-20 w-600 ms-2  mb-0 pb-0 text-gray">
                                    $529.00
                                </p>
                            </div>

                        </div>
                       
                        <a href=""><button class="cart-btn mt-3">Checkout $5493</button></a>
                    </div>

                </div>
            </form>


        </div>
    </main>

<?php

include "includes/footer.php";

?>