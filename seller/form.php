<?php

include "includes/header.php";

?>

           <div class="main-contents">
            <div class="container">
                        <form class="admin-card row">
                            <div class="col-lg-12">
                                <h1 class="mb-0 pb-0 text-primary f-18 w-500 mb-4">Add Users</h1>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label log-form-label">Name</label>
                                    <input type="text" class="form-control log-form-input" id="exampleInputEmail1"  aria-describedby="emailHelp">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label log-form-label">Email</label>
                                    <input type="email" class="form-control log-form-input" id="exampleInputEmail1"  aria-describedby="emailHelp">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label log-form-label">Number</label>
                                    <input type="number" class="form-control log-form-input" id="exampleInputEmail1"  aria-describedby="emailHelp">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label log-form-label">Country</label>
                                    <select class="form-select log-form-input" aria-label="Default select example">
                                        <option selected>Select Country</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                      </select>
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label log-form-label">Message</label>
                                    <textarea class="form-control log-form-input" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check All</label>
                                      </div>
                                      <button class="log-btn" style="width:100px !important">
                                            <a href="index.php" >Submit</a>
                                      </button>
                                </div>
                            </div>
                        </form>
                   
                   
                </div>

            </div>

<?php

include "includes/footer.php";

?>