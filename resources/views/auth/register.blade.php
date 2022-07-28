<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
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
                    <div class="logo-register">
                        <img src="assets/images/logo.svg" alt="icon">
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                    <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-0">
                            <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror"
                                name="name" style="border-radius: 10px" placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group position-relative has-icon-left mt-4 mb-0">
                            <input required asp-for="email" type="email" name="email"
                                class=" form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class='mt-1'>
                                <span class=" text-danger" asp-validation-for="email">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror



                        <div class="form-group position-relative has-icon-left mt-4 mb-0">
                            <input required asp-for="password" type="password" name="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                style="border-radius: 10px" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        @error('password')
                            <div class='mt-1'>
                                <span class=" text-danger" asp-validation-for="email">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror


                        <div class="form-group position-relative has-icon-left mt-4 mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" style="border-radius: 10px" placeholder="Confirm Password"
                                required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}"
                                class="font-bold">Log
                                in</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
