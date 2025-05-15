<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-4">Ubah Profil</h4>
                    <form method="POST" action="../controllers/UserController.php" onsubmit="return confirmUpdate();">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (opsional)</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                                <label class="form-check-label" for="showPassword">
                                    Tampilkan Password
                                </label>
                            </div>
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>

                    <form method="POST" action="../controllers/UserController.php" onsubmit="return confirm('Yakin ingin menghapus akun?')" class="mt-3">
                        <button type="submit" name="delete" class="btn btn-danger w-100">Hapus Akun</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="dashboard.php">← Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pw = document.getElementById("password");
    pw.type = pw.type === "password" ? "text" : "password";
}

function confirmUpdate() {
    return confirm("Apakah Anda yakin ingin menyimpan perubahan profil?");
}
</script>
</body>
</html>
