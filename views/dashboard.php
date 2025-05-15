<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Selamat datang, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h4>
    </div>
    <img src="../images/Images.jpg" alt="Profile Image" class="mb-3" style="max-width:150px; display:block;">
    <a href="profile.php" class="btn btn-outline-primary me-2">Ubah Profil</a>
    <a href="../logout.php" class="btn btn-outline-danger">Logout</a>
</div>
</body>
</html>