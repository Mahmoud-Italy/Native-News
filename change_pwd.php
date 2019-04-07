<?php
include "header.php";

// check if his user or not
if(isset($_SESSION['user_id'])) {
	header('Location: index.php');
}

$msg = '';

if(isset($_POST['submit'])) {
	$activation_key = $_POST['activation_key'];
	$new_pwd = $_POST['new_pwd'];
	$con_new_pwd = $_POST['con_new_pwd'];
      
      // check if password is matching...
	if($new_pwd != $con_new_pwd) {
		$msg = 'Passwords Not Match';
	} else {
      
      $stmt = $conn->prepare("SELECT * FROM `users` WHERE `activation_key` = :activation_key ");
      $stmt->bindParam(':activation_key', $activation_key);
      $stmt->execute();
      
      if($stmt->rowCount() > 0) {
           $password = sha1($new_pwd);
           // update on table users and set activation_key is NULL
      	$stmt2 = $conn->prepare("UPDATE `users` SET `activation_key` = NULL, `password` = :password WHERE `activation_key` = :activation_key ");
      	$stmt2->bindParam(':password',$password);
      	$stmt2->bindParam(':activation_key', $activation_key);

      	if($stmt2->execute()) {
      		header('Location: login.php');
      	} else {
      		$msg = 'Something went wrong';
      	}

      } else {
      	 $msg = 'Activation key not valid';
      }
}

	

}
?>


<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Change Password</h3>
					<p style="color:red"><br/><?php echo $msg; ?></p>
				</center>


            <form action="" method="POST">
				<div class="form-group">
				  	<label>Activation Key</label>
				  	<input type="text" class="form-control" name="activation_key" required="">
				</div>
				<div class="form-group">
				  	<label>New Password</label>
				  	<input type="password" class="form-control" name="new_pwd" required="">
				</div>
				<div class="form-group">
				  	<label>Confirm New Password</label>
				  	<input type="password" class="form-control" name="con_new_pwd" required="">
				</div>
				<div class="form-group">
				  	<button type="submit" name="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
				</div>
			</form>


			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>