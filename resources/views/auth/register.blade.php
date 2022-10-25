<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/logoSII.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoSII.png') }}" type="image/x-icon">
    <title>Solusi Intek Indonesia </title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/sweetalert2.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('../assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/responsive.css') }}">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid p-0">
            <img class="bg-img-cover bg-center" src="{{ asset('assets/images/BG-E-Procurement-Intek.jpg') }}"
                alt="looginpage">
            <div class="row m-0">
                <div class="col-xl-7"></div>
                <div class="col-xl-5 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <h4
                                style="text-align: center; font-family: 'Times New Roman', Times, serif; font-size: 27px;">
                                Create your account</h4>
                            <h6 style="text-align: center;" style="font-family: 'Times New Roman', Times, serif;">Enter
                                your personal details to create account</h6>
                            <div class="form-group">
                                <label style="font-family: 'Times New Roman', Times, serif;">Your Name</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-family: 'Times New Roman', Times, serif;">Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-email"></i></span>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email" required placeholder="Test@gmail.com">
                                </div>
                            </div>
                            @error('email')
                                <div class='mt-1'>
                                    <span class=" text-danger" asp-validation-for="email">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror
                            <div class="form-group">
                                <label style="font-family: 'Times New Roman', Times, serif;">Password</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-lock"></i></span>
                                    <input class="form-control  @error('password') is-invalid @enderror"
                                        type="password" name="password" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            @error('password')
                                <div class='mt-1'>
                                    <span class=" text-danger" asp-validation-for="email">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror

                            <div class="form-group">
                                <label style="font-family: 'Times New Roman', Times, serif;">Confirm Password</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-lock"></i></span>
                                    <input class="form-control  @error('password_confirmation') is-invalid @enderror"
                                        type="password" name="password_confirmation" required=""
                                        placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class='mt-1'>
                                    <span class=" text-danger" asp-validation-for="email">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1"
                                        style="font-family: 'Times New Roman', Times, serif;">Agree with <span
                                            style="font-family: 'Times New Roman', Times, serif;">Privacy
                                            Policy
                                        </span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                            </div>
                            <p style="font-family: 'Times New Roman', Times, serif;">Already have an account?<a
                                    class="ms-2" href="{{ route('login') }}"
                                    style="font-family: 'Times New Roman', Times, serif;">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="{{ asset('../assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('../assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('../assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('../assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('../assets/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('../assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('../assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('../assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>
