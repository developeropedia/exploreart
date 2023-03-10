<?php

include_once "includes/header.php";

$arts = findAllByQuery("SELECT * FROM products WHERE user_id = {$_SESSION['user']} ORDER BY created_at DESC");

?>

           <div class="main-contents">
            <div class="container">
                <div class="row  mb-3">
                    <div class="col-lg-12">
                        <div class="d-flex mb-2 justify-content-end">
                            <!-- <button class="filter-btn">
                                <i class="bi bi-filter"></i>
                                Filter
                            </button> -->
                            <a href="add-art.php" class="no-decoration">
                                <button class="add-btn">
                                    + Add Art
                                </button>
                            </a>
                        </div>
                        <div class="admin-card ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="dataTable" class="display text-white table-user" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Credits</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                        <?php if(!empty($arts)): ?>
                                        <?php foreach ($arts as $key => $art): ?>
                                            <tr>
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $art->name ?></td>
                                                <td><img src="../assets/images/<?php echo $art->img ?>" alt="" width="100"></td>
                                                <td><?php echo $art->price ?></td>
                                                <td><textarea class="form-control log-form-input" rows="3"><?php echo $art->description ?></textarea></td>
                                                <td>
                                                    <a title="Edit" href="edit-art.php?id=<?php echo $art->id ?>"><i class="bi bi-pencil-fill text-primary f-16 ms-3"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                       </tbody>
                                       
                                    </table>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                   
                   
                </div>

            </div>
           </div>

<?php

include_once "includes/footer.php";

?>