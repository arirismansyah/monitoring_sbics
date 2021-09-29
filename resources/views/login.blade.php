<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="/images/logo.svg">
                            </div>
                            <h5>Hallo! Selamat Datang di Web Monitoring SBICS</h4>
                                <h6 class="font-weight-light">BPS Provinsi Sumatera Selatan</h6>
                                <form class="pt-3" method="POST" action="login">
                                    @csrf
                                    <div class="form-group">
                                        <input required class="form-control form-control-lg" id="input-username"
                                            placeholder="Username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <input required type="password" class="form-control form-control-lg"
                                            id="input-password" placeholder="Password" name="password">
                                    </div>
                                    <div class="mt-3">
                                        <button
                                            class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">LOGIN</a>
                                    </div>
                                </form>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input id="showpass" type="checkbox" class="form-check-input"> Show password
                                        </label>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center align-items-center">
                                    @include('flash-message')
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/misc.js"></script>
    <!-- endinject -->

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {
            $('#showpass').click(function(e) {
                if ($('#showpass').prop('checked') == true) {
                    //do something
                    $('#input-password').attr("type", "text");
                } else {
                    $('#input-password').attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
