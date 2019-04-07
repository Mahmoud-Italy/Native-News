<?php
include "../../config.php";
$msg = '';
if(isset($_POST['save'])) {
   
   $name = $_POST['cat_name'];

  try {
    $stmt = $conn->prepare("INSERT INTO `categories` (name) VALUES  (:name) ");
    $stmt->bindParam(':name', $name);
    if($stmt->execute()) 
    	$msg =  "Category Added Successfully";
    else
    	$msg = "Category Not Added";
	} catch (\Exception $e) {
	    $msg = "Something went wrong ".$e;
	}  

}

include "../layout/header.php";
include "../layout/sidebar.php";
?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
               
                <?php
                  if($msg) {
                  	echo "<p class='alert alert-success'>".$msg."</p>";
                  }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Add New Category
                        </h6>
                        
                            <div class="col-6 table-responsive m-t-40">

                             <form action="" method="POST">  

                                <div class="form-group">
                                	<label>Category Name</label>
                                	<input type="text" class="form-control" name="cat_name" required="">
                                </div>
                                <div class="form-group">
                                <button type="submit" name="save" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                                <a href="category.php" class="btn btn-danger"><i class="fa fa-forward"></i> Back</a>
                                </div>

                            </form>

                            </div> 

                        </div>          
                 </div>
            </div>

        </div>
    </div>
</div>





<?php
include "../layout/footer.php";
?>