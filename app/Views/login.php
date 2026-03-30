<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User System</title>
    <link rel="stylesheet" href="<?= base_url('style.css?v=10') ?>">
</head>
<body class="auth-body">

<body class="auth-body">

<div class="auth-card">
    <h2>Welcome Back!</h2>
    <p>Please enter your details to sign in.</p>

    <form id="loginForm" action="<?= site_url('login/authenticate') ?>" method="post">
        <div class="auth-group">
            <label for="username">Email Address</label>
            <input type="email" name="username" id="username" class="auth-input" placeholder="name@company.com" required>
            <span id="usernameError" class="auth-error"></span>
        </div>

        <div class="auth-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="auth-input" placeholder="••••••••" required>
            <span id="passwordError" class="auth-error"></span>
        </div>

        <button type="submit" class="auth-btn">Login Now</button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="<?= site_url('signup') ?>">Create account</a>
    </div>
</div>

<script src="<?= base_url('validation.js?v=10') ?>"></script>

</body>
</html>