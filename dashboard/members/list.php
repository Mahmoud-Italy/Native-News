<?php
include "../../config.php";

if(isset($_GET['search'])) {
$search =  $_GET['search'];
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `name` LIKE  '%$search%' ");
$stmt->execute();
} else {
$stmt = $conn->prepare("SELECT * FROM `users` ORDER BY `id` DESC ");
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
                        <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> All Members ( <?php echo $count;  ?> )
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
                                            <th scope="col">name</th>
                                            <th scope="col">email</th>
                                            <th scope="col">News</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                  <?php 
								    while ($row = $stmt->fetch()) {
                        $news = $conn->prepare("SELECT * FROM `news` WHERE user_id = :user_id ");
                        $news->bindParam(':user_id',$row['id']);
                        $news->execute();
                                        $countNews = $news->rowCount();
								    	echo '<tr>
											<td>'.$row['id'].'</td>
                                            <td><img src="../../'.$row['image'].'" style="width:100px;height:100px;"></td>
											<td>'.$row['name'].'</td>
                                            <td>'.$row['email'].'</td>
                                            <td>'.$countNews.'</td>
											<td>'.explode(' ',$row['user_date'])[0].'</td>
											<td>
                                              <button href="destroy.php?id='.$row['id'].'" class="btn btn-danger" style="color:#fff" disabled><i class="fa fa-trash"></i> Delete</button>
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