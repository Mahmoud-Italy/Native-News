<?php
include "../../config.php";
$stmt2 = $conn->prepare("SELECT * FROM categories");
$stmt2->execute();

$id = $_GET['id'];
$stmt3 = $conn->prepare("SELECT * FROM ads WHERE id = $id");
$stmt3->execute();
$rows = $stmt3->fetch();

$msg = '';
if(isset($_POST['update'])) {
   
   $cat_id = $_POST['cat_id'];
   $title = $_POST['title'];
   $link = $_POST['link'];
   $price = $_POST['price'];
   $status = $_POST['status'];
   $start_date = $_POST['start_date'];
   $end_date = $_POST['end_date'];

   
   // uploads images
    if($_FILES["image"]["tmp_name"]) {
       $image = date('Y-m-d-H-i-s').'.png';
       $saved = 'uploads/ads/'.$image;
       $target_dir = "../../uploads/ads/";
       $target_file = $target_dir . $image; 
       move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
      $saved = $rows['image'];
    }

  try {
    $stmt = $conn->prepare("UPDATE `ads` SET cat_id = :cat_id, image = :image, title = :title, 
      link  = :link, start_date = :start_date, end_date = :end_date,  price = :price, status = :status WHERE id = :id");
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':image', $saved);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()) {
    	$msg =  "Ads Updated Successfully";
      header("Location: edit.php?id=".$id);
    }
    else
    	$msg = "Ads Not Updated";
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Update Ads
                        </h6>
                
                <form action="" method="POST" enctype="Multipart/form-data">  

                        <div class="col-12 row">
                            <div class="col-6 table-responsive m-t-40">
                             
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="cat_id">
                                <?php   
                                    while ($row = $stmt2->fetch()) {
                                      if($rows['cat_id'] == $row['id']) {
                                        echo '<option value="'.$row['id'].'" selected="selected">'.$row['name'].'</option>';
                                      } else {
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                      }
                                    }
                                 ?>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" 
                                    value="<?php echo $rows['title']; ?>" required="">
                                </div>

                                <div class="form-group">
                                	<label>Link</label>
                                	<input type="text" class="form-control" name="link" 
                                  value="<?php echo $rows['link']; ?>" required="">
                                </div>

                                <div class="form-group">
                                  <label>status</label>
                                  <select class="form-control" name="status">
                                    <option value="0" <?php if($rows['status'] == 0) echo 'selected'; ?> >DeActive</option>
                                    <option value="1" <?php if($rows['status'] == 1) echo 'selected'; ?>>Active</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input id="start_date" type="date" class="form-control" name="start_date" required="" value="<?php echo $rows['start_date']; ?>">
                                </div>

                                <div class="form-group">
                                    <label>End Date</label>
                                    <input id="end_date" type="date" class="form-control" name="end_date" required="" value="<?php echo $rows['end_date']; ?>">
                                </div>

                                  <div class="form-group">
                                  <label>Price</label>
                                  <input id="price" type="number" class="form-control" name="price" required="" value="<?php echo $rows['price']; ?>">
                                </div>

                                <div class="form-group">
                                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>
                                <a href="list.php" class="btn btn-danger"><i class="fa fa-forward"></i> Back</a>
                                </div>

                            </div> 

                            <div class="col-6  m-t-40">
                                <div class="form-group">
                                    <label>Image</label><br/>
                                    <img id="previewFile" src="http://localhost/course/G4_project/<?php echo $rows['image']; ?>" style="width:250px;height:250px">
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
<script>
$(function(){

    


  $("#end_date").on('change',function(){
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();

     var d = new Date(start_date);
     var curr_date = d.getDate();
     var curr_month = d.getMonth() + 1; //Months are zero based
     var curr_year = d.getFullYear();
     var format_startDate = curr_month+'/'+curr_date+'/'+curr_year;


     var dd = new Date(end_date);
     var dcurr_date = dd.getDate();
     var dcurr_month = dd.getMonth() + 1; //Months are zero based
     var dcurr_year = dd.getFullYear();
     var format_endDate = dcurr_month+'/'+dcurr_date+'/'+dcurr_year;

     if(!start_date || !end_date) {
      console.log('no date found');
     } else {
      var diff = datediff(parseDate(format_startDate), parseDate(format_endDate));
      var cost = 10;
      $("#price").val(cost*diff);
     }
  });


  function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return Math.round((second-first)/(1000*60*60*24));
}


  
});
</script>


