<!-- application/views/super_admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Super Admin Dashboard</h1>
    
    <!-- Display a list of usernames as clickable links -->
    <ul>
        <?php foreach ($admins as $admin): ?>
            <li><a href="<?= base_url('superadmin/login_as/' . $admin->id); ?>"><?php echo $admin->username; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <!-- The link below was moved inside the loop -->
    <!-- <a href="<?= base_url('superadmin/login_as/' . $admin->id) ?>">Login as <?= $admin->username ?></a> -->

    <!-- Form for creating a new admin account -->
    <h2>Create a New Admin Account</h2>
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('superadmin/create_account_from_dashboard'); ?>
        <label for="new_username">Username:</label>
        <input type="text" name="new_username" required>
        <br>
        <label for="new_password">Password:</label>
        <input type="password" name="new_password" required>
        <br>
        <button type="submit">Create Account</button>
    </form>
    <p>
        <a href="<?= base_url('superadmin/logout'); ?>">Logout</a>
    </p>
    <?php
    $alert = session()->getFlashdata('alert');
    if ($alert) {
        echo '<div class="alert alert-danger">' . $alert . '</div>';
    }
    ?>
</body>
</html>
