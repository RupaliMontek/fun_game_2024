
    <title>Change Password by shweta</title>
    <div class="col-auto col-md-9">
    <div class="container mt-5">
    <h1>Change Password</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <?php echo form_open('superadmin/update_password'); ?>
        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" required>
        <br>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        <br>
        <button type="submit">Change Password</button>
    </form>
    </div>
    </div>
