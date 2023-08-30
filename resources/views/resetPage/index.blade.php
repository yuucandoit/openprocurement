<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <title>Reset Password</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
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
    <!-- page-wrapper Start-->
    <section>

      <div class="container-fluid p-0">
        <img class="bg-img-cover bg-center" src="{{ asset('assets/images/BG-E-Procurement-Intek.jpg') }}"alt="looginpage">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
        @elseif ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <div class="row m-0">
          <div class="col-12 p-0">
            <div class="login-card">
              <div class="login-main">
                <form class="theme-form login-form" action="{{ route('pushReset') }}" method="POST">
                    @csrf

                  <h4 class="mb-3">Reset Password</h4>
                  <h6>Please Reset Your Password</h6>
                  <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                      <input class="form-control" id="pass" type="password" name="password" required="" placeholder="*********">
                      <div class="input-group-append">
                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                            <span id="mybutton" onclick="change()" class="input-group-text">

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
                    <label>Confirm Password</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                      <input class="form-control" id="confirmPass" type="password" name="password_confirmation" required="" placeholder="*********">
                      <div class="input-group-append">
                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                            <span id="mybutton2" onclick="change2()" class="input-group-text">

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
                    <button class="btn btn-primary btn-block" type="submit">Done</button>
                  </div>
                </form>
              </div>
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('../assets/js/script.js') }}"></script>
    <!-- login js-->
    <script>
        function change() {
        var x = document.getElementById('pass').type;
            if (x == 'password') {
                document.getElementById('pass').type = 'text';
                document.getElementById('mybutton').innerHTML =`<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                </svg>`;
            } else {
                document.getElementById('pass').type = 'password';
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>`;
            }

        }

        function change2(){
            var y = document.getElementById('confirmPass').type;
            if(y == 'password') {
                document.getElementById('confirmPass').type = 'text';
                document.getElementById('mybutton2').innerHTML =`<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                </svg>`;
            }else {
                document.getElementById('confirmPass').type = 'password';
                document.getElementById('mybutton2').innerHTML =`<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>`;
            }
        }
    </script>
    <!-- Plugin used-->
  </body>
</html>
