<?php
include "header.php";

// check if his user or not
if(isset($_SESSION['user_id'])) {
	header('Location: index.php');
}


$msg = '';

if(isset($_POST['login'])) {
  
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password ");
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  if($stmt->rowCount() > 0) {
    $row = $stmt->fetch();

     if($row['active'] == 1) {

	  	$_SESSION['user_id'] = $row['id'];
	  	$_SESSION['name'] = $row['name'];
	  	$_SESSION['avatar'] = $row['image'];

	  	  if($row['user_type'] == 1) 
	  	  	header("Location: dashboard/layout/index.php");
	  	  else
	  	    header("Location: index.php");
  	} else {
  		$msg = 'Please Activate your account ';
  	}

  } else {
  	$msg = 'Invalid Email / Password';
  }



}
?>


<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Login</h3>
					<p style="color:red"><br/><?php echo $msg; ?></p>
				</center>
            <form action="" method="POST">
				<div class="form-group">
				  	<label>Email</label>
				  	<input type="email" class="form-control" name="email" required="">
				</div>
				<div class="form-group">
				  	<label>Password</label>
				  	<input type="password" class="form-control" name="password" required="">
				</div>
				<div class="form-group">
					<a href="forget_pwd.php" style="font-size: 11px">Forget password ?</a><br/>
				  	<button type="submit" name="login" class="btn btn-primary" style="margin-top:10px">Login</button>
				</div>
			</form>
			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>