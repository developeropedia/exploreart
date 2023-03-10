


// ==========================grid layout
$(document).ready(function () {
    // init Isotope
    $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        percentPosition: true,

        masonry: {
            columnWidth: '.grid-sizer'
        },

    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress(function () {
        $grid.isotope('layout');
    });
    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function () {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },

    };

    // bind filter button click
    $('#filters').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({ filter: filterValue });
    });
});




// ==========================active nav
$(document).ready(function () {
 
  $('.filter-btns')
          .click(function (e) {
      $('.filter-btns')
          .removeClass('active-category');
      $(this).addClass('active-category');
  });
});

// Open modal on product click
$(document).on('click', '.grid-item', function () {
    productID = $(this).attr("data-id");
    var product = products.find(item => item.productID == productID);
    prevProduct = products[products.indexOf(product) - 1];
    nextProduct = products[products.indexOf(product) + 1];

    if(!prevProduct) {
        $("#slide-left").addClass("disabled-arrow")
    } else {
        $("#slide-left").removeClass("disabled-arrow")
    }

    if(!nextProduct) {
        $("#slide-right").addClass("disabled-arrow")
    } else {
        $("#slide-right").removeClass("disabled-arrow")
    }

    console.log(product)
    generateProduct(product)

    var modal = $('#productModal');
    modal.modal('show')
})

// Previous product in modal
$("#slide-left").click(function () {
    generateProduct(prevProduct)
    nextProduct = products[products.indexOf(prevProduct) + 1];

    prevProduct = products[products.indexOf(prevProduct) - 1];
    if(!prevProduct) {
        $("#slide-left").addClass("disabled-arrow")
    } else {
        $("#slide-left").removeClass("disabled-arrow")
    }

    $("#slide-right").removeClass("disabled-arrow")
})

// Next product in modal
$("#slide-right").click(function () {
    generateProduct(nextProduct)
    prevProduct = products[products.indexOf(nextProduct) - 1];

    nextProduct = products[products.indexOf(nextProduct) + 1];
    if(!nextProduct) {
        $("#slide-right").addClass("disabled-arrow")
    } else {
        $("#slide-right").removeClass("disabled-arrow")
    }

    $("#slide-left").removeClass("disabled-arrow")
})

function generateProduct(product) {
    $(".caption-logo").text(product.username.charAt(0))
    $("#modal-img").attr("src", "assets/images/" + product.img)
    $("#username").text(product.username)
    $("#username").attr("href", "profile.php?id=" + product.userID)
    $("#product-name").text(product.productName)
    $("#product-credits").text(product.price)
    $("#buy-btn").attr("data-credits", product.price)
    $("#purchase-art-credits").text(product.price)
    $("#product-description").text(product.description)
    $("#purchaseConfirm").attr("data-confirm-id", product.productID)
}

