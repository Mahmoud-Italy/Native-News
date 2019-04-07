<?php
include "../../config.php";

$msg = '';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM `categories` WHERE `id` = $id ");
$stmt->execute();
$row = $stmt->fetch();
$category_name = $row['name'];

if(isset($_POST['update'])) {

	$name = $_POST['cat_name'];

  try {
    $stmt = $conn->prepare("UPDATE `categories` SET name = :name WHERE id =$id ");
    $stmt->bindParam(':name', $name);
    if($stmt->execute()) 
    	header("Location: category.php");
    else
    	$msg = "Category Not Updated";
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
                  	echo $msg;
                  }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Update Category
                        </h6>
                        
                            <div class="col-6 table-responsive m-t-40">

                             <form action="" method="POST">  

                                <div class="form-group">
                                	<label>Category Name</label>
                                	<input type="text" class="form-control" name="cat_name" value="<?php echo $category_name; ?>" required="">
                                </div>
                                <div class="form-group">
                                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>
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