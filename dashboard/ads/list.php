<?php
include "../../config.php";

if(isset($_GET['search'])) {
$search =  $_GET['search'];
$stmt = $conn->prepare("SELECT * FROM `ads` WHERE `title` LIKE  '%$search%' ");
$stmt->execute();
} else {
$stmt = $conn->prepare("SELECT * FROM `ads` ORDER BY `id` DESC ");
$stmt->execute();
}
$count = $stmt->rowCount();

include "../layout/header.php";
include "../layout/sidebar.php";
?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> All Data ( <?php echo $count;  ?> )
                        <a href="create.php" class="btn btn-primary pull-right" style="float: right"><i class="fa fa-plus-circle"></i> Add New ads</a>
                        </h6>
                        
                            <div class="table-responsive m-t-40">
                           
                            <form action="" method="GET">
                                <input type="text" onsubmit="$(this).submit()"  name="search" class="form-control col-6" style="margin-bottom: 5px" placeholder="Search" 
                                value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
                                <span>
                                    <i class="fa fa-search" style="position: absolute;margin-top:-30px;right:51%"></i>
                                </span>
                            </form>
                           


                                <table class="table table-bordered" style="text-align: center;">
                                    <thead style="background-color: #f4f4f4">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                  <?php 
								    while ($row = $stmt->fetch()) {
								    	echo '<tr>
											<td>'.$row['id'].'</td>
                                            <td><img src="../../'.$row['image'].'" style="width:100px;height:100px;"></td>
											<td>'.$row['title'].'</td>
                                            <td>'.$row['link'].'</td>
                                            <td>'.$row['price'].'</td>
											<td>'.$row['start_date'].'</td>
                                            <td>'.$row['end_date'].'</td>
											<td>
                                             <a href="edit.php?id='.$row['id'].'" class="btn btn-success" style="color:#fff"><i class="fa fa-edit"></i> Edit</a>
                                              <a href="destroy.php?id='.$row['id'].'" class="btn btn-danger" style="color:#fff"><i class="fa fa-trash"></i> Delete</a>
											</td>
										</tr>';
								    }
								  ?>
                                    
                                    </tbody>
                                </table>

                                <iframe src="https://www.youtube.com/embed/pFpASJEo7G4" style="width:500px;height:400px"></iframe>
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