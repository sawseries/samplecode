
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>TL Tube V.2.0</title>
	<?php include("inc.head-tags.php"); ?>
 </head>
 <body>
	<main role="main" >
		
		<?php //include("inc.header.php"); ?>
	


	<div class="container">

				<?php include("inc.top-menu.php"); ?>

				  <div class="starter-template">
						<h1>TL Tube</h1>

						<p class="lead">						
						เสริมสร้างการขายและแบ่งปันสิ่งดีๆด้วยการนำเสนอวิดีโอประกอบการขายต่างๆ กิจกรรมการขาย/การตลาดจากผู้บริหารฝ่ายขาย อีกทั้งยังสามารถถ่ายทอดสดวิดีโอ (TL Tube LIVE) การใช้เครื่องมือการขายดิจิทัลจากดิจิทัล ซัพพอร์ตเตอร์ (เจ้าหน้าที่ส่วนสนับสนุนกิจกรรมและฝึกอบรมดิจิทัล) เพื่อเผยแพร่ให้กับสมาชิกนักขายดิจิทัล กับ ทีแอลทูป และทีแอล ทูปไลฟ์</p>
				</div>

				<div class="text-center" >
											
							<form class="form-inline justify-content-center">
							  <div class="form-row align-items-center">
								
								<div class="col-auto">หมวดหมู่วีดีโอ</div>
								<div class="col-auto">
								  <label class="sr-only" for="cat">หมวดหมู่</label>
								  <select class="form-control mb-2" id="cat" name="cat">
											<option value="">-- ทั้งหมด --</option>
											<?php print_r($category_list_box);?>
								  </select>
								</div>



								<div class="col-auto">
								  <label class="sr-only" for="inlineFormInputGroup">คำค้นหา</label>
								  <div class="input-group mb-2">
									<div class="input-group-prepend">
									  <div class="input-group-text"><i class="fas fa-search"></i></div>
									</div>
									<input type="text" class="form-control" id="k" name="k" placeholder="คำค้นหา" value="<?php echo $keyword; ?>">
								  </div>
								</div>

								<div class="col-auto">
									<div class="button-tl mb-2"><button type="button" class="btn btn-sm pb-0 pr-2" id="btn_search">ค้นหา</button></div> 							
								</div>
							  </div>
							 
							</form>

							 <div class="text-danger" id="warning_search"></div>

				</div>

	 </div>
	 <div class="clearfix"></div>


			<!-- -carousel  01 -->
		    <div class="row">

				   <div class="col-lg-12 bg-silver box-carousel-vedio">
							  <h1 class="h1-home text-center">วิดีโอแนะนำ</h1>
							  <div class="container">
							  <div id="owl-vedio-suggest" class="owl-carousel owl-example">

									<?php echo $vdo_recommend;?>

									
						 </div>
					</div>
					</div>
		</div><!-- end carousel 01 -->



		<!-- -carousel  02 --> 
		    <div class="row">

				   <div class="col-lg-12 bg-silver box-carousel-vedio" style="background:#fff;">
							  <h1 class="h1-home text-center">วิดีโอล่าสุด</h1>
							  <div class="container">
							  <div id="owl-vedio-latest" class="owl-carousel owl-example">

              
										<!--
											<div class="item whiteWhite">
													 <div class="card">
														<a href="watch.php"><img src="example/v6.jpg"  class="img-fluid"></a>
														<div class="card-body">
														  <h5 class="card-title text-left">สรุปงานไทยประกันชีวิต 2559</h5>
														  <p class="card-text video-by text-left">อัปโหลดโดย : Admin<br><i class="far fa-clock"></i> เมื่อ 2 ปีที่ผ่านมา <br> <i class="far fa-eye"></i> ดู 752 ครั้ง</p>
														</div>
													  </div>
											</div>
										-->

										<?php echo $last_upload; ?>
											


						 </div>
					</div>
					</div>
		</div><!-- end carousel 02-->




		
		<!-- -carousel  03 --> 
		    <div class="row">

				   <div class="col-lg-12 bg-silver box-carousel-vedio">
							  <h1 class="h1-home text-center">วิดีโอฮิตประจำเดือน</h1>
							  <div class="container">
							  <div id="owl-vedio-hit" class="owl-carousel owl-example">
											
											<?php echo $vdo_popular; ?>
										


						 </div>
					</div>
					</div>
		</div><!-- end carousel 03-->



		<!-- -carousel  04 --> 
		    <div class="row">
 
				   <div class="col-lg-12 bg-silver box-carousel-vedio" style="background:#fff;">
							  <h1 class="h1-home text-center">ชาแนลแนะนำ</h1>
							  <div class="container">
							  <div id="owl-channel-suggest" class="owl-carousel">
											<!--
												<div class="item whiteWhite text-center">
													 <a href="watch.php"><img src="example/m1.png"  class="rounded-circle img-fluid"></a>
													 <h5>สมบัติ มีทองมาก</h5>
											   </div>
											-->
											<?php echo $channel_recommend; ?>
						 </div>
					</div>
					</div>
		</div><!-- end carousel 04-->


		
		<!-- -carousel  05 --> 
		    <div class="row">
 
				   <div class="col-lg-12 bg-silver box-carousel-vedio">
							  <h1 class="h1-home text-center">ชาแนลฮิต</h1>
							  <div class="container">
							  <div id="owl-channel-hit" class="owl-carousel">
											
												<?php echo $channal_hit; ?>
              


						 </div>
					</div>
					</div>
		</div><!-- end carousel 045-->







    </main>

	
	<?php include("inc.footer.php"); ?>
  	<?php include("inc.footer-js.php"); ?>
	
	
	<script>


	$(function() {

		$("#owl-vedio-latest, #owl-vedio-hit").owlCarousel({
			loop:true,
			autoPlay : true
		});

		 $("#owl-vedio-suggest").owlCarousel({
			loop:true,
			autoPlay : true,
			margin:8,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		})

		 $('#owl-channel-suggest').owlCarousel({
			loop:true,
			autoPlay : true,
			items:8
		})
		$("#owl-channel-hit").owlCarousel({items:8});
		
		 $("#btn_search").click(function() {
						var cat = $("#cat").val();
						var k = $("#k").val();

						if (k=="" && cat=="")
						{
							window.location.href="search-vedio.php?m=v";
						} else if (k=="" && cat!="") {
							window.location.href="search-vedio.php?m=v&cat="+cat;
						} else if (k!="" && cat=="") {
							window.location.href="search-vedio.php?m=v&k="+k;
						} else {
							window.location.href="search-vedio.php?m=v&cat="+cat+"&k="+k;
						}
	    });

	});
	</script>

 </body>
</html>
