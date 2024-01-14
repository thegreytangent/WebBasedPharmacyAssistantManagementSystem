<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/auth-header-footer-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 05:40:20 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    {{--    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />--}}
    <!--plugins-->
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"/>
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <title>{{config('app.name')}}</title>
</head>

<body class="">
<!--wrapper-->
<div class="wrapper">
    <header class="login-header shadow">
        <nav
            class="navbar navbar-expand-lg navbar-light rounded-0 bg-white fixed-top rounded-0 shadow-none border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('assets/images/logo-img.png')}}" alt=""/>
                </a>

            </div>
        </nav>
    </header>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card my-5 my-lg-0 shadow-none border">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="text-center mb-4">
                                    <h5 class="">Please log in to your account</h5>

                                </div>
                                @include('template.alert')
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="login">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Username:</label>
                                            <input type="text" name="username" class="form-control" />
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </div>
                                        </div>
                                        {{csrf_field()}}

                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <footer class="bg-white shadow-none border-top p-2 text-center fixed-bottom">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
</body>


<!-- Mirrored from codervent.com/rocker/demo/vertical/auth-header-footer-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 05:40:21 GMT -->
</html>
