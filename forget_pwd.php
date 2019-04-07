<?php
include "header.php";

// check if his user or not
if(isset($_SESSION['user_id'])) {
	header('Location: index.php');
}

$msg = '';

if(isset($_POST['forget'])) {
	$email = $_POST['email'];
    
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = :email ");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() > 0 ) {
    	// send mail with activation code
       
       $activation_key = rand();
       $stmt2 = $conn->prepare("UPDATE `users` SET `activation_key` = :activation_key 
       	WHERE email = :email ");
       $stmt2->bindParam(':activation_key', $activation_key);
       $stmt2->bindParam(':email', $email);
       $stmt2->execute();
       header("Location: change_pwd.php");

    } else {
    	$msg = "Invalid email address";
    }

}
?>


<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Forget Password</h3>
					<p style="color:red"><br/><?php echo $msg; ?></p>
				</center>


            <form action="" method="POST">
				<div class="form-group">
				  	<label>Email</label>
				  	<input type="email" class="form-control" name="email" required="">
				</div>
				<div class="form-group">
					<a href="login.php" style="font-size: 11px">back to login ?</a><br/>
				  	<button type="submit" name="forget" class="btn btn-primary" style="margin-top:10px">Submit</button>
				</div>
			</form>


			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>