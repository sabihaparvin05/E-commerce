<html>

<head>
    @notifyCss
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">

    <style>
    .login-dark {height: 1000px;background-size: cover;position: relative;}.login-dark form { max-width: 320px;width: 90%;background-color: #1e2833;padding: 40px;border-radius: 4px;transform: translate(-50%, -50%); position: absolute; top: 50%;left: 50%;color: #fff; box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.2); }.login-dark .illustration {text-align: center;padding: 15px 0 20px;font-size: 100px; color: #2980ef;}.login-dark form .form-control {background: none;border: none;border-bottom: 1px solid #434a52;border-radius: 0;box-shadow: none;outline: none;color: inherit;}.login-dark form .btn-primary {background: #214a80;border: none;border-radius: 4px;padding: 11px;box-shadow: none;margin-top: 26px;text-shadow: none;outline: none;}.login-dark form .btn-primary:hover,.login-dark form .btn-primary:active {background: #214a80;outline: none;}.login-dark form .forgot {display: block;text-align: center;font-size: 12px;color: #6f7a85;opacity: 0.9;text-decoration: none;}.login-dark form .forgot:hover,.login-dark form .forgot:active {opacity: 1;text-decoration: none;}.login-dark form .btn-primary:active {transform: translateY(1px);}
    </style>

</head>

<body>
    @include('notify::components.notify')

    <div class="login-dark" style="height: 695px;">
        <form action="{{route('admin.login.post')}}" method="post">
            @csrf
            <div class="illustration">
                <h1 class="m-0 text-white">Ecommerce</h1>
                <h2 class="text-blue">Admin Login</h2>
            </div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
            <div class="form-group"><button class="btn btn-success btn-block">Log In</button></div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    @notifyJs
</body>

</html>