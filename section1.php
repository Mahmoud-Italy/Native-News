<?php
$stmt4 = $conn->prepare("SELECT * FROM news order by id DESC limit 1 OFFSET 6");
$stmt4->execute();
$row4 = $stmt4->fetch();

$stmt5 = $conn->prepare("SELECT * FROM news order by id DESC limit 4 OFFSET 7");
$stmt5->execute();
?>
<h4 class="p-title"><b>RECENT NEWS</b></h4>
	<div class="row">
					
			<div class="col-sm-6">
				<img src="<?php echo $row4['image']; ?>" alt="">
					<h4 class="pt-20">
						<a href="news_detail.php?id=<?php echo $row4['id']; ?>">
							<b><?php echo $row4['title']; ?></b>
						</a>
					</h4>
				<ul class="list-li-mr-20 pt-10 pb-20">
					<li class="color-lite-black">by <a href="#" class="color-black"><b><?php echo $row4['copywrite']; ?>,</b></a>
						<?php echo date('F d, Y', strtotime($row4['news_date'])); ?></li>
					<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><b><?php echo getNewsViewers($conn,$row4['id']) ?></b></li>
					<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><b><?php echo getNewsComments($conn,$row4['id']) ?></b></li>
				</ul>
				<p><?php echo $row4['content']; ?></p>
			</div><!-- col-sm-6 -->
						


						<div class="col-sm-6">


						<?php 
                          while($row5 = $stmt5->fetch()) {
                          	echo '<a class="oflow-hidden pos-relative mb-20 dplay-block" href="news_detail.php?id='.$row5['id'].'">
								<div class="wh-100x abs-tlr">
								<img src="'.$row5['image'].'" alt=""></div>
								<div class="ml-120 min-h-100x">
									<h5><b>'.$row5['title'].'</b></h5>
									<h6 class="color-lite-black pt-10">by <span class="color-black"><b>
									'.$row5['copywrite'].',</b></span>'.date('F d,Y', strtotime($row5['news_date'])).'</h6>
								</div>
							</a>';
                          }
						?>	
							
							
						</div>
						
</div><!-- row -->