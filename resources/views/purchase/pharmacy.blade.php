<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/ecommerce-add-new-products.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 05:23:15 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png"/>
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet"/>
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="assets/css/dark-theme.css"/>
    <link rel="stylesheet" href="assets/css/semi-dark.css"/>
    <link rel="stylesheet" href="assets/css/header-colors.css"/>
    <link rel="stylesheet" href="{{asset('assets/npm/select2%404.1.0-rc.0/dist/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css')}}"/>


    <title>Pharmacist</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->

    <!--end sidebar wrapper -->
    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center" style="position: static ">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>


                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center gap-1"></ul>
                </div>
                <div class="user-box dropdown px-3">
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                        <div class="user-info">
                            <p class="user-name mb-0">Pauline Seitz</p>
                            <p class="designattion mb-0">Pharmacist</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:"><i
                                    class="bx bx-download fs-5"></i><span>Settings</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:"><i
                                    class="bx bx-log-out-circle"></i><span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper" style="margin-left: auto">
        <div class="page-content">


            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Purchases</h5>
                    <hr/>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="row text-center">
                                    <div class="col col-8"> {!!  $medicines !!}</div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="qty" placeholder="Quantity">
                                    </div>


                                    <div class="col">
                                        <button id="add_to_table" type="button" class="btn btn-primary px-4">Add
                                        </button>
                                    </div>
                                </div>


                                <br/> <br/> <br/>


                                <div class="card">
                                    <div class="card-body">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">Medicine name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table-medicine">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <form action="" id="purchase_form">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label">Date:</label>
                                                <input type="date" id="date" name="date" placeholder="Date" class="form-control"  />

                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCompareatprice" class="form-label">Receipt Number:</label>
                                                <input type="text" id="receipt_number" value="eradf" readonly name="receipt_number" placeholder="Receipt Number" class="form-control"  />
                                            </div>
                                            <div class="col-12">
                                                <label for="inputCostPerPrice" class="form-label">Customer Name:</label>
                                                <input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" class="form-control"  />
                                            </div>

                                            <div class="col-12">
                                                <label for="inputVendor" class="form-label">Total Amount:</label>
                                                <input type="text" id="amount" name="amount" placeholder="Amount" class="form-control"  />
                                            </div>
                                            <div class="col-12">
                                                <label for="inputVendor" class="form-label">Cash:</label>
                                                <input type="text" id="cash" name="cash" placeholder="Cash" class="form-control"  />
                                            </div>
                                            <div class="col-12">
                                                <label for="inputVendor" class="form-label">Change:</label>
                                                <input type="text" id="change" name="change" placeholder="Change" class="form-control"  />
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button  type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div><!--end row-->
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

</div>
<!--end wrapper-->


<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>


<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('assets/npm/select2%404.1.0-rc.0/dist/js/select2.min.js')}}"></script>
<script src="assets/plugins/select2/js/select2-custom.js"></script>
<script src="{{asset('assets/scripts/customer_purchase.js')}}"></script>


</body>


</html>
