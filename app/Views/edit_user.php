<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="<?= base_url('style.css?v=4') ?>">
</head>
<body>

<div class="container" style="width: 450px;">
    <h2>Edit User #<?= $user['id'] ?></h2>
    <p>Change the details for <b><?= $user['username'] ?></b></p>

    <form action="<?= site_url('home/save/'.$user['id']) ?>" method="post" id="editUserForm">
        
        <label>Username:</label><br>
        <input type="text" name="username" id="username" value="<?= $user['username'] ?>" required><br><br>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label>First Name:</label><br>
                <input type="text" name="first_name" id="first_name" value="<?= $user['first_name'] ?>" required>
            </div>
            <div style="flex: 1;">
                <label>Last Name:</label><br>
                <input type="text" name="last_name" id="last_name" value="<?= $user['last_name'] ?>">
            </div>
        </div><br>

        <label>Phone Number:</label><br>
        <span id="phone-error" class="error-text" style="display: none;"></span>
        <input type="text" name="phone" id="phone" value="<?= $user['phone'] ?>" required><br><br>

        <label>Email Address:</label><br>
        <span id="email-error" class="error-text" style="display: none;"></span>
        <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required><br><br>

        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="<?= site_url('home') ?>" style="color: grey;">Cancel and Go Back</a>
</div>

<script src="<?= base_url('validation.js?v=7') ?>"></script>

</body>
</html>
