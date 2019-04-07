<?php

$stmtComment = $conn->prepare("SELECT * FROM news_comments WHERE news_id = $news_id");
$stmtComment->execute();
$countComment = $stmtComment->rowCount();


?>


<h4 class="p-title mt-20"><b><span id="comCount"><?php echo $countComment; ?></span> COMMENTS</b></h4>
	
	<?php 
      while($com = $stmtComment->fetch()) {
      	$user_id = $com['user_id'];
      	$usr = $conn->prepare("SELECT * FROM users WHERE id = $user_id ");
      	$usr->execute();
      	$usr_row = $usr->fetch();

      	echo '<div id="div-'.$com['id'].'" class="sided-70 mb-40" >
		    <div class="s-left rounded">
			     <img src="'.$usr_row['image'].'" alt="">
		    </div>
			<div class="s-right ml-100 ml-xs-85">
				<h5><b>'.$usr_row['name'].', </b> 
				<span class="font-8 color-ash">'.date('F d,Y', strtotime($com['at_date'])).'</span></h5>
				<p class="mtb-15">'.$com['comment'].'</p>
			</div>';
        
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $com['user_id']) {
			echo '<div style="float:right;margin-top:-90px"><button data-id="'.$com['id'].'" class="remove-comment" type="button">x</button></div>';
        }

	   echo '</div>';
      }
	?>		
	<div id="appendComment"></div>

    <?php if(isset($_SESSION['user_id'])) { ?>		
	   <h4 class="p-title mt-20"><b>LEAVE A COMMENT</b></h4>	
	   <input type="hidden" id="news_id" value="<?php echo $_GET['id']; ?>">
	   <input type="hidden" id="curr_date" value="<?php echo date('F m,Y'); ?>">
		<form class="form-block form-plr-15 form-h-45 form-mb-20 form-brdr-lite-white mb-md-50">
			<textarea id="txtComment" class="ptb-10" placeholder="Your Comment"></textarea>
			<button id="btnComment" class="btn-fill-primary plr-30" rows="4" cols="50" type="button"><b>LEAVE A COMMENT</b></button>
		</form>
	<?php } ?>
