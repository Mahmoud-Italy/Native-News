<?php
include "header.php";
?>


<section>
	<div class="container">
		<div class="row">
			 
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<h3>Enter your new Password</h3>
				</center>
            <form action="" method="POST">
				<div class="form-group">
				  	<label>Password</label>
				  	<input type="password" class="form-control" name="password" required="">
				</div>
				<div class="form-group">
				  	<label>Confirm password</label>
				  	<input type="password" class="form-control" name="con_password" required="">
				</div>
				<div class="form-group">
				  	<button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
				</div>
			</form>
			</div>

		</div>
	</div>
</section>


<?php
include "footer.php";
?>