<footer class="bg-191 color-ccc">
		
		<div class="container">
			<div class="pt-50 pb-20 pos-relative">
				<div class="abs-tblr pt-50 z--1 text-center">
					<div class="h-80 pos-relative"><img class="opacty-1 h-100 w-auto" src="assets/images/map.png" alt=""></div>
				</div>
				<div class="row">
				
					<div class="col-sm-4">
						<div class="mb-30">
							<a href="#"><img src="assets/images/logo-white.png"></a>
							<p class="mtb-20 color-ccc">Bit coin is an open-source, peer-to-peer, digital decentralized cryptocurrency.
							Powered by blockchain technology, its defining characteristic is</p>
							<p class="color-ash"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ion-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
						</div><!-- mb-30 -->
					</div><!-- col-md-4 -->
					
					<div class="col-sm-4">
						<div class="mb-30">
							<h5 class="color-primary mb-20"><b>MOST POPULAR</b></h5>
							<div class="mb-20">
								<a class="color-white" href="#"><b>Its Make or Break Time for Bitcoin</b></a>
								<h6 class="mt-10">Jan 25, 2018</h6>
							</div>
							<div class="brdr-ash-1 opacty-2 mr-30"></div>
							<div class="mt-20">
								<a class="color-white" href="#"><b>Bitcoin's roller coster ride is not over</b></a>
								<h6 class="mt-10">Jan 25, 2018</h6>
							</div>
						</div><!-- mb-30 -->
					</div><!-- col-md-4 -->
					
					<div class="col-sm-4">
						<div class="mb-30">
							<h5 class="color-primary mb-20"><b>MOST POPULAR</b></h5>
							<div class="mb-20">
								<a class="color-white" href="#"><b>Its Make or Break Time for Bitcoin</b></a>
								<h6 class="mt-10">Jan 25, 2018</h6>
							</div>
							<div class="brdr-ash-1 opacty-2 mr-30"></div>
							<div class="mt-20">
								<a class="color-white" href="#"><b>Bitcoin's roller coster ride is not over</b></a>
								<h6 class="mt-10">Jan 25, 2018</h6>
							</div>
						</div><!-- mb-30 -->
					</div><!-- col-md-4 -->
					
				</div><!-- row -->
			</div><!-- ptb-50 -->
			
			<div class="brdr-ash-1 opacty-2"></div>
			
			<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">
			
				<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
					<li><a class="pl-0 pl-sm-10" href="#">Terms & Conditions</a></li>
					<li><a href="#">Privacy policy</a></li>
					<li><a href="#">Jobs advertising</a></li>
					<li><a href="#">Contact us</a></li>
				</ul>
				<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
					<li><a class="pl-0 pl-sm-10" href="#"><i class="ion-social-facebook"></i></a></li>
					<li><a href="#"><i class="ion-social-twitter"></i></a></li>
					<li><a href="#"><i class="ion-social-google"></i></a></li>
					<li><a href="#"><i class="ion-social-instagram"></i></a></li>
					<li><a href="#"><i class="ion-social-bitcoin"></i></a></li>
				</ul>
				
			</div><!-- oflow-hidden -->
		</div><!-- container -->
	</footer>
	
	<!-- SCIPTS -->
	
	<script src="assets/plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="assets/plugin-frameworks/tether.min.js"></script>
	<script src="assets/plugin-frameworks/bootstrap.js"></script>
	<script src="assets/common/scripts.js"></script>



    
    <script>
    	$(function(){

           $("#btnComment").click(function(){
               var comment = $("#txtComment").val();
               var news_id = $("#news_id").val();
               var userImg = "<?php echo $_SESSION['avatar'];?>";
               var username = "<?php echo $_SESSION['name'];?>";
               var userdate = $("#curr_date").val();
               var oldCount = parseInt($("#comCount").text());

               $.ajax({
                 url : 'commentAjax.php',
                 method : 'POST',
                 data : { com: comment, news_id : news_id },
                 // dataType : 'json',
                 success:function() {

                 	$("#appendComment").append('<div class="sided-70 mb-40"><div class="s-left rounded"><img src="'+userImg+'" alt=""></div><div class="s-right ml-100 ml-xs-85"><h5><b>'+username+', </b> <span class="font-8 color-ash">'+userdate+' </span></h5><p class="mtb-15">'+comment+'</p></div></div>');
         
                 	$("#comCount").text(oldCount+1);

                 	$("#txtComment").val('');
                 }, error:function(e) {
                 	
                 	// on error
                 }
               });
           });


           // remove Comment via Ajax
           $(".remove-comment").click(function(){
           	 var get_id = $(this).attr('data-id');
           	 var oldCount = parseInt($("#comCount").text());
           	 $.ajax({
                 url : 'removeAjax.php',
                 method : 'POST',
                 data : { com_id: get_id },
                 success:function() {
                 	$("#div-"+get_id).fadeOut();
                 	$("#comCount").text(oldCount-1);
                 }
             });
           })

    	});
    </script>
	
</body>
</html>