$(document).ready(function () {
    var isLoading = false;

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height() && !isLoading) {
            // $(".custom-loader").removeClass("d-none")

            var totalProducts = $('.grid-item').length;
            var offset = totalProducts;
            isLoading = true;

            const urlParams = new URLSearchParams(window.location.search);
            const sortBy = urlParams.get('sort_by');
            const search = urlParams.get('q');
            const userID = urlParams.get('id')

            var url = window.location.href
            var filename = url.split('/').pop(); // get the last element of the array
            filename = filename.split('?')[0];

            $.ajax({
                url: "includes/ajax.php",
                method: "post",
                data: {offset, limit, sortBy, search, userID : userID != null ? userID : "", page: filename === "collection.php" ? "collection.php" : "" },
                success: function (response) {
                    var productsData = JSON.parse(response)
                    var items = "";
                    productsData.forEach((item) => {
                        products.push(item)
                        items += `<div class="grid-item ${item.catName.replace(' ', '')}" data-id="${item.productID}"> <img src="assets/images/${item.img}" class="img-fluid" /> <div class="image-caption"> <div class="d-flex justify-content-between"> <a href="profile.php?id=${item.userID}" class="d-flex align-items-center"> <div class="caption-logo me-1"> ${item.username.charAt(0)} </div> <h1 class="m-0 p-0 text-golden">${item.username}</h1> </a> <div> <i class="bi bi-bag"></i> </div> </div> <div> <h2>${item.productName}</h2> <p class="mb-0 pb-0">${item.description}</p> </div> </div> </div>`;
                    })
                    items = $(items);
                    $grid.append(items).isotope('appended', items)
                    $grid.isotope('layout')
                    $grid.imagesLoaded().progress(function () {
                        $grid.isotope('layout');
                    });
                    // $(".custom-loader").addClass("d-none")
                    isLoading = false;
                },
                error: function() {
                    isLoading = false;
                }
            })
        }
    });
})


    function sleep(delay) {
        var start = new Date().getTime();
        while (new Date().getTime() < start + delay);
    }

    $('#sort_by').on("change", function () {
        var url = window.location.href;
        var filename = url.split('/').pop();
        filename = filename.split('?')[0];
        location.href = filename + "?" + $(this).val()
    })

    var checkBtnState = false;

    $('.buy-btn').click(function () {
        checkLogin()
    })

    function checkLogin() {
        $.ajax({
            url: 'includes/ajax.php',
            method: 'post',
            data: {'checkLogin': true, productID},
            success: function (response) {
                response = JSON.parse(response)
                if(response.loggedIn) {
                    checkCredits()
                } else {
                    $('#purchase-text').text('You are not logged in! Login to unlock this art.')
                    $('#purchase-img').attr('src', 'assets/images/login.svg')
                    var purchaseBtn = $('#slider-purchase-btn')
                    purchaseBtn.empty();
                    purchaseBtn.append('<i class="bi bi-box-arrow-in-right me-2"></i>')
                    purchaseBtn.append('Login')
                    $('#purchaseConfirm').attr('href', 'signin.php')
                    checkBtnState = true;

                    $('#purchaseModal').modal('show')
                    $('#productModal').modal('hide')
                }
            }
        })
    }

    function checkCredits() {
        $.ajax({
            url: 'includes/ajax.php',
            method: 'post',
            data: {'checkCredits': true, credits: $("#buy-btn").attr("data-credits")},
            success: function (response) {
                response = JSON.parse(response)
                if(response.subscription) {
                    $('#purchase-text').text("You don't have any active plan! Purchase a plan to continue.")
                    $('#purchase-img').attr('src', 'assets/images/plan.svg')
                    var purchaseBtn = $('#slider-purchase-btn')
                    purchaseBtn.empty();
                    purchaseBtn.append('<i class="bi bi-bag me-2"></i>')
                    purchaseBtn.append('Buy Plan')
                    $('#purchaseConfirm').attr('href', 'pricing.php')
                    checkBtnState = true;

                    $('#purchaseModal').modal('show')
                    $('#productModal').modal('hide')
                } else if(response.credits == 'less') {
                    $('#purchase-text').text("You don't have enough credits to unlock this art.")
                    $('#purchase-img').attr('src', 'assets/images/credits.svg')
                    var purchaseBtn = $('#slider-purchase-btn')
                    purchaseBtn.empty();
                    purchaseBtn.append('<i class="bi bi-bag me-2"></i>')
                    purchaseBtn.append('Change Plan')
                    $('#purchaseConfirm').attr('href', 'pricing.php')
                    checkBtnState = true;

                    $('#purchaseModal').modal('show')
                    $('#productModal').modal('hide')
                } else {
                    $('#purchaseModal').modal('show')
                    $('#productModal').modal('hide')
                }
            }
        })
    }

    $('#purchaseConfirm').click(function () {
        if(!checkBtnState) {
            var productID = $(this).attr('data-confirm-id');
            var confirmBtn = $('#slider-purchase-btn')
            confirmBtn.empty()
            confirmBtn.css('width', '94px')
            confirmBtn.css('height', '32px')
            confirmBtn.append('<div class="spinner"></div>')

            $.ajax({
                url: 'includes/ajax.php',
                method: 'post',
                data: {'confirmPurchase': true, productID},
                success: function (response) {
                    response = JSON.parse(response)
                    if(response.error) {
                        alert(response.error)
                    } else {
                        $('#purchase-text').text(response.message)
                        $('.total-credits').text('Credits ' + response.credits)
                        $('#purchase-img').attr('src', 'assets/images/congrats.svg')
                        var purchaseBtn = $('#slider-purchase-btn')
                        purchaseBtn.empty();
                        purchaseBtn.append('<i class="bi bi-bookmark-star me-2"></i>')
                        purchaseBtn.append('My Collection')
                        purchaseBtn.css('width', 'fit-content')
                        $('#purchaseConfirm').attr('href', 'collection.php')
                    }
                }
            })
        }
    })