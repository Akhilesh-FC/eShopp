<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://i.postimg.cc/SRbN0Qxs/bg.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .form-2-wrapper {
            background: rgba(16, 18, 27, 0.4); /* Background color with transparency */
            backdrop-filter: blur(20px);
            padding: 50px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .logo h2 {
            font-size: 2rem;
            color: #b400ff;
            text-align: center;
        }

        h2.text-center {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #333;
            text-align: center;
        }

        .form-control {
            padding: 11px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            background-color: transparent;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }

        .form-control:focus {
            box-shadow: none !important;
            outline: 0px !important;
            background-color: transparent;
        }

        .login-btn {
            background: #ff76ba;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background: #ff5a9c;
        }

        .register-test a {
            color: #fff;
        }

        .register-test a:hover {
            text-decoration: underline;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 15px 0;
        }

        .input-box input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn {
            width: 100%;
            height: 45px;
            background-color: #fff;
            border: none;
            outline: none;
            margin-top: 20px;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #ff76ba;
            color: #fff;
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
            color: #fff;
            text-align: center;
            font-weight: 600;
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
                    <div class="logo">
                        <h2>Logo</h2>
                    </div>
                    <h2 class="text-center mb-4">Sign Into Your Account</h2>
                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 input-box">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="mb-3 input-box">
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
                    </form>

                    <!-- Register Link -->
                    <p class="text-center register-test mt-3">Don't have an account? <a href="register-3.html">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>
