<?php
$stmt1 = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 1");
$stmt1->execute();
$row1 = $stmt1->fetch();

$stmt2 = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 2 OFFSET 1");
$stmt2->execute();

$stmt3 = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 3 OFFSET 3");
$stmt3->execute();
?>
<div class="container">
	<div class="h-600x h-sm-auto">
		<div class="h-2-3 h-sm-auto oflow-hidden">
				<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
					<a class="pos-relative h-100 dplay-block" href="news_detail.php?id=<?php echo $row1['id'];?>">
					<div class="img-bg bg-grad-layer-6" style="background:url(<?php echo $row1['image']; ?>) no-repeat center; background-size:cover"></div>
						<div class="abs-blr color-white p-20 bg-sm-color-7">
							<h3 class="mb-15 mb-sm-5 font-sm-13"><b><?php echo $row1['title']; ?></b></h3>
							<ul class="list-li-mr-20">
								<li>by <span class="color-primary"><b><?php echo $row1['copywrite']; ?></b></span> <?php echo date('F d,Y', strtotime($row1['news_date']));?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?php echo getNewsViewers($conn,$row1['id']); ?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?php echo getNewsComments($conn,$row1['id']); ?></li>
							</ul>
						</div>
					</a>
				</div>
				
				<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
				

                <?php 
                while($row2 = $stmt2->fetch()) {
                	echo '<div class="pl-5 pb-5 pl-sm-0 pos-relative h-50">
						<a class="pos-relative h-100 dplay-block" href="news_detail.php?id='.$row2['id'].'">
							<div class="img-bg bg-grad-layer-6" style="background:url('.$row2['image'].') no-repeat center; background-size:cover"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>'.$row2['title'].'</b></h4>
								<ul class="list-li-mr-20">
									<li>'.date('F d,Y', strtotime($row2['news_date'])).'</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>'.getNewsViewers($conn,$row2['id']).'</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>'.getNewsComments($conn,$row2['id']).'</li>
								</ul>
							</div>
						</a>
					</div>';
                }

                ?>
					
					


					
				</div>

			</div>
			







			<div class="h-1-3 oflow-hidden">
		

		    <?php 
             while($row3 = $stmt3->fetch()) {
             	echo '<div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
					<a class="pos-relative h-100 dplay-block" href="news_detail.php?id='.$row3['id'].'">
						<div class="img-bg bg-grad-layer-6" style="background:url('.$row3['image'].') no-repeat center; background-size:cover"></div>
						<div class="abs-blr color-white p-20 bg-sm-color-7">
							<h4 class="mb-10 mb-sm-5"><b>'.$row3['title'].'</b></h4>
							<ul class="list-li-mr-20">
								<li>'.date('F d,Y', strtotime($row3['news_date'])).'</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>'.getNewsViewers($conn,$row3['id']).'</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>'.getNewsComments($conn,$row3['id']).'</li>
							</ul>
						</div>
					</a>
				</div>';
             }
		    ?>
				



				
				
				
			</div><!-- h-2-3 -->
		</div><!-- h-100vh -->
	</div><!-- container -->
	