<?php
include "header.php";

$news_id = $_GET['id'];
if(!is_numeric($news_id)) {
	header("Location: index.php");
}

$detail = $conn->prepare("SELECT * FROM news WHERE id = $news_id");
$detail->execute();
if($detail->rowCount() == 0) {
	header("Location: index.php");
}
$news_detail = $detail->fetch();


// insert news_view
try {
$ip_address = $_SERVER['REMOTE_ADDR'];
$news = $conn->prepare("INSERT INTO `news_view` (news_id,ip_address) VALUES 
	(:news_id, :ip_address) ");
$news->bindParam(':news_id', $news_id );
$news->bindParam(':ip_address', $ip_address);
$news->execute();
} catch (\Exception $e) {}


$duser_id = $news_detail['user_id'];
$dcopywriter = $conn->prepare("SELECT name FROM `users` WHERE id = $duser_id ");
$dcopywriter->execute();
$dname = $dcopywriter->fetch();
$dnews_date = date('M d, Y', strtotime($news_detail['news_date']));
?>


<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10" href="archive-page.html">Blog Archive<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10 color-ash" href="single-page.html">Single Blog</a>
		</div><!-- container -->
	</section>
	
	
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-md-12 col-lg-8">
					<img src="<?php echo $news_detail['image']; ?>" alt="">
					<h3 class="mt-30"><b><?php echo $news_detail['title']; ?></b></h3>
					<ul class="list-li-mr-20 mtb-15">
						<li>by <b> <?php echo $news_detail['copywrite']; ?> ,</b></a> <?php echo $dnews_date; ?></li>
						<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
							<?php echo getNewsViewers($conn,$news_id); ?></li>
						<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?php echo getNewsComments($conn,$news_id); ?></li>
					</ul>
					
					<p><?php echo $news_detail['content']; ?></p>
					
					
				
					<div class="brdr-ash-1 opacty-5"></div>
					
					<h4 class="p-title mt-50"><b>YOU MAY ALSO LIKE</b></h4>
					<div class="row">
					<?php
                    $may = $conn->prepare("SELECT * FROM news WHERE id != $news_id ORDER BY id DESC LIMIT 2 ");
                    $may->execute();


                    while ( $also = $may->fetch() ) {
						echo '<div class="col-sm-6">
							<a href="news_detail.php?id='.$also['id'].'"><img src="'.$also['image'].'" alt="" style="width:300px;height:250px;">
							<h4 class="pt-20"><a href="news_detail.php?id='.$also['id'].'"><b>'.$also['title'].'</b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <a href="#" class="color-black"><b>'.$also['copywrite'].',</b></a>'.date('F d,Y', strtotime($also['news_date'])).'</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>'.getNewsViewers($conn,$also['id']).'</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>'.getNewsComments($conn,$also['id']).'</li>
							</ul>
							</a>
						</div>';
						}
					?>
						
						
					</div><!-- row -->
					
					<?php include "comments.php"; ?>


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