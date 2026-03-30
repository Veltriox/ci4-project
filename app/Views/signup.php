<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - User System</title>
    <link rel="stylesheet" href="<?= base_url('style.css?v=11') ?>">
</head>
<body class="auth-body" style="height: auto; padding: 40px 0;">

<div class="auth-card" style="max-width: 550px;">
    <h2>Get Started</h2>
    <p>Create your professional account today.</p>

    <form id="signupForm" action="<?= site_url('signup/register') ?>" method="post">
        
        <div class="auth-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="auth-input" placeholder="Choose a unique username" required>
            <span id="usernameError" class="auth-error"></span>
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="auth-group" style="flex: 1;">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="auth-input" placeholder="First Name" required>
                <span id="firstNameError" class="auth-error"></span>
            </div>
            <div class="auth-group" style="flex: 1;">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="auth-input" placeholder="Optional">
                <span id="lastNameError" class="auth-error"></span>
            </div>
        </div>

        <div class="auth-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="auth-input" placeholder="10-digit Mobile Number" required>
            <span id="phoneError" class="auth-error"></span>
        </div>

        <div class="auth-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="auth-input" placeholder="email@example.com" required>
            <span id="emailError" class="auth-error"></span>
        </div>

        <div class="auth-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="auth-input" placeholder="Minimum 5 characters" required>
            <span id="passwordError" class="auth-error"></span>
        </div>

        <button type="submit" class="auth-btn">Register Account</button>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="<?= site_url('login') ?>">Login here</a>
    </div>
</div>

<script src="<?= base_url('validation.js?v=11') ?>"></script>

</body>
</html>
