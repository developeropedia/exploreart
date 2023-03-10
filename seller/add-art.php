<?php

include "includes/header.php";

function validateImage($file) {
    // Get the file name and extension
    $fileName = $file['name'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Define the allowed file extensions and MIME types
    $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
    $allowedMimeTypes = array('image/jpeg', 'image/png', 'image/gif');

    // Check if the file is an image and has an allowed extension and MIME type
    if (!in_array($fileExt, $allowedExts) || !in_array($file['type'], $allowedMimeTypes)) {
        return 'The uploaded file is not a valid image.';
    }

    // Check if the file size is less than 10 MB
    if ($file['size'] > 10000000) {
        return 'The uploaded image is too large. Please upload an image that is less than 10 MB.';
    }

    // Check if there were any errors uploading the file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return 'There was an error uploading the image.';
    }

    // If all validations pass, return true
    return true;
}

function generateEncodedImageName($originalName) {
    $randomString = bin2hex(random_bytes(5)); // Generate a random string
    $currentTime = time(); // Get the current time
    $extension = pathinfo($originalName, PATHINFO_EXTENSION); // Get the extension of the original filename

    // Combine the random string, current time, and extension to create the encoded filename
    $encodedName = $randomString . $currentTime . '.' . $extension;

    return $encodedName;
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $credits = $_POST['credits'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $validationResult = validateImage($_FILES['image']);
    if ($validationResult === true) {
        $imageName = $_FILES['image']['name'];
        $imageNameLow = time() . "-" . substr(uniqid("", true), -6) . $imageName;
        $imageNameEncoded = generateEncodedImageName($imageName);

        $imageTmp = $_FILES['image']['tmp_name'];

        // specify the max dimensions of the low-quality image
        $max_width = intval(500.0);
        $max_height = intval(500.0);

        // get the image type
        $image_type = exif_imagetype($imageTmp);

        // create a new image based on the image type
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($imageTmp);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($imageTmp);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($imageTmp);
                break;
            default:
                // handle unsupported image types
                break;
        }

        // get the original dimensions of the image
        $width = intval(imagesx($image));
        $height = intval(imagesy($image));

        // calculate the new dimensions for the low-quality image
        $aspect_ratio = $width / $height;
        if ($width > $max_width || $height > $max_height) {
            if ($max_width / $max_height > $aspect_ratio) {
                $max_width = $max_height * $aspect_ratio;
            } else {
                $max_height = $max_width / $aspect_ratio;
            }
        }

        // create a new image with the new dimensions
        $new_image = imagecreatetruecolor(intval($max_width), intval($max_height));

        // resize the original image to the new dimensions
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, intval($max_width), intval($max_height), $width, $height);

        // save the low-quality image to a file
        imagejpeg($new_image, "../assets/images/" . $imageNameLow, 80); // 80 is the quality level (0-100)

        // save the original high-quality image to a file
        move_uploaded_file($imageTmp, '../uploads/'.$imageNameEncoded);

        // cleanup the image resources
        imagedestroy($image);
        imagedestroy($new_image);

        $insertID = insert("products",
            [
                'cat_id' => $category,
                'user_id' => $_SESSION['user'],
                'name' => $name,
                'description' => $description,
                'price' => $credits,
                'img' => $imageNameLow,
                'original_img' => $imageNameEncoded
            ]);

        if(!empty($insertID)) {
            $msg = "<p class='text-center text-success'>Art added successfully!</p>";
        } else {
            $msg = "<p class='text-center text-danger'>Art couldn't be added!</p>";
        }
    } else {
        $msg = "<p class='text-center text-danger'>{$validationResult}</p>";
    }
}

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
                                    <input required name="name" type="text" class="form-control log-form-input" id="name">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="credits" class="form-label log-form-label">Credits</label>
                                    <input required name="credits" min="0" type="number" class="form-control log-form-input" id="credits">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="category" class="form-label log-form-label">Category</label>
                                    <select name="category" class="form-select log-form-input" id="category">
                                        <?php if(!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="image" class="form-label log-form-label">Image</label>
                                    <input required name="image" type="file" class="form-control log-form-input" accept="image/*" id="image">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label log-form-label">Description</label>
                                    <textarea required name="description" class="form-control log-form-input" id="description" rows="3"></textarea>
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