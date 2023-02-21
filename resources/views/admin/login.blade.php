<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin | Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/vertical-layout-light/style.css">

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('admin') }}/custom_css/custom.css">

    <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.png" />

    {{-- <style>
    .alert-dismissible .close {
      position: absolute;
      top: 50%;
      right: 10px;
      z-index: 2;
      padding: 0;
      color: inherit;
      transform: translateY(-50%);
    }
  </style> --}}
</head>

<body>
    <div class="loader">
        <img src="{{ asset('images/pre_loder/loading-loading-gif.gif') }}" alt="loading..." />
    </div>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <img src="{{ url('images/logo/0Bxq57pOfSNlX87Ur9jGquHIdW6PVsQuJlXcG2xe.png') }}"
                                    alt="0Bxq57pOfSNlX87Ur9jGquHIdW6PVsQuJlXcG2xe.png">
                            </div>
                            {{-- <h4>Hello! let's get started in admin panel</h4> --}}
                            <h4>Hello! Welcome to Gunma Halal Food admin panel ...</h4>

                            <h6 class="font-weight-light">Sign in to continue.</h6>

                            @if (Session('error_msg'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong> {{ Session('error_msg') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="pt-3" id="admin_login" action="javascript:">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email"
                                        placeholder="Enter your email" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        placeholder="Enter your password" name="password">
                                </div>
                                <div class="mt-3">
                                    <button
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            Keep me signed in
                                            <input type="checkbox" class="form-check-input">
                                            <i class="input-helper"></i></label>
                                        </label>

                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller action="{{ url('/admin/login') }}" method="POST"  -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#admin_login').submit(function() {
                $('.loader').show();
                var formData = $(this).serialize();
                $.ajax({
                    url: "login",
                    type: "post",
                    data: formData,
                    success: function(data) {
                        $('.loader').hide();
                        if(data.status == true){
                            $('body').html(data.view);
                            window.history.pushState(null, document.title = "Skydash Admin", "dashboard");
                            // window.history.replaceState(null, "null", window.location.href = "dashboard")
                        }else{
                            alert('Page Error')
                        }
                    },error: function(){
                        alert('Error')
                    }
                })
            });


            $('.loader').hide();
        })
    </script>

</body>

</html>
