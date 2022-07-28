<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="logo-login">
                        <img src="assets/images/logo.svg" alt="icon">
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-0">
                            <input required asp-for="email" type="email" name="email"
                                class=" form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class='mt-1'>
                                <span class=" text-danger" asp-validation-for="email">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                        <div class="form-group position-relative has-icon-left mt-4 mb-4 ">
                            <input type="password" name="password" id="password" class=" form-control form-control-xl"
                                placeholder="Password" required>
                            <span class="eye-login">
                                <h3 class="bi bi-eye" aria-hidden="true" id="eye" onclick="toggle()"></h3>
                            </span>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>

                        </div>
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                                class="font-bold">Sign up</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    {{-- <img src="assets/images/logo.svg" alt="icon"> --}}
                </div>
            </div>
        </div>

    </div>
    <script>
        var state = false;

        function toggle() {
            if (state) {
                document.getElementById(
                    "password").
                setAttribute("type", "password");
                document.getElementById("eye").style.color = '#b8bbc4'
                state = false;
            } else {
                document.getElementById(
                    "password").
                setAttribute("type", "name");
                document.getElementById("eye").style.color = '#5887ef'
                state = true;
            }
        }
    </script>
</body>

</html>
