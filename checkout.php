<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- =====================================style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body class="form-body">
<header>
    <nav class="navbar   navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <div>
                <a class="navbar-brand2" href="index">
                    <img src="assets/images/logo.svg" alt="" class="img-fluid">
                </a>
                <!-- <a class="navbar-brand" href="index.html">
                    <img src="assets/images/logo-light.svg" alt="" class="img-fluid">
                </a> -->
                <div class="d-flex align-items-center navbar-brand">
                    <img src="assets/images/logo.svg" alt="" class="img-fluid me-2" style="width: 25px;">
                    <a class="navbar-brand " href="index.html">
                        <h1 class="m-0 p-0 f-20 w-700 text-golden">Explore Art</h1>
                    </a>
                </div>
            </div>

            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="  d-flex align-items-center ">
                <form class="d-flex mx-auto ">
                    <div class="search-input mx-auto">
                        <i class="bi bi-search"></i>
                        <input class="search-input--input me-2 mx-auto" type="search" placeholder="Search">
                    </div>

                </form>

            </div>
            <div class=" d-flex align-items-center ">


                <div class="ms-auto me-1">

                    <div class="dropdown">
                        <a class="btn btn-secondary " href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-bounding-box user-btn"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="privacy-policy.html"><i
                                            class="bi bi-shield me-1"></i> Privacy
                                    Policy</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-question-square me-1"></i> Request
                                    Help</a></li>
                            <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-shield-fill-check me-1"></i> Terms
                                    of services</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-briefcase me-1"></i> Jobs</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cash-coin me-1"></i> Pricing</a> -->
                            </li>
                            <li><a class="dropdown-item" href="sign-in.html"><i
                                            class="bi bi-box-arrow-right me-1"></i> Log
                                    In</a></li>
                        </ul>
                    </div>
                </div>
                <div class="btn-cart">
                    <a class="btn btn-secondary " href="cart.php">
                        <i class="bi bi-bag user-btn"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>


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
<footer>
    <div class="text-center f-14 w-500 text-white d-flex justify-content-center align-items-center">
        Copyright @2023
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="slide-arrow">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <div class="modal-body-content">
                    <div class="container-fluid p-0 m-0">
                        <div class="row p-0 m-0">
                            <div class="small-caption">

                                <div class="slide-img-text">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center ">
                                            <div class="caption-logo me-2 ">
                                                Ai
                                            </div>
                                            <a href="profile.html"
                                               class="m-0 p-0 f-16 w-500 text-white no-decoration">Caption</a>

                                        </div>
                                        <p class="mb-0 pb-0 text-white" data-bs-dismiss="modal">
                                            <i class="bi bi-x-lg"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 ">

                                <div class="lightbox-images">
                                    <img src="assets/images/15.jpeg" alt="" class="">
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex flex-column justify-content-between align-items-stretch">
                                <div>
                                    <div class="lg-caption">
                                        <div class="d-flex justify-content-end  text-white">
                                            <p class="mb-0 pb-0 text-white" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i>
                                            </p>
                                        </div>
                                        <div class="slide-img-text">
                                            <div class="d-flex align-items-center">
                                                <div class="caption-logo me-2">
                                                    Ai
                                                </div>
                                                <a href="profile.html"
                                                   class="m-0 p-0 f-16 w-500 text-white no-decoration">Caption</a>
                                            </div>
                                        </div>
                                    </div>

                                    <h1 class="m-0 p-0 f-25 w-600 text-white py-3">
                                        Analog style
                                    </h1>

                                    <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Price</h2>
                                    <p class="mb-0 pb-0 f-20 w-500 text-white">
                                        $1000
                                    </p>
                                    <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Description Heading</h2>

                                    <p class="mb-0 pb-0 f-12 w-500 text-white">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae architecto
                                        maiores placeat ipsum odio quis suscipit voluptatem sit in eveniet optio
                                        rerum doloremque natus obcaecati at nobis, enim facere ex.
                                    </p>
                                </div>

                                <div>
                                    <button class="slide-btn mt-4 mb-2"> <i class="bi bi-bag me-2"></i> Add to
                                        Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="slide-arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script> -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script src="assets/app.js"></script>

</body>

</html>