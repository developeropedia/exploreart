<?php

$PAGE = "shop";

include "includes/header.php";

$cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart']) : array();

?>

<main>
    <div class="container-fluid mt-3">
        <div class="row">
            <?php if(!empty($cartItems)): ?>
                <form id="checkout-form" class="row" action="checkout.php" method="post">
                    <div class="col-lg-8 mb-3 ">
                        <div class="table-div bg-dark">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center table-heading">Description</th>
                                    <th scope="col" class="text-center table-heading">Quantity</th>
                                    <th scope="col" class=" text-center table-heading">Price</th>
                                    <th scope="col" class="text-center table-heading">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($cartItems)): ?>
                                    <?php $total = $count = 0; foreach ($cartItems as $cartItem): ?>
                                        <?php $product = findById("shop_products", $cartItem);
                                        if(empty($product)) {
                                            unset($cartItems[array_search($cartItem, $cartItems)]);
                                            $cartItems = array_values($cartItems);
                                            setcookie("cart", json_encode($cartItems), time() + 30 * 24 * 60 * 60, "/");
                                        } else {
                                            $total += $product->price
                                            ?>
                                            <tr class="">
                                                <td class="data-row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/<?php echo $product->img ?>" alt="" class="img-fluid cart-img">
                                                        <a href="product.php?id=<?php echo $product->id ?>" class="f-14 w-400 ms-2 mb-0 pb-0 cart-decription">
                                                            <?php echo $product->description ?>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="wrapper">
                                                        <span class="minus">-</span>
                                                        <span class="num">1</span>
                                                        <span class="plus">+</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center px-3">
                                                    <p class="mb-0 pb-0 f-16 w-600 price-text">$<?php echo $product->price ?></p>
                                                    <input type="hidden" name="ids[]" class="ids" value="<?php echo $product->id ?>">
                                                    <input type="hidden" name="counts[]" class="counts" value="<?php echo $count++ ?>">
                                                    <input type="hidden" name="qtys[]" class="qtys" value="1">
                                                    <input type="hidden" name="prices[]" class="price" value="<?php echo $product->price ?>">
                                                    <input type="hidden" class="totalPrice" value="<?php echo $product->price ?>">
                                                </td>
                                                <td class="align-middle text-center delete-cart" data-id="<?php echo $product->id ?>">
                                                    <i class="bi bi-x-circle text-white"></i>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-lg-4  mb-3">
                        <div class="table-div2 bg-dark">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col" class=" table-heading">Order Summary</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="">
                                    <td class="data-row">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <p class="f-14 w-400 ms-2 ">
                                                SubTotal
                                            </p>
                                            <p class="f-14 w-500 ms-2 subtotal-text">
                                                $<?php echo $total ?>
                                            </p>
                                        </div>
                                        <!--                                    <div class="d-flex align-items-center justify-content-between">-->
                                        <!---->
                                        <!--                                        <p class="f-14 w-400 ms-2 mb-0 pb-0">-->
                                        <!--                                            Standrad Shipping-->
                                        <!--                                        </p>-->
                                        <!--                                        <p class="f-14 w-500 ms-2 mb-0 pb-0">-->
                                        <!--                                            $71.00-->
                                        <!--                                        </p>-->
                                        <!--                                    </div>-->
                                    </td>


                                </tr>
                                <tr>
                                    <td class="data-row">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <p class="f-20 w-600 ms-2 mb-0 pb-0">
                                                Total
                                            </p>
                                            <p class="f-20 w-600 ms-2  mb-0 pb-0 total-text">
                                                $<?php echo $total ?>
                                            </p>
                                            <input type="hidden" name="total" value="<?php echo $total ?>" id="totalPrice" >
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a id="checkout-btn"><button class="cart-btn checkout-text">Checkout $<?php echo $total ?></button></a>
                        </div>

                    </div>
                </form>
            <?php else: ?>
                <div class="row no-product-row">
                    <div class="col-lg-12  d-flex justify-content-center align-items-center flex-column">
                        <img class="img-fluid" width="200px" src="assets/images/No%20data-cuate.svg" alt="">
                        <p class="text-golden fw-bold text-center mb-0 pb-0">Cart is empty</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </div>
</main>

<?php

include "includes/footer.php";

?>

<script>
    $('.plus').click(function () {
        var productMain = $(this).closest('tr')
        var num = productMain.find('.num')
        num.text(parseInt(num.text()) + 1)
        productMain.find('.qtys').val(num.text())
        var price = productMain.find('.price')
        var totalPrice = productMain.find('.totalPrice')
        totalPrice.val(parseInt(num.text()) * price.val())

        var total = 0;
        $('.totalPrice').each(function () {
            total += parseInt($(this).val())
        })

        $('.subtotal-text').text("$" + total)
        $('.total-text').text("$" + total)
        $('.checkout-text').text("Checkout $" + total)
        $('#totalPrice').val(total)
    })

    $('.minus').click(function () {
        var productMain = $(this).closest('tr')
        var num = productMain.find('.num')
        if(num.text() > 1) {
            num.text(parseInt(num.text()) - 1)
            var price = productMain.find('.price')
            var totalPrice = productMain.find('.totalPrice')
            totalPrice.val(parseInt(num.text()) * price.val())

            var total = 0;
            $('.totalPrice').each(function () {
                total += parseInt($(this).val())
            })

            $('.subtotal-text').text("$" + total)
            $('.total-text').text("$" + total)
            $('.checkout-text').text("Checkout $" + total)
            $('#totalPrice').val(total)
        }
    })

    $(".delete-cart").click(function () {
        var productID = $(this).attr("data-id")
        var that = $(this)
        $.ajax({
            url: "includes/ajax.php",
            method: "post",
            data: {deleteCart: true, productID},
            success: function (response) {
                that.closest('tr').remove()

                var cartItems = JSON.parse(Cookies.get('cart'));
                $('.cart-count').removeClass('d-none')
                $('.cart-count').text(cartItems.length)

                var total = 0;
                $('.totalPrice').each(function () {
                    total += parseInt($(this).val())
                })

                $('.subtotal-text').text("$" + total)
                $('.total-text').text("$" + total)
                $('.checkout-text').text("Checkout $" + total)
                $('#totalPrice').val(total)
            }
        })
    })

    $("#checkout-btn").click(function () {
        $('#checkout-form').submit()
    })
</script>