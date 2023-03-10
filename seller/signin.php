<?php

include "includes/log-header.php";

$msg = login(1);

?>

  <div class="log-form  d-flex justify-content-center align-items-center">
    <div class="col-50 d-flex justify-content-center align-items-center">
      <form action="" method="post" class="form-content h-100">
        <div class="d-flex justify-content-center align-content-center mb-3 ">
          <img src="../assets/images/<?php echo getSettings('logo') ?>" alt="" class="img-fluid" width="170">
        </div>
       <div class="text-center d-flex justify-content-center">
        <h1 class="mb-0 pb-0 text-center">Sign In</h1>
       </div>
        <p class="mb-0 pb-0 mb-3 text-center">Manage data with Seller Panel</p>
          <?php echo $msg ?? "" ?>
        <div class="mb-3 ">
          <label for="username" class="form-label log-form-label">Username</label>
          <input type="text" name="username" class="form-control log-form-input" id="username" placeholder="Username">
        </div>
        <div class="mb-1 ">
          <label for="password" class="form-label log-form-label">Password*</label>
          <input type="password" name="password" class="form-control log-form-input" id="password" placeholder="Password">
        </div>
<!--        <div class="d-flex justify-content-between">-->
<!--          <div class="mb-3 form-check">-->
<!--            <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--            <label class="form-check-label" for="exampleCheck1">Keep me signed in</label>-->
<!--          </div>-->
<!--          <div class="mb-3">-->
<!--            <a href="forgot.html" class="link">Forgot password?</a>-->
<!--          </div>-->
<!--        </div>-->
        <div class="d-flex justify-content-center mt-5">
          <button class="log-btn" type="submit" name="login">
            <a class="text-white">Log In</a>
          </button>
        </div>

      </form>
    </div>
   
  </div>

<?php

include "includes/log-footer.php";

?>