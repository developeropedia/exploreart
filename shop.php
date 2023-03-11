<?php

$PAGE = "shop";

include "includes/header.php";

$limit = LIMIT;

$categories = findAll("shop_categories");

$sort = ["price-ascending" => "price", "price-descending" => "price", "date-ascending" => "p.created_at", "date-descending" => "p.created_at"];
$order = ["price-ascending" => "ASC", "price-descending" => "DESC", "date-ascending" => "ASC", "date-descending" => "DESC"];

$sort_by = $_GET['sort_by'] ?? 'p.created_at';
$q = $_GET['q'] ?? '';

$query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM shop_products p INNER JOIN users u on p.user_id = u.id INNER JOIN shop_categories c on p.shop_cat_id = c.id";

if (!empty($q)) {
    $q = urldecode($q);
    $query .= " WHERE p.name LIKE '%{$q}%'";
}

if(!empty($_GET['cid'])) {
    $query .= " WHERE shop_cat_id = {$_GET['cid']}";
}

if ($sort_by != 'p.created_at') {
    $query .= " ORDER BY {$sort[$sort_by]} {$order[$sort_by]}";
} else {
    $query .= " ORDER BY p.created_at DESC";
}

$query .= " LIMIT {$limit} OFFSET 0";

$products = findAllByQuery($query);

?>

<main>

  <div class="container mt-3">
    <div class="row align-items-center">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-6 order-sm-2 ">
        <div id="filters" class="button-group d-flex justify-content-center  w-100 pb-3 pt-1">
          <button class="button filter-btns <?php echo isset($_GET['cid']) ? '' : 'active-category' ?>" onclick="window.location.href = 'shop.php'">All</button>
          <?php if(!empty($categories)): ?>
          <?php foreach ($categories as $category): ?>
              <button class="button filter-btns <?php echo isset($_GET['cid']) && $_GET['cid'] == $category->id ? 'active-category' : '' ?>"" onclick="window.location.href = 'shop.php?cid=<?php echo $category->id ?>'"><?php echo $category->name ?></button>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
        <div class="col-lg-3 d-flex justify-content-lg-end justify-content-center order-sm-1 pb-3">

            <div class="custom-select">
                <select id="sort_by" class="select-sort">
                    <option selected disabled>Sort By</option>
                    <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'price-ascending' ? 'selected' : '' ?> value="sort_by=price-ascending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Price, low to high</option>
                    <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'price-descending' ? 'selected' : '' ?> value="sort_by=price-descending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Price, high to low</option>
                    <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'date-ascending' ? 'selected' : '' ?> value="sort_by=date-ascending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Date, old to new</option>
                    <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'date-descending' ? 'selected' : '' ?> value="sort_by=date-descending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Date, new to old</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row justify-content-center shop-products-main">
      <?php if(!empty($products)): ?>
      <?php foreach ($products as $product): ?>
          <div class="col-lg-3 col-md-5 col-sm-8 col-12 shop-products">
              <a href="product.php?id=<?php echo $product->productID ?>" class="no-decoration">
                  <div class="product-card">
                      <div class="product-card-img">
                          <img src="assets/images/<?php echo $product->img ?>" alt="">
                      </div>
                      <div class="product-card-text">
                          <h2 class="mb-0 mb-1"><?php echo $product->productName ?></h2>
                          <p class="">by <?php echo $product->username ?></p>
                          <h2><span>$<?php echo $product->price ?></span></h2>
                      </div>
                  </div>
              </a>
          </div>
      <?php endforeach; ?>
      <?php else: ?>
          <div class="row no-product-row">
              <div class="col-lg-12  d-flex justify-content-center align-items-center flex-column">
                  <img class="img-fluid" width="200px" src="assets/images/No%20data-cuate.svg" alt="">
                  <p class="text-golden fw-bold text-center mb-0 pb-0">No product found</p>
              </div>
          </div>
      <?php endif; ?>
    </div>
</main>

<?php

include "includes/footer.php";

?>

<script>
    var products = <?php echo json_encode($products) ?>;
    var productID;
    var limit = <?php echo $limit ?>;
    var page = <?php echo "'" . $PAGE . "'"; ?>;

</script>
