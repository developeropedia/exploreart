<?php

include_once "includes/functions.php";

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
            <div class="  d-flex align-items-center ">
                <form class="d-flex mx-auto " method="get" action="<?php echo isset($_GET['id']) ? 'profile.php' : '' ?>" role="search">
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


                <div class="ms-auto">

                    <div class="dropdown">
                        <a class="btn btn-secondary " href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-bounding-box user-btn"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-question-square me-1"></i> Request
                                    Help</a></li>
                            </li>
                            <li><a class="dropdown-item" href="signin.php"><i class="bi bi-box-arrow-right me-1"></i> Sign
                                    In</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>