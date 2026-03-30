<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Home</title>
    <link rel="stylesheet" href="<?= base_url('style.css?v=1') ?>">
</head>
<body>

<div class="wrapper">
    <!-- LEFT SIDE: ACCCOUNT MANAGEMENT -->
    <div class="left-side">
        <h1>Welcome Home! </h1>
        <p>Hello, <b><?= session()->get('username') ?></b>!</p>
        <p>You have successfully logged into</p>



        <div class="update-box">
            <h3>Update Username</h3>
            <form action="<?= site_url('home/update') ?>" method="post">
                <label>New Username:</label><br>
                <input type="text" name="new_username" placeholder="Type new name here" required>
                <button type="submit">Save New Name</button>
            </form>
        </div>

        <div class="delete-box">
            <h3 style="color: #f02849;">Delete User</h3>
            <form action="<?= site_url('home/delete') ?>" method="post">
                <button type="submit" onclick="return confirm('Are you 100% sure?')"
                        class="delete-btn">
                    Delete My Account
                </button>
            </form>
        </div>

        <br><br><hr>
        <a href="<?= site_url('logout') ?>" class="logout-link">Logout</a>
    </div>

    
    <div class="right-side">
        <h2>All Registered Users 👥</h2>
        <p>This is a live table of everyone in your database.</p>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                    
                        <a href="<?= site_url('home/edit/'.$user['id']) ?>" style="color: blue;">Edit</a> | 
                        <a href="<?= site_url('home/delete_user/'.$user['id']) ?>" 
                           style="color: red;" onclick="return confirm('Delete this user?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- TEACHER: This shows the Page Numbers (1, 2, 3...) -->
        <div class="my-pager">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

</body>
</html>
