<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://i.ibb.co/yFWzhXd/login-3-bg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            font-family: 'Roboto', sans-serif;
        }

        .form-2-wrapper {
            background: rgba(157, 0, 255, 0.16);
            padding: 50px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .logo h2 {
            font-size: 2rem;
            color: #b400ff;
        }

        h2.text-center {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        .form-control {
            padding: 11px;
            border: 2px solid #405c7cb8;
            border-radius: 30px;
            background-color: transparent;
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-control:focus {
            box-shadow: none !important;
            outline: 0px !important;
            background-color: transparent;
        }

        .login-btn {
            background: #b400ff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background: #9b00e6;
        }

        .social-login button {
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
        }

        .social-login .btn-google {
            background-color: #db4437;
            color: white;
            border: none;
        }

        .social-login .btn-facebook {
            background-color: #3b5998;
            color: white;
            border: none;
        }

        .register-test a {
            color: #000;
        }

        .register-test a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <!-- Left Blank Side -->
            <div class="col-lg-6"></div>

            <!-- Right Side Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="form-2-wrapper">
                    <div class="logo text-center">
                        <h2>Logo</h2>
                    </div>
                    <h2 class="text-center mb-4">Sign Into Your Account</h2>
                    <form action="#">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                <a href="forget-3.html" class="text-decoration-none float-end">Forget Password</a>
                            </div>
                        </div>
                        <button type="submit" class="btn login-btn w-100 mb-3">Login</button>
                        <div class="social-login mb-3">
                            <h5 class="text-center mb-3">Social Login</h5>
                            <button class="btn btn-google mb-3"><i class="fa-brands fa-google text-danger"></i> Sign With Google</button>
                            <button class="btn btn-facebook mb-3"><i class="fa-brands fa-facebook-f text-white"></i> Sign With Facebook</button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <p class="text-center register-test mt-3">Don't have an account? <a href="register-3.html" class="text-decoration-none">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>
