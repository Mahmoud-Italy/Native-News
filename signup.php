<?php
include "header.php";

// check if his user or not
if(isset($_SESSION['user_id'])) {
	header('Location: index.php');
}

$msg = '';

if(isset($_POST['signup'])) {
   
   $name = strip_tags($_POST['name']);
   $email = strip_tags($_POST['email']);
   $password = sha1($_POST['password']);
   $image = 'uploads/avatar.jpg';
   $activation_key = rand();

   // check email not exists
   $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email ");
   $stmt->bindParam(':email', $email);
   $stmt->execute();

   if($stmt->rowCount() == 0) {
     
     $stmt2 = $conn->prepare("INSERT INTO `users` (name,image,email,password,activation_key)
     VALUES (:name,:image,:email,:password,:activation_key) ");
     $stmt2->bindParam(':name',  $name);
     $stmt2->bindParam(':image', $image);
     $stmt2->bindParam(':email', $email);
     $stmt2->bindParam(':password', $password);
     $stmt2->bindParam(':activation_key', $activation_key);
     if($stmt2->execute()) {
     	header('Location: active.php');
     } else {
     	$msg = "Something went wrong";
     }

   } else {
   	  $msg = "Email already exists";
   }


}
?>

<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Signup</h3>
					<p style="color:red"><?php echo $msg; ?></p>
				</center>
            <form action="" method="POST">
				<div class="form-group">
				  	<label>Name</label>
				  	<input type="text" class="form-control" name="name" required="">
				</div>
				<div class="form-group">
				  	<label>Email</label>
				  	<input type="email" class="form-control" name="email" required="">
				</div>
				<div class="form-group">
				  	<label>Password</label>
				  	<input type="password" class="form-control" name="password" required="">
				</div>
				<div class="form-group">
				  	<button type="submit" name="signup" class="btn btn-primary">Signup</button>
				</div>
			</form>
			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>