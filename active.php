<?php
include "header.php";

// check if his user or not
if(isset($_SESSION['user_id'])) {
	header('Location: index.php');
}


$msg = '';
if(isset($_POST['active'])) {   
   $activation_key = $_POST['activation_key'];
   $stmt = $conn->prepare("SELECT * FROM `users` WHERE activation_key = :activation_key AND active = 0 ");
   $stmt->bindParam(':activation_key', $activation_key);
   $stmt->execute();

   if($stmt->rowCount() > 0) {
      $stmt2 = $conn->prepare("UPDATE `users` SET active = 1, activation_key = NULL 
      	      WHERE activation_key = :activation_key ");
      $stmt2->bindParam(':activation_key', $activation_key);

      if($stmt2->execute()) {
      	header('Location: login.php');
      } else {
      	$msg = 'Something went wrong';
      }
   } else {
     $msg = 'Invalid Activation key';
   }
}
?>

<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Activation<br/><br/></h3>
					<p><?php echo $msg; ?></p>
				</center>
            <form action="" method="POST">
				<div class="form-group">
				  	<label>Activation Key</label>
				  	<input type="text" class="form-control" name="activation_key" required="">
				</div>
				<div class="form-group">
				  	<button type="submit" name="active" class="btn btn-primary">Activation</button>
				</div>
			</form>
			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>