<?php
$sidebar = $conn->prepare("SELECT * FROM `news` LIMIT 3 ");
$sidebar->execute();
?>
<div class="col-md-6 col-lg-4">
    <div class="pl-20 pl-md-0">
						
		<div class="mtb-50">
		<h4 class="p-title"><b>POPULAR POSTS</b></h4>

        <?php
        while ( $side = $sidebar->fetch() ) {
        	$suser_id = $side['user_id'];
            $scopywriter = $conn->prepare("SELECT name FROM `users` WHERE id = $suser_id ");
            $scopywriter->execute();
            $sname = $scopywriter->fetch();
            $snews_date = date('M d, Y', strtotime($side['news_date']));

			$data =  <<<HT
<a class="oflow-hidden pos-relative mb-20 dplay-block" href="news_detail.php?id=$side[id]">
				<div class="wh-100x abs-tlr"><img src="$side[image]" style="width:100%;height:100px;border:1px solid #ddd" alt=""></div>
				<div class="ml-120 min-h-100x">
					<h5><b>$side[title]</b></h5>
					<h6 class="color-lite-black pt-10">by 
					<span class="color-black"><b>$sname[name],</b></span> $snews_date</h6>
				</div>
			</a>
HT;
			echo $data;
			}
		?>
							
							
	</div><!-- mtb-50 -->
						
						<div class="mtb-50 pos-relative" style="display:none">
							<img src="assets/images/banner-1-600x450.jpg" alt="">
							<div class="abs-tblr bg-layer-7 text-center color-white">
								<div class="dplay-tbl">
									<div class="dplay-tbl-cell">
										<h4><b>Available for mobile & desktop</b></h4>
										<a class="mt-15 color-primary link-brdr-btm-primary" href="#"><b>Download for free</b></a>
									</div><!-- dplay-tbl-cell -->
								</div><!-- dplay-tbl -->
							</div><!-- abs-tblr -->
						</div><!-- mtb-50 -->
						
						<?php include "newsletter.php"; ?>
						
					</div><!--  pl-20 -->
				</div><!-- col-md-3 -->