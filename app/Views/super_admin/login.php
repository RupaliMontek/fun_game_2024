<!-- application/views/super_admin/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #45e049;
        }

        p {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Super Admin Logissssssnsss</h1>
    <?php if (!empty(validation_errors())) : ?>
    <div style="color: red;">
        <?php foreach (explode(PHP_EOL, validation_errors()) as $error) : ?>
            <?= $error ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
    <?php echo form_open('superadmin/login'); ?>
    
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <?php if(isset($error)) echo '<p style="color: red;">' . $error . '</p>'; ?>
</body>
</html>

