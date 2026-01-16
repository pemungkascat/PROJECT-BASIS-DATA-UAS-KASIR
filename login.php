<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Kasir CCTV</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#1a1d29;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.login-box{
    background:white;
    padding:35px;
    width:350px;
    border-radius:8px;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}
h2{text-align:center;margin-bottom:25px}
.form-group{margin-bottom:20px}
label{font-size:14px;font-weight:600}
input{
    width:100%;
    padding:10px;
    border:1px solid #ddd;
    border-radius:5px;
    margin-top:5px;
}
button{
    width:100%;
    padding:12px;
    background:#4CAF50;
    border:none;
    color:white;
    font-weight:bold;
    border-radius:5px;
    cursor:pointer;
}
button:hover{background:#45a049}
.error{
    background:#f8d7da;
    color:#721c24;
    padding:10px;
    border-radius:5px;
    margin-bottom:15px;
    text-align:center;
}
</style>
</head>

<body>
<div class="login-box">
    <h2>🔐 Login Kasir</h2>

    <?php if(isset($_SESSION['error'])){ ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php } ?>

    <form method="POST" action="proses_login.php">
        <div class="form-group">
            <label>Nama Kasir</label>
            <input type="text" name="nama_kasir" required>
        </div>
        <div class="form-group">
            <label>Password (Nomor Telepon)</label>
            <input type="password" name="telepon" required>
        </div>
        <button type="submit">LOGIN</button>
    </form>
</div>
</body>
</html>
