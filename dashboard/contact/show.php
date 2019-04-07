<?php
include "../../config.php";

$msg = '';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM `contact_us` WHERE `id` = $id ");
$stmt->execute();
$row = $stmt->fetch();

$stmt2 = $conn->prepare("UPDATE  `contact_us` SET seen = 1 WHERE id = $id ");
$stmt2->execute();

include "../layout/header.php";
include "../layout/sidebar.php";
?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Show Message
                        </h6>
                        
                           

                             <form action="" method="POST">  
                            <div class="col-12 row">
                             <div class="col-6 table-responsive m-t-40">

                                <div class="form-group">
                                	<label>Name</label>
                                	<input type="text" class="form-control" value="<?php echo $row['name']; ?>" readonly="">
                                </div>


                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" value="<?php echo $row['mobile']; ?>" readonly="">
                                </div>


                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="9" class="form-control" readonly=""><?php echo $row['message']; ?></textarea>
                                </div>

                               

                                <div class="form-group">
                                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
                                <a href="list.php" class="btn btn-danger"><i class="fa fa-forward"></i> Back</a>
                                </div>
                            
                             </div> 

                              <div class="col-6 table-responsive m-t-40">
                                 
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="<?php echo $row['email']; ?>" readonly="">
                                </div>

                                  <div class="form-group">
                                    <label>Company</label>
                                    <input type="text" class="form-control" value="<?php echo $row['company']; ?>" readonly="">
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