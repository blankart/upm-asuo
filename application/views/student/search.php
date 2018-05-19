<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
	       function liveSearchOrgPage(){
	           if ($(".searchOrgPage").val().length > 0){
	               $(".searchOrgPage").addClass('moveUp');
	               $('#searchResult').addClass('moveUp2');
	               var search = $('.searchOrgPage').val();
	               $.ajax({
	      type:"post",
	      url:"<?php echo base_url(); ?>student/search",
	      cache: false,
	      data:{query: search},
	      dataType: 'json',
	      async: false,
	      success:function(result){
	      	output="";
	      	for (var key in result) {
       if (result.hasOwnProperty(key)) {
       output+="<div class='col-xs-12 col-sm-6 col-md-4'>"+
							"<div class='image-flip'>"+
								"<div class='mainflip'>"+
									"<div class='frontside'>"+
										"<div class='card'>"+
											"<div class='card-body text-center'>"+
												"<p><img alt='card image' class='img-fluid' src='<?php echo base_url().'assets/org/logo/"+result[key]["org_logo"]+"'.'?'.rand(1, 100); ?>'></p><a href='#'><button class='btn btn-danger' style='margin-top: 10px; margin-bottom: 10px;'>View Profile</button></a>"+
												"<h4 class='card-title' style='margin: 0 !important; padding: 0! important'>"+result[key]["org_name"]+"</h4>"+
												"<p class='card-text' style='margin: 0 !important; padding: 0! important'>"+result[key]["acronym"]+"</p>"+
												"<p class='card-text' style='margin: 0 !important; padding: 0! important'>"+result[key]["org_category"]+"</p>"+
												"<p class='card-text' style='margin: 0 !important; padding: 0! important; margin-bottom: 10px;'>"+result[key]["description"]+"</p>"+
											"</div>"+
										"</div>"+
									"</div>"+
								"</div>"+
							"</div>"+
						"</div>";
       }
       }
       $("#orgSearchResult").html(output);

	      }
	      });
	           }
	           else{
	               $(".searchOrgPage").removeClass('moveUp');
	               $('#searchResult').removeClass('moveUp2');
	           }
	       }
	</script>
</head>
<body>
	<div id="search">
		<button class="close" type="button">x</button> <input class='searchOrgPage' max='50' min='1' onkeyup="liveSearchOrgPage()" placeholder="type organization name here">
		<div id='searchResult'>
			<section class='pb-5' id='searchPanel'>
				<div class='container'>
					<div id='orgSearchResult' class='row' style='height: 350px; overflow-y: scroll;'>
						<div class='col-xs-12 col-sm-6 col-md-4'>
							<div class='image-flip'>
								<div class='mainflip'>
									<div class='frontside'>
										<div class='card'>
											<div class='card-body text-center'>
												<p><img alt='card image' class='img-fluid' src='%3C?php%20echo%20base_url();%20?%3Eimg/UP%20logo.png'></p><a href='#'><button class='btn btn-danger' style='margin-top: 10px; margin-bottom: 10px;'>View Profile</button></a>
												<h4 class='card-title'>Sample Org</h4>
												<p class='card-text'>Description Here</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>