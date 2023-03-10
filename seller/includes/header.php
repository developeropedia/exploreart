<?php

include "../includes/functions.php";

if(!isset($_SESSION['user'])) {
    redirect("signin.php");
}

define("CURRENT_USER", findById("users", $_SESSION['user']));

if((CURRENT_USER)->role != 1) {
    redirect("signin.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,500&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <title><?php echo getSettings('title') ?> | Seller</title>
</head>

<body>
<div class="d-flex">
    <div class="sidebar-nav ">
        <div class="d-flex justify-content-center align-items-center">
            <img src="../assets/images/<?php echo getSettings('logo') ?>" alt="" class="" height="70">
        </div>
        <ul class="ms-0 ps-0 mt-4  ">
            <li class="sideNav-list-item active-item mb-2">
                <a href="index.php" class="no-decoration">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-ui-checks-grid f-16 text-white me-3"></i>
                        <p class="f-16 w-400 mb-0 pb-0 ">Dashboard</p>
                    </div>

                </a>
            </li>
            <li class="sideNav-list-item mb-2">
                <a href="arts.php" class="no-decoration">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-postage-heart f-18  me-3 text-gray"></i>
                        <p class="f-16 w-400  mb-0 pb-0 text-gray">Arts</p>
                    </div>

                </a>

            </li>
            <li class="sideNav-list-item mb-2">
                <a href="profile.php" class="no-decoration">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person f-18  me-3 text-gray"></i>
                        <p class="f-16 w-400  mb-0 pb-0 text-gray">Profile</p>
                    </div>

                </a>

            </li>




        </ul>
        <div class="d-flex align-items-end  side-logout">
            <a href="" class="no-decoration d-flex align-items-center">
                <img src="assets/images/Ellipse 171.png" alt="" class="img-fluid admin-dropdown ms-0 ps-0">
                <p class="mb-0 pb-0 f-16 text-white w-500 ms-3">Log Out</p>
            </a>

        </div>
    </div>
    <div class="main-section ms-auto">
        <div class="header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center admin-name">
                <h1 class="f-20 w-500 text-white m-0 p-0">Hello, <?php echo (CURRENT_USER)->first_name ?></h1>
                <img src="assets/images/image 11.png" alt="" class="ms-2" height="25">
            </div>

            <div class="d-flex align-items-center mobile-search-section">
                <!-- <div class="header-search me-3">
                    <input type="seach" >
                     <i class="bi bi-search"></i>
                </div> -->
                <div class="dropdown sideNav-dropdown  admin-name">
                    <button class="p-0 m-0 dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <img src="assets/images/download (1).png" alt="" class=" admin-dropdown">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item d-flex align-items-center" href="?a=logout"><i class="bi bi-box-arrow-right me-2 f-18 "></i> Log Out</a></li>
                    </ul>
                </div>

                <div class="mobile-menu">
                    <i class="bi bi-list f-29 text-white"></i>
                </div>
            </div>
        </div>