


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
