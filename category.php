<?php 
include "header.php";

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT id,user_id,image,title,news_date,copywrite FROM `news` WHERE `cat_id` = $id ");
$stmt->execute();
$count = $stmt->rowCount();

// get category name
$stmt2 = $conn->prepare("SELECT name FROM `categories` WHERE id = $id ");
$stmt2->execute();
$category_name = $stmt2->fetch();
?>

    <section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="index.php"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10 color-ash" href="">Category</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-md-12 col-lg-8">
					
					<h4 class="p-title"><b><?php echo $category_name['name']; ?></b> 
						<p>( <?php echo $count; ?>  )</p></h4>
					<div class="row">
					
                    <?php
                    if($count == 0) 
                    	echo '<h4 style="margin-left:40%">لا يوجد أخبار في هذا القسم </h4>';

                    while ($article = $stmt->fetch()) {
                    	$user_id = $article['user_id'];
                    	$copywriter = $conn->prepare("SELECT name FROM `users` WHERE id = $user_id ");
                    	$copywriter->execute();
                    	$name = $copywriter->fetch();
                    	$news_date = date('M d, Y', strtotime($article['news_date']));

						echo '<div class="col-sm-6">
						   <a href="news_detail.php?id='.$article['id'].'">
							<img src="'.$article['image'].'" alt="" style="width:100%;height:300px;border:1px solid #ddd">
							</a>
							<h4 class="pt-20"><a href="#"><b>'.$article['title'].'</b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by 
								<a href="#" class="color-black"><b>'.$name['name'].',</b></a>
								'.$news_date.'</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>'.getNewsViewers($conn,$article['id']).'</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
							</ul>
						</div>';
						}
					?>
						
						
						
					</div><!-- row -->
					<!-- 
					<a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="#"><b>LOAD MORE</b></a> -->
				</div><!-- col-md-9 -->
				
				<div class="d-none d-md-block d-lg-none col-md-3"></div>
				<?php
                   include "sidebar.php";
				?>
				
			</div><!-- row -->
		</div><!-- container -->
	</section>


<?php 
include "footer.php";
?>