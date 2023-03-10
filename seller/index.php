<?php

include "includes/header.php";

$arts = findAllByQuery("SELECT * FROM products WHERE user_id = {$_SESSION['user']}");
$art_sales = findAllByQuery("SELECT * FROM art_purchases ap INNER JOIN products p on ap.product_id = p.id WHERE p.user_id = {$_SESSION['user']}");

?>


           <div class="main-contents">
            <div class="container">
                <div class="row  mb-3">
                    <div class="col-lg-12">
                        <div class="admin-card ">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 text-center mb-lg-0 mb-md-4 mb-sm-4 mb-4">
                                    <h1 class="f-24 w-500 text-white mb-0 pb-0"><?php echo count($arts) ?></h1>
                                    <p class="mb-0 pb-0 f-16 text-gray w-500">Total Arts</p>
                                </div>
            
                                <div class="col-lg-3 col-md-6 text-center mb-lg-0 mb-md-4 mb-sm-4 mb-4">
                                    <h1 class="f-24 w-500 text-white mb-0 pb-0"><?php echo count($art_sales) ?></h1>
                                    <p class="mb-0 pb-0 f-16 text-gray w-500">
                                        Total Sales
                                       </p>
                                </div>
            
                                <div class="col-lg-3 col-md-6 text-center mb-lg-0 mb-md-4 mb-sm-4 mb-4">
                                    <h1 class="f-24 w-500 text-white mb-0 pb-0">550K</h1>
                                    <p class="mb-0 pb-0 f-16 text-gray w-500">Total CPRs</p>
                                </div>
            
                                <div class="col-lg-3 col-md-6 text-center mb-lg-0 mb-md-4 mb-sm-4 mb-4">
                                    <h1 class="f-24 w-500 text-white mb-0 pb-0">5,000</h1>
                                    <p class="mb-0 pb-0 f-16 text-gray w-500">911 Callss</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                   
                   
                </div>

                <div class="row h-100 ">
                    <div class="col-lg-5  mb-3">
                        <div class="admin-card h-100">
                            <div class="d-flex justify-content-between mb-3">
                                <h1 class="f-20 w-500 text-white">CPR</h1>
                                <div class="dropdown sideNav-dropdown  ">
                                    <button class="p-0 m-0 dropdown-toggle f-14 text-gray w-500" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                      This Week
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
            
                            </div>
                            <div class="d-flex align-items-center justify-content-around ">
                                <div id="chart"></div>
    
                            <div>
                                <div class="d-flex align-items-center ">
                                     <div class="color me-3" style="background-color: #FFA17D;">
    
                                     </div>
                                     <div>
                                        <h1 class="f-16 w-500 text-gray">
                                            Adult
                                        </h1>
                                        <p class="mb-0 pb-0 f-16 w-500 text-white">
                                            251K
                                        </p>
                                     </div>
                                </div>
    
                                <div class="d-flex align-items-center my-4">
                                    <div class="color me-3" style="background-color: #FFA17D;">
    
                                    </div>
                                    <div>
                                       <h1 class="f-16 w-500 text-gray">
                                        Childern
                                       </h1>
                                       <p class="mb-0 pb-0 f-16 w-500 text-white">
                                        176K
                                       </p>
                                    </div>
                               </div>
    
                               <div class="d-flex align-items-center ">
                                <div class="color me-3" style="background-color: #DF4308;">
    
                                </div>
                                <div>
                                   <h1 class="f-16 w-500 text-gray">
                                    Infant
                                   </h1>
                                   <p class="mb-0 pb-0 f-16 w-500 text-white">
                                    176K
                                   </p>
                                </div>
                           </div>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-7  mb-3 h-100">
                        <div class="admin-card h-100">
                            <div class="d-flex justify-content-between mb-3">
                                <h1 class="f-20 w-500 text-white">CPR</h1>
                                <div class="dropdown sideNav-dropdown  ">
                                    <button class="p-0 m-0 dropdown-toggle f-14 text-gray w-500" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                      This Week
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
            
                            </div>
                                <div id="chart-col"></div>
                        </div>
                       

                        
                    </div>
                    <div class="col-lg-7  mb-3 h-100">
                        <div class="admin-card h-100">
                            <div class="d-flex justify-content-between mb-3">
                                <h1 class="f-20 w-500 text-white">CPR</h1>
                                <div class="dropdown sideNav-dropdown  ">
                                    <button class="p-0 m-0 dropdown-toggle f-14 text-gray w-500" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                      This Week
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
            
                            </div>
                                <div id="chart-col2"></div>
                        </div>
                       

                        
                    </div>
                    <div class="col-lg-5  mb-3">
                        <div class="admin-card h-100">
                            <div class="d-flex justify-content-between mb-3">
                                <h1 class="f-20 w-500 text-white">CPR</h1>
                                <div class="dropdown sideNav-dropdown  ">
                                    <button class="p-0 m-0 dropdown-toggle f-14 text-gray w-500" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                      This Week
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
            
                            </div>
                            <div class="d-flex align-items-center justify-content-around ">
                                <div id="chart2"></div>
    
                            <div>
                                <div class="d-flex align-items-center ">
                                     <div class="color me-3" style="background-color: #FFA17D;">
    
                                     </div>
                                     <div>
                                        <h1 class="f-16 w-500 text-gray">
                                            Adult
                                        </h1>
                                        <p class="mb-0 pb-0 f-16 w-500 text-white">
                                            251K
                                        </p>
                                     </div>
                                </div>
    
                                <div class="d-flex align-items-center my-4">
                                    <div class="color me-3" style="background-color: #FFA17D;">
    
                                    </div>
                                    <div>
                                       <h1 class="f-16 w-500 text-gray">
                                        Childern
                                       </h1>
                                       <p class="mb-0 pb-0 f-16 w-500 text-white">
                                        176K
                                       </p>
                                    </div>
                               </div>
    
                               <div class="d-flex align-items-center ">
                                <div class="color me-3" style="background-color: #DF4308;">
    
                                </div>
                                <div>
                                   <h1 class="f-16 w-500 text-gray">
                                    Infant
                                   </h1>
                                   <p class="mb-0 pb-0 f-16 w-500 text-white">
                                    176K
                                   </p>
                                </div>
                           </div>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
           </div>

<?php

include "includes/footer.php";

?>