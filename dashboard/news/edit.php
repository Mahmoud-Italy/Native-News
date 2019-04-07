<?php
include "../../config.php";
$stmt2 = $conn->prepare("SELECT * FROM categories");
$stmt2->execute();

$id = $_GET['id'];
$stmt3 = $conn->prepare("SELECT * FROM `news` WHERE id = $id ");
$stmt3->execute();
$rows = $stmt3->fetch();


$msg = '';
if(isset($_POST['update'])) {
   
   $title = $_POST['title'];
   $content = $_POST['content'];
   $copywrite = $_POST['copywrite'];
   $cat_id = $_POST['cat_id'];
   
   // uploads images
   if($_FILES["image"]["tmp_name"]) {
       $image = date('Y-m-d-H-i-s').'.png';
       $saved = 'uploads/news/'.$image;
       $target_dir = "../../uploads/news/";
       $target_file = $target_dir . $image; 
       move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
   } else {
       $saved = $rows['image'];
   }

  try {
    $stmt = $conn->prepare("UPDATE `news` SET cat_id = :cat_id, title = :title,
        content = :content , copywrite = :copywrite, image =  :image 
        WHERE id = :id  ");
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':copywrite', $copywrite);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $saved);
    $stmt->bindParam(':id', $id);
    if($stmt->execute())  {
      header("Location: edit.php?id=".$id);
      $msg =  "News Updated Successfully";
    }
    else
    	$msg = "News Not Updated";
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Update News
                        </h6>
                
                <form action="" method="POST" enctype="Multipart/form-data">  

                        <div class="col-12 row">
                            <div class="col-6 table-responsive m-t-40">
                             
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="cat_id">
                                <?php   
                                    while ($row = $stmt2->fetch()) {
                                       if($rows['cat_id'] == $row['id'])
                                        echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                                      else 
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                 ?>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label>Copywrite</label>
                                    <input type="text" class="form-control" name="copywrite" value="<?php echo $rows['copywrite'] ?>" required="">
                                </div>

                                <div class="form-group">
                                	<label>Title</label>
                                	<input type="text" class="form-control" name="title" 
                                  value="<?php echo $rows['title'] ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea rows="9" class="form-control" name="content" required=""><?php echo $rows['content'] ?></textarea>
                                </div>

                                <div class="form-group">
                                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                <a href="list.php" class="btn btn-danger"><i class="fa fa-forward"></i> Back</a>
                                </div>

                           

                            </div> 

                            <div class="col-6  m-t-40">
                                <div class="form-group">
                                    <label>Image</label><br/>
                                    <img id="previewFile" src="http://localhost/course/G4_project/<?php echo $rows['image'] ?>" style="width:250px;height:250px">
                                    <input id="uploadFile" type="file" name="image">
                                </div>
                            </div>
                        </div>
                     </form>

                        </div>          
                 </div>
            </div>

        </div>
    </div>
</div>





<?php
include "../layout/footer.php";
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

