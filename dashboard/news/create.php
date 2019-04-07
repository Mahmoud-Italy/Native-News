<?php
include "../../config.php";
$stmt2 = $conn->prepare("SELECT * FROM categories WHERE deleted = 0");
$stmt2->execute();


$msg = '';
if(isset($_POST['save'])) {
   
   $title = $_POST['title'];
   $content = $_POST['content'];
   $copywrite = $_POST['copywrite'];
   $cat_id = $_POST['cat_id'];
   $link = $_POST['link'];
   
   // uploads images
   //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   $image = date('Y-m-d-H-i-s').'.png';
   $saved = 'uploads/news/'.$image;
   $target_dir = "../../uploads/news/";
   $target_file = $target_dir . $image; 
   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

  try {
    $stmt = $conn->prepare("INSERT INTO `news` (cat_id,copywrite,title,content,link,image) 
        VALUES  (:cat_id, :copywrite, :title, :content, :link, :image) ");
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':copywrite', $copywrite);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':image', $saved);
    if($stmt->execute()) 
    	$msg =  "News Added Successfully";
    else
    	$msg = "News Not Added";
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Add News
                        </h6>
                
                <form action="" method="POST" enctype="Multipart/form-data">  

                        <div class="col-12 row">
                            <div class="col-6 table-responsive m-t-40">
                             
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="cat_id">
                                <?php   
                                    while ($row = $stmt2->fetch()) {
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                 ?>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label>Copywrite</label>
                                    <input type="text" class="form-control" name="copywrite" required="">
                                </div>

                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" class="form-control" name="link" required="">
                                </div>

                                <div class="form-group">
                                	<label>Title</label>
                                	<input type="text" class="form-control" name="title" required="">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea rows="9" class="form-control" name="content" required=""></textarea>
                                </div>

                                <div class="form-group">
                                <button type="submit" name="save" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                                <a href="list.php" class="btn btn-danger"><i class="fa fa-forward"></i> Back</a>
                                </div>

                           

                            </div> 

                            <div class="col-6  m-t-40">
                                <div class="form-group">
                                    <label>Image</label><br/>
                                    <img id="previewFile" src="" style="width:250px;height:250px">
                                    <input id="uploadFile" type="file" name="image" required="">
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

