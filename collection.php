<?php

include "includes/header.php";

$limit = LIMIT;

$categories = findAll("categories");

$sort = ["price-ascending" => "price", "price-descending" => "price", "date-ascending" => "p.created_at", "date-descending" => "p.created_at"];
$order = ["price-ascending" => "ASC", "price-descending" => "DESC", "date-ascending" => "ASC", "date-descending" => "DESC"];

$sort_by = $_GET['sort_by'] ?? 'p.created_at';
$q = $_GET['q'] ?? '';

$query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM art_purchases ap INNER JOIN products p ON p.id = ap.product_id INNER JOIN users u on p.user_id = u.id INNER JOIN categories c on p.cat_id = c.id WHERE ap.user_id = {$_SESSION['user']}";

if (!empty($q)) {
    $q = urldecode($q);
    $query .= isset($_SESSION['user']) ? " AND p.name LIKE '%{$q}%'" : " WHERE p.name LIKE '%{$q}%'";
}

if ($sort_by != 'p.created_at') {
    $query .= " ORDER BY {$sort[$sort_by]} {$order[$sort_by]}";
} else {
    $query .= " ORDER BY p.created_at DESC";
}

$query .= " LIMIT {$limit} OFFSET 0";

$products = findAllByQuery($query);

?>

        <div class="profile-description">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-start align-items-center">
                            <h1 class="user-name">My Collection</h1>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <main style="min-height: calc(83vh - 90px) !important;">
            <div class="container-fluid mt-3">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end mt-3 mb-3">
                        <div class="custom-select">
                            <select id="sort_by" class="select-sort">
                                <option selected disabled>Sort By</option>
                                <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'price-ascending' ? 'selected' : '' ?> value="sort_by=price-ascending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Credits, low to high</option>
                                <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'price-descending' ? 'selected' : '' ?> value="sort_by=price-descending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Credits, high to low</option>
                                <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'date-ascending' ? 'selected' : '' ?> value="sort_by=date-ascending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Date, old to new</option>
                                <option <?php echo isset($_GET['sort_by']) && $_GET['sort_by'] == 'date-descending' ? 'selected' : '' ?> value="sort_by=date-descending<?php echo isset($_GET['q']) ? '&q=' . $_GET['q'] : '' ?>">Date, new to old</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="offset" value="0">
                        <div class="grid">
                            <div class="grid-sizer"></div>
                            <?php if(!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="grid-item <?php echo str_replace(' ', '', $product->catName) ?>" data-id="<?php echo $product->productID ?>">
                                        <img src="assets/images/<?php echo $product->img ?>" class="img-fluid" />
                                        <div class="image-caption">
                                            <div class="d-flex justify-content-between">
                                                <a href="profile.php?id=<?php echo $product->userID ?>" class="d-flex align-items-center">
                                                    <div class="caption-logo me-1">
                                                        <?php echo substr($product->username, 0, 1) ?>
                                                    </div>
                                                    <h1 class="m-0 p-0 text-golden"><?php echo $product->username ?></h1>
                                                </a>
                                                <div>
                                                    <i class="bi bi-bag"></i>
                                                </div>
                                            </div>

                                            <div>
                                                <h2><?php echo $product->productName ?></h2>
                                                <p class="mb-0 pb-0"><?php echo $product->description ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="row no-product-row" style="min-height: calc(72vh - 100px) !important;">
                                    <div class="col-lg-12  d-flex justify-content-center align-items-center flex-column">
                                        <img class="img-fluid" width="200px" src="assets/images/No%20data-cuate.svg" alt="">
                                        <p class="text-golden fw-bold text-center mb-0 pb-0">No product found</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="slide-arrow" id="slide-left">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="modal-body-content">
                        <div class="container-fluid p-0 m-0">
                            <div class="row p-0 m-0">
                                <div class="small-caption">

                                    <div class="slide-img-text">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center ">
                                                <div class="caption-logo me-2 ">
                                                    Ai
                                                </div>
                                                <a href="profile.php" class="m-0 p-0 f-16 w-500 text-white no-decoration">Caption</a>

                                            </div>
                                            <p class="mb-0 pb-0 text-white" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ">

                                    <div class="lightbox-images">
                                        <img id="modal-img" src="assets/images/15.jpeg" alt="" class="">
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex flex-column justify-content-between align-items-stretch">
                                    <div>
                                        <div class="lg-caption">
                                            <div class="d-flex justify-content-end  text-white">
                                                <p class="mb-0 pb-0 text-white" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                </p>
                                            </div>
                                            <div class="slide-img-text">
                                                <div class="d-flex align-items-center">
                                                    <div class="caption-logo me-2">
                                                        Ai
                                                    </div>
                                                    <a href="profile.php" id="username" class="m-0 p-0 f-16 w-500 text-white no-decoration">Caption</a>
                                                </div>
                                            </div>
                                        </div>

                                        <h1 id="product-name" class="m-0 p-0 f-25 w-600 text-white py-3">
                                            Analog style
                                        </h1>

                                        <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Credits</h2>
                                        <p id="product-credits" class="mb-0 pb-0 f-20 w-500 text-white">
                                            $1000
                                        </p>
                                        <h2 class="f-14 w-600 text-light-grey mt-4 mb-2">Description</h2>

                                        <p id="product-description" class="mb-0 pb-0 f-12 w-500 text-white">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae architecto maiores placeat ipsum odio quis suscipit voluptatem sit in eveniet optio rerum doloremque natus obcaecati at nobis, enim facere ex.
                                        </p>
                                    </div>

                                    <div>
                                        <a class="no-decoration"><button class="slide-btn mt-4 mb-2"> <i class="bi bi-bag me-2"></i>Download</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="slide-arrow"  id="slide-right">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include "includes/footer.php";

?>

<script>
    var products = <?php echo json_encode($products) ?>;
    var productID, prevProduct, nextProduct;
    var limit = <?php echo $limit ?>;

</script>

