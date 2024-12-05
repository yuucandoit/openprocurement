<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body>
    <div id="auth">

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
                <div class="container-fluid">
                    <img class="bg-img-cover bg-center" src="{{ asset('assets/images/BG-E-Procurement-Intek.jpg') }}"
                        alt="looginpage">
                    <div class="row">
                        <div class="container mt-4">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ session('error') }}
                                </div>
                            @elseif ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                    <ul>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif(session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        {{ session()->get('message') }}
                                    </div>
                            @endif
                        </div>
                        <div class="col-xl-7"></div>
                        <div class="col-xl-5 p-0">
                            <div class="login-card column">
                                <form class="theme-form login-form needs-validation" method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="logo-login" style="height: 65px; text-align: center;">
                                        <img src="{{ asset('assets/images/Logo-Intek-8K.png') }}" alt="icon">
                                    </div>
                                    @csrf
                                    <h5 style="font-size: 25px;">
                                        Reset Password
                                    </h5>
                                    {{-- Email --}}
                                    <div class="form-group">
                                        <label style="">Email Address</label>
                                        <div class="input-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" style="pointer-events: none; background-color:lightgrey;"> 
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="email">
                                                {{ $message }}
                                            </span>
                                        </div>
                                    @enderror
                                    {{-- Password --}}
                                    <div class="form-group">
                                        <label style="">{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" required autocomplete="new-password">
                                            <div class="input-group-append">

                                                <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                                <span id="btn-password-1" onclick="change_1()" class="input-group-text">

                                                    <!-- icon mata bawaan bootstrap  -->
                                                    <svg width="1em" height="1.5em" viewBox="0 0 16 16"
                                                        class="bi bi-eye-fill" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="password">
                                                {{ $message }}
                                            </span>
                                        </div>
                                    @enderror

                                    {{-- Confirm Password --}}
                                    <div class="form-group">
                                        <label style="">{{ __('Confirm Password') }}</label>
                                        <div class="input-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                            
                                            <div class="input-group-append">
                                                <span id="btn-password-confirm" onclick="change_2()" class="input-group-text">
                                                    <!-- icon mata bawaan bootstrap  -->
                                                    <svg width="1em" height="1.5em" viewBox="0 0 16 16"
                                                        class="bi bi-eye-fill" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit"
                                            style="font-size: 14px;">Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('../assets/js/script.js') }}"></script>
    
    <script>
         // membuat fungsi change
        function change_1() {
            var x = document.getElementById('password').type;
            if (x == 'password') {
                document.getElementById('password').type = 'text';
                document.getElementById('btn-password-1').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>`;
            } else {
                document.getElementById('password').type = 'password';
                document.getElementById('btn-password-1').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>`;
            }
        }

        function change_2() {
            var x = document.getElementById('password-confirm').type;
            if (x == 'password') {

                //ubah form input password menjadi text
                document.getElementById('password-confirm').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('btn-password-confirm').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>`;
            } else {

                //ubah form input password menjadi text
                document.getElementById('password-confirm').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('btn-password-confirm').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>`;
            }
            }
    </script>
</body>

</html>
