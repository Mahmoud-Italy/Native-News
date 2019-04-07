<?php
include "header.php";

$q = $_GET['q'];
$stmt_search = $conn->prepare("SELECT * FROM news WHERE title LIKE '%$q%' ");
$stmt_search->execute();

?>

   <section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10 color-ash" href="archive-page.html">Search</a>
		</div>
	</section>

   <section>
		<div class="container">
			<div class="row">
			
				<div class="col-md-12">
					
					<h4 class="p-title"><b>Search result ( <?php echo $stmt_search->rowCount(); ?> ) </b></h4>
					<div class="row">

                    
                    <?php
                      
                       if($stmt_search->rowCount() == 0) {
                       	 echo '<h5>No Search Found.</h5>';
                       }

                      while($row_search = $stmt_search->fetch()) {
                      	echo '<div class="col-sm-4">
							<img src="'.$row_search['image'].'" alt="">
							<h4 class="pt-20"><a href="news_detail.php?id='.$row_search['id'].'"><b>
							'.$row_search['title'].'</b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <a href="#" class="color-black"><b>'.$row_search['copywrite'].',</b></a>
								'.date('F d, Y', strtotime($row_search['news_date'])).'</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>'.getNewsViewers($conn,$row_search['id']).'</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>'.getNewsComments($conn,$row_search['id']).'</li>
							</ul>
						</div>';
                      }
                    ?>
						

						
						

						

					</div>
			   </div>

			 </div>
		</div>
  </section>


<?php
include "footer.php";
?>