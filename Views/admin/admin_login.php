<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/Authcontroller.php';
if(isset($_POST['submit'])){
$email=$_POST['email'];
$pass=$_POST['password'];

if(!empty($email)&&!empty($pass)){
$admins=new admins;
$admins->email=$email;
$admins->password=$pass;
$auth=new Authcontroller;
$auth->login_admin($admins);
}
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }
        .admin-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #0d6efd;
        }
        .btn-primary {
            padding: 0.6rem 1.2rem;
            font-weight: 500;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0;
        }
        .row {
            width: 100%;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-container">
                    <div class="text-center">
                        <i class="fas fa-user-shield admin-icon"></i>
                        <h2 class="mb-4">Admin Login</h2>
                    </div>
                    <form id="adminLoginForm" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input name="email" type="text" class="form-control" id="username" required>
                            </div>
                            <div class="error-message" id="usernameError"></div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input name="password" type="password" class="form-control" id="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <div class="error-message" id="passwordError"></div>
                        </div>
                        <div class="d-grid">
                            <button name="submit" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
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

        // Form validation
function validateForm(event) {
    event.preventDefault();
    let isValid = true;
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    // Reset error messages
    usernameError.style.display = 'none';
    passwordError.style.display = 'none';
    username.classList.remove('is-invalid');
    password.classList.remove('is-invalid');

    // Validate username
    if (!username.value.trim()) {
        usernameError.textContent = 'Username is required';
        usernameError.style.display = 'block';
        username.classList.add('is-invalid');
        isValid = false;
    }

    // Validate password
    if (!password.value) {
        passwordError.textContent = 'Password is required';
        passwordError.style.display = 'block';
        password.classList.add('is-invalid');
        isValid = false;
    }

    if (isValid) {
        document.getElementById('adminLoginForm').submit(); // ✅ Submit form manually
    }
}

    </script>
</body>
</html> 