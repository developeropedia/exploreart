<?php

include "includes/header.php";

if(!isset($_GET['id'])) {
    redirect("arts.php");
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $credits = $_POST['credits'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $updated = update("products",
        [
            'cat_id' => $category,
            'name' => $name,
            'description' => $description,
            'price' => $credits
        ], "id", $_GET['id']);

    if(!empty($updated)) {
        $msg = "<p class='text-center text-success'>Art updated successfully!</p>";
    } else {
        $msg = "<p class='text-center text-danger'>Art couldn't be updated!</p>";
    }
}

$art = findById("products", $_GET['id']);
$categories = findAll("categories");

?>

           <div class="main-contents">
            <div class="container">
                        <form class="admin-card row" method="post" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <h1 class="mb-0 pb-0 text-primary f-18 w-500 mb-4">Add Art</h1>
                            </div>
                            <?php echo $msg ?? "" ?>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="name" class="form-label log-form-label">Name</label>
                                    <input required name="name" value="<?php echo $art->name ?>" type="text" class="form-control log-form-input" id="name">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="credits" class="form-label log-form-label">Credits</label>
                                    <input required name="credits" value="<?php echo $art->price ?>" min="0" type="number" class="form-control log-form-input" id="credits">
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 ">
                                    <label for="category" class="form-label log-form-label">Category</label>
                                    <select name="category" class="form-select log-form-input" id="category">
                                        <?php if(!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                                <option <?php echo $category->id == $art->cat_id ? 'selected' : '' ?> value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label log-form-label">Description</label>
                                    <textarea required name="description" class="form-control log-form-input" id="description" rows="3"><?php echo $art->description ?></textarea>
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between">
                                    <button class="log-btn" type="submit" name="submit" style="width:100px !important">
                                        <a class="text-white">Submit</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                   
                   
                </div>

            </div>

<?php

include "includes/footer.php";

?>