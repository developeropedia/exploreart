<?php

include "includes/header.php";

$plan = findById("plans", $_GET['id']);
$customer = findById("users", $_SESSION['user']);

?>


    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12 text-center text-white my-3">
                    <h1 class="f-20 w-700 text-golden">
                        Simple And Flexible Pricing
                    </h1>
                    <p class="f-14 w-600 text-gray">Change or cancel your plan anytime</p>
                </div>
                <div class="col-lg-6 mx-auto">
                    <form action="success.php" id="subscription-form" method="post" class="form-reg">
                        <div class="d-flex justify-content-center align-items-center  flex-wrap">

                        </div>

                        <div>
                            <?php echo $msg ?? "" ?>
                        </div>

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

                        <div id="card-element" class="my-2"></div>

                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $_GET['id'] ?>">
                            <button type="submit" name="login" class="sign-btn fw-bold">PAY</button>
                        </div>
                        <p id="stripe-error" style="display: none"></p>
                    </form>
                </div>
            </div>


        </div>
    </main>

<?php

include "includes/footer.php";

?>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client
    var stripe = Stripe("<?php echo PUBLISHABLE_KEY; ?>");

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#ffffff',

        }
    };

    // Create an instance of the card Element
    var card = elements.create('card', {hidePostalCode: true, style: style});

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('stripe-error');
        if (event.error) {
            displayError.textContent = event.error.message;
            displayError.style.display = 'block';
        } else {
            displayError.style.display = 'none';
        }
    });

    // Handle form submission
    var form = document.getElementById('subscription-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('stripe-error');
                errorElement.textContent = result.error.message;
                errorElement.style.display = 'block';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('subscription-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        // form.submit();

        createSubscription(token.id);
    }

    function createSubscription(token) {
        var planID = $('#plan_id').val()

        $.ajax({
            url: "payment_init.php",
            method: "post",
            data: {request_type: 'subscription', token, planID},
            success: function (response) {
                response = JSON.parse(response)
                if(response.error) {
                   alert(response.error)
                } else {
                    processPayment(response.subscriptionId, response.clientSecret, response.customerId);
                }
            },
            error: function (error) {
                console.log(error)
            }
        })
    }

    function processPayment(subscriptionId, clientSecret, customerId) {
        var customer = <?php echo json_encode($customer); ?>;

        // Create payment method and confirm payment intent.
        stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: customer.first_name + customer.last_name,
                    address: {
                        line1: '510 Townsend St',
                        city: 'San Francisco',
                        postal_code: '98140',
                        state: 'CA',
                        country: 'US'
                    }
                },
            }
        }).then((result) => {
            if(result.error) {
                console.log(result.error)
            } else {
                console.log(result.paymentIntent)
                $.ajax({
                    url: "payment_init.php",
                    method: 'post',
                    data: {request_type: 'process_payment', subscriptionId, customerId, payment_intent: result.paymentIntent}
                })
            }
        });
    }
</script>
