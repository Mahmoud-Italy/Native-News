<?php
include "../../config.php";
$stmt2 = $conn->prepare("SELECT * FROM categories");
$stmt2->execute();

$msg = '';
if(isset($_POST['save'])) {
   
   $cat_id = $_POST['cat_id'];
   $title = $_POST['title'];
   $link = $_POST['link'];
   $price = $_POST['price'];
   $status = $_POST['status'];
   $start_date = $_POST['start_date'];
   $end_date = $_POST['end_date'];

   
   // uploads images
   $image = date('Y-m-d-H-i-s').'.png';
   $saved = 'uploads/ads/'.$image;
   $target_dir = "../../uploads/ads/";
   $target_file = $target_dir . $image; 
   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

  try {
    $stmt = $conn->prepare("INSERT INTO `ads` (cat_id,image,title,link,start_date,end_date,price,status) 
        VALUES  (:cat_id, :image, :title, :link, :start_date, :end_date, :price, :status) ");
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':image', $saved);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':status', $status);
    if($stmt->execute()) 
    	$msg =  "Ads Added Successfully";
    else
    	$msg = "Ads Not Added";
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Add New Ads
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
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" required="">
                                </div>

                                <div class="form-group">
                                	<label>Link</label>
                                	<input type="text" class="form-control" name="link" required="">
                                </div>

                                <div class="form-group">
                                  <label>status</label>
                                  <select class="form-control" name="status">
                                    <option value="0">DeActive</option>
                                    <option value="1">Active</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input id="start_date" type="date" class="form-control" name="start_date" required="">
                                </div>

                                <div class="form-group">
                                    <label>End Date</label>
                                    <input id="end_date" type="date" class="form-control" name="end_date" required="">
                                </div>

                                  <div class="form-group">
                                  <label>Price</label>
                                  <input id="price" type="number" class="form-control" name="price" required="">
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


