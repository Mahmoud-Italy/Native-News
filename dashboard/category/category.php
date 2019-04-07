<?php
include "../../config.php";

if(isset($_GET['search'])) {
$search =  $_GET['search'];
$stmt = $conn->prepare("SELECT * FROM `categories` WHERE `name` LIKE  '%$search%' ");
$stmt->execute();
} else {
$stmt = $conn->prepare("SELECT * FROM `categories` ORDER BY `id` DESC ");
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> All Data ( <?php echo $count; ?> )
                        <a href="add_category.php" class="btn btn-primary pull-right" style="float: right"><i class="fa fa-plus-circle"></i> Add New Category</a>
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
                                            <th scope="col">name</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                  <?php 
								    while ($row = $stmt->fetch()) {
                                        if($row['deleted'] == 0) $status = 'Active';
                                        else $status = 'Deleted';
								    	echo '<tr>
											<td>'.$row['id'].'</td>
											<td>'.$row['name'].'</td>
                                            <td>'.$status.'</td>
											<td>'.explode(' ',$row['cat_date'])[0].'</td>
											<td>
                                             <a href="edit_category.php?id='.$row['id'].'" class="btn btn-success" style="color:#fff"><i class="fa fa-edit"></i> Edit</a>';
                                             if($row['deleted'] == 1) {
                                             echo '<a href="restore.php?id='.$row['id'].'" class="btn btn-primary" style="color:#fff"><i class="fa fa-trash"></i> Restore</a>';
                                             }
                                              echo '<a href="del_category.php?id='.$row['id'].'" class="btn btn-danger" style="color:#fff"><i class="fa fa-trash"></i> Delete</a>
											</td>
										</tr>';
								    }
								  ?>
                                    
                                    </tbody>
                                </table>
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