<!-- app/Views/super_admin/profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Profile</title>
</head>
<body>
    <h1>Super Admin Profile</h1>

    <!-- Display Super Admin Details -->
    <p>Name: <?= $superAdminDetails->first_name . ' ' . $superAdminDetails->last_name ?></p>
    <p>Username: <?= $superAdminDetails->username ?></p>
    <p>Role: <?= $superAdminDetails->role ?></p>

    <!-- Display Super Admin Image -->
    <img src="<?= base_url('uploads/profile/' . $superAdminDetails->profile_image) ?>" alt="Profile Image">

    <!-- Link to Edit Profile -->
    <a href="<?= base_url('superadmin/profile/edit') ?>">Edit Profile</a>
</body>
</html>
