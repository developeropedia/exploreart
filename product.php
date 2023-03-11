<?php

$PAGE = "shop";

include "includes/header.php";

if(!isset($_GET['id'])) {
    redirect("shop.php");
}

$product = findById("shop_products", $_GET['id']);
$user = findById("users", $product->user_id);

?>

<main>

  <div class="container mt-5">
    <div class="row details-row">
      <div class="small-caption">

        <div class="slide-img-text">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center ">
              <div class="caption-logo me-2 ">
                <?php echo substr($user->username, 0, 1) ?>
              </div>
              <a
                 class="m-0 p-0 f-16 w-500 text-white no-decoration"><?php echo $user->username ?></a>

            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-5">

        <div class="lightbox-images ">
          <img src="assets/images/<?php echo $product->img ?>" alt="" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-7 d-flex flex-column justify-content-between align-items-stretch">
        <div>
          <div class="lg-caption">

            <div class="slide-img-text">
              <div class="d-flex align-items-center">
                <div class="caption-logo me-2">
                    <?php echo substr($user->username, 0, 1) ?>
                </div>
                <a
                   class="m-0 p-0 f-16 w-500 text-white no-decoration"><?php echo $user->username ?></a>
              </div>
            </div>
          </div>

          <h1 class="m-0 p-0 f-25 w-600 text-white py-3">
            <?php echo $product->name ?>
          </h1>

          <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Price</h2>
          <p class="mb-0 pb-0 f-20 w-500 text-white">
            $<?php echo $product->price ?>
          </p>
          <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Description</h2>

          <p class="mb-0 pb-0 f-16 w-500 text-white">
            <?php echo $product->description ?>
          </p>
        </div>

        <div>
          <a class="no-decoration add-cart" data-id="<?php echo $product->id ?>"><button
                  class="slide-btn mt-4 mb-2"> <i
                  class="bi bi-bag me-2"></i>Add to Cart</button></a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php

include "includes/footer.php";

?>

<script>
    $('.add-cart').click(function () {
        var productID = $(this).attr("data-id")

        $.ajax({
            url: "includes/ajax.php",
            method: "post",
            data: {cart: true, productID},
            success: function (response) {
                response = JSON.parse(response);
                if(response.error) {
                    alert(response.error)
                } else {
                    var cartItems = JSON.parse(Cookies.get('cart'));
                    $('.cart-count').removeClass('d-none')
                    $('.cart-count').text(cartItems.length)
                }
            }
        })
    })
</script>
