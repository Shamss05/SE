<?php
require_once '../../Models/user.php';
require_once '../../Controllers/Authcontroller.php';
if(isset($_POST['submit'])){
$email=$_POST['email'];
$pass=$_POST['password'];

if(!empty($email)&&!empty($pass)){
$user=new User;
$user->email=$email;
$user->password=$pass;
$auth=new Authcontroller;
$auth->login($user);
}
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        .social-login-btn {
            width: 100%;
            margin-bottom: 1rem;
            text-align: left;
            padding: 0.5rem 1rem;
        }
        .social-login-btn i {
            margin-right: 1rem;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1rem 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider span {
            padding: 0 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-container">
                    <h2 class="text-center mb-4">Welcome Back</h2>
                    
                    <!-- Role Selection -->
                    <div class="btn-group w-100 mb-4" role="group">
                        <input type="radio" class="btn-check" name="userRole" id="travelerRole" checked>
                        <label class="btn btn-outline-primary" for="travelerRole">Traveler</label>
                        <input type="radio" class="btn-check" name="userRole" id="hostRole">
                        <label class="btn btn-outline-primary" for="hostRole">Host</label>
                    </div>
                    
                    <!-- Login Form -->
                    <form method="post" id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" id="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary w-100 mb-3">Log In</button>
                    </form>

                    <div class="text-center">
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                        <p class="mt-3 mb-0">Don't have an account? <a href="register.html" class="text-decoration-none">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html> 