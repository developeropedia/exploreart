<?php

include_once "includes/functions.php";

$msg = login(2);

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
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Explore Art</title>
</head>

<body class="form-body pt-5">
   
      <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex justify-content-center mb-3">
                    <div class="d-flex align-items-center ">
                        <img src="assets/images/<?php echo getSettings("logo") ?>" alt="" class="img-fluid me-2" style="width: 25px;">
                        <a class="no-decoration " href="index.php">
                            <h1 class="m-0 p-0 f-20 w-700 text-golden"><?php echo getSettings("title") ?></h1>
                        </a>
                    </div>
                </div>
                <form action="" method="post" class="form-reg">
                <div class="d-flex justify-content-center align-items-center  flex-wrap">
                    <div class="mb-3">
                        <a href="signup.php" class="sign-btn  active-sign"><i class="bi bi-person-fill-add f-20 me-1"></i>Sign Up</a>
                    </div>
                    <div class="mb-3">
                        <a href="signin.php" class="sign-btn "><i class="bi bi-person-check f-20 me-1"></i> Sign In</a>
                    </div>
                </div>
                    
                    <div>
                        <?php echo $msg ?? "" ?>
                    </div>
               
                  <div class="mb-3">
                    <label for="username" class="form-label text-gray f-14 w-500 ">Username</label>
                    <input type="text" name="username" class="form-control sign-input" id="username">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label text-gray f-14 w-500 "> Password</label>
                    <input type="password" name="password" class="form-control sign-input" id="password">
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" name="login" class="sign-btn">Sign In</button>
                </div>
                </form>
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