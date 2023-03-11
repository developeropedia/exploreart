<?php

include_once "includes/functions.php";

if(isset($_SESSION['user'])) {
    $user = findById("users", $_SESSION['user']);
}

const PAGES = ['index.php', 'profile.php', 'collection.php'];

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
    <title><?php echo getSettings("title") ?></title>
</head>

<body>
<header>
    <nav class="navbar   navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <div>
                <a class="navbar-brand2" href="index.php">
                    <img src="assets/images/<?php echo getSettings("logo") ?>" alt="" class="img-fluid">
                </a>
                <div class="d-flex align-items-center navbar-brand">
                    <img src="assets/images/<?php echo getSettings("logo") ?>" alt="" class="img-fluid me-2" style="width: 25px;">
                    <a class="navbar-brand " href="index.php">
                        <h1 class="m-0 p-0 f-20 w-700 text-golden"><?php echo getSettings("title") ?></h1>
                    </a>
                </div>
            </div>
            <?php
            if (isset($PAGE) && $PAGE == 'shop') {
                $action = 'shop.php';
            } else if (!in_array(basename($_SERVER['PHP_SELF']), PAGES)) {
                $action = 'index.php';
            } else {
                $action = '';
            }
            ?>
            <div class="  d-flex align-items-center ">
                <form class="d-flex mx-auto " method="get" action="<?php echo $action ?>" role="search">
                    <div class="search-input mx-auto">
                        <i class="bi bi-search"></i>
                        <input name="q" class="search-input--input me-2 mx-auto" type="search" placeholder="Search">
                    </div>
                    <?php if(isset($_GET['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <?php endif; ?>

                </form>

            </div>
            <div class=" d-flex align-items-center ">


                <div class="btn-cart me-2">
                    <span class="cart-count d-none">0</span>
                    <a class="btn btn-secondary " href="cart.php">
                        <i class="bi bi-bag user-btn"></i>
                    </a>
                </div>
                <div class="ms-auto">

                    <div class="dropdown">
                        <a class="btn btn-secondary " href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-bounding-box user-btn"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php if(isset($user) && !empty($user)): ?>
                                <li class="text-golden f-16 text-center total-credits" style="font-weight: 800">Credits <?php echo $user->credits ?></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-question-square me-1"></i> Request
                                    Help</a></li>
                            <li><a class="dropdown-item" href="shop.php"><i class="bi bi-shop me-1"></i> Shop</a></li>
                            <?php if(isset($_SESSION['user'])): ?>
                                <li><a class="dropdown-item" href="plan.php"><i class="bi bi-calendar2-check me-1"></i> My Plan</a></li>
                                <li><a class="dropdown-item" href="my-profile.php"><i class="bi bi-person me-1"></i> Profile</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="signin.php"><i class="bi bi-box-arrow-right me-1"></i> Sign
                                        In</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</header>