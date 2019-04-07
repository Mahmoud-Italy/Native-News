<?php
include "header.php";
$msg = '';

// check if his user or not
if(!isset($_SESSION['user_id'])) {
	header('Location: index.php');
}

// display all data
$stmt = $conn->prepare("SELECT * FROM `users` WHERE id = :id ");
$stmt->bindParam(':id',$_SESSION['user_id']);
$stmt->execute();
$row = $stmt->fetch();

// update my profile
if(isset($_POST['submit'])) {

	// uploads images
   if($_FILES["image"]["tmp_name"]) {
       $image = date('Y-m-d-H-i-s').'.png';
       $saved = 'uploads/profiles/'.$image;
       $target_dir = "uploads/profiles/";
       $target_file = $target_dir . $image; 
       move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
   } else {
       $saved = $row['image'];
   }

	$name = $_POST['name'];
	$email = $_POST['email'];

       // check if password changed or not
	  if(!empty($_POST['password'])) {
	     $password = sha1($_POST['password']);
	  } else {
	  	 $password = $row['password'];
	  }

	  $stmt2 = $conn->prepare("UPDATE `users` SET name = :name, image = :image, email = :email, password = :password  WHERE id=:id");
	  $stmt2->bindParam(':name', $name);
	  $stmt2->bindParam(':image', $saved);
	  $stmt2->bindParam(':email', $email);
	  $stmt2->bindParam(':password', $password);
	  $stmt2->bindParam(':id', $_SESSION['user_id']);

	  if($stmt2->execute()) {
        $msg = 'Profile Updated Success';
        $_SESSION['name'] = $name;
        $_SESSION['avatar'] = $saved;
        header("Location: profile.php");
	  } else {
	  	$msg = 'Profile Not Updated';
	  }

}


?>



<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Profile</h3>
					<p style="color:red"><br/><?php echo $msg; ?></p>
				</center>


            <form action="" method="POST" enctype="Multipart/form-data">
            	<div class="form-group"> 
				  	<label>Image</label>
				  	<br/><img id="previewFile" src="<?php echo $_SESSION['avatar']; ?>" style="width:90px;height:90px;">
				  	<br/><input id="uploadFile" type="file" name="image">
				</div>
            	<div class="form-group">
				  	<label>Name</label>
				  	<input type="text" class="form-control" name="name" value="<?php echo $_SESSION['name']; ?>">
				</div>
				<div class="form-group">
				  	<label>Email</label>
				  	<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
				</div>

				<div class="form-group">
				  	<label>New Password</label>
				  	<input type="password" class="form-control" name="password" placeholder="**************">
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

<script>
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewFile').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#uploadFile").change(function() {
  readURL(this);
});
</script>