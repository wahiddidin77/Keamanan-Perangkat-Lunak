<?php
session_start();

?>
<?php
include "../koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$err = array();
if (isset($_POST['submit'])) {
  $email_user = $_POST['email_user'];
  $password = md5($_POST["password_user"]);
  $joinlogin = $_POST['jam_login'];
  $cek_user = mysqli_query($conn, "SELECT * FROM user WHERE email_user='$email_user' and password_user='$password'");
  $query = mysqli_query($conn, "UPDATE user SET data_login ='$joinlogin' WHERE email_user='$email_user' and password_user='$password'");
  $row      = mysqli_num_rows($cek_user);

  if ($row == 1) {
    $fetch_pass = mysqli_fetch_assoc($cek_user);
    $cek_pass = $fetch_pass['password_user'];
    if ($cek_pass != $password) {
      echo "<script>alert('password salah');</script>";
    } else {
      $_SESSION['log'] =  $fetch_pass;
      $_SESSION['email_user'] = $email_user;
      if ($query) {
      }
      echo "<script>alert('login Berhasil');document.location.href='../index.php';</script>";
    }
  } else {
    echo "<script>alert('email/password salah');</script>";
  }
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login Form - </title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
				</div>

        <a href="" class="text-light">Forgot Password</a>
        <div class="button">
        </div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
	
</body>
</html>
