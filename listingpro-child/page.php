<?php
get_header();
/*******************************
* Search County by Postal Code
* Author: ThangNN
* creativeOSC.com
********************************/
if(isset($_POST['select'])){
	if($_POST['select']!=""){ //Search by postal code and then redirect to County if found.
		$county = getCountyByPostal(trim($_REQUEST['select'],' '));
		if($county>0){
			wp_redirect(get_permalink($county)); //Redirect to county page
		}else{
			wp_redirect(get_permalink(1281));//If not found redirect to State page
		}
	}else{		
		wp_redirect(get_permalink(1281));//If not found redirect to State page
	}}

/*******************************
* Find 3 closest counties from current IP address
* Author: ThangNN
* creativeOSC.com
********************************/
if(is_front_page()):
	// $current_ip_address = $_SERVER['REMOTE_ADDR'];
	$current_ip_address = get_client_ip();
	// echo $current_ip_address;
	// $current_ip_address = '47.23.44.180'; // IP for testing New York
	$closest_counties = get_closest_counties($current_ip_address); // Find 3 closest counties from current IP address
	?>
	<section>
	<div id="lp_5b5034d8eedca" class="lp-section-row ">
		<div class="lp_section_inner  clearfix container">
		   <div class="row lp-section-content clearfix">
			  <div class="wpb_column vc_column_container vc_col-sm-12">
				 <div class="vc_column-inner ">
					<div class="wpb_wrapper">
					   <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
					   <div class="wpb_text_column wpb_content_element ">
						  <div class="wpb_wrapper">
							 <h2><?php _e('Exterminators in your state'); ?></h2>
						  </div>
					   </div>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	</div>
	<div id="lp_5b5034d8effa3" class="lp-section-row home-three">
	   <div class="lp_section_inner  clearfix container">
		  <div class="row lp-section-content clearfix">
			<?php foreach($closest_counties as $county): ?>
			 <div class="wpb_column vc_column_container vc_col-sm-4">
				<div class="vc_column-inner ">
				   <div class="wpb_wrapper">
					  <div class="wpb_single_image wpb_content_element vc_align_center" style="border: 1px solid #cacaca; border-bottom: none;">
						 <figure class="wpb_wrapper vc_figure" style="width: 100%;">
							<div class="vc_single_image-wrapper   vc_box_border_grey"  style="width: 100%;">
							<?php 
							 if ( has_post_thumbnail($county->ID)) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $county->ID), 'listingpro-blog-grid' );
									if(!empty($image[0])){
										echo "<a href='".$county->guid."' >
												<img src='" . $image[0] . "' with='100%' style='width: 100%;'/>
											</a>";
									}else {
										echo '
										<a href="'.$county->guid.'" >
											<img src="'.get_stylesheet_directory_uri().'/assets/images/no-image.png" alt=""  with="100%" style="width: 100%;">
										</a>';
									}	
							}elseif(!empty($deafaultFeatImg)){
								echo "<a href='".$county->guid."' >
									<img src='" . $deafaultFeatImg . "'  with='100%' style='width: 100%;'/>
								</a>";
							}else {
								echo '
								<a href="'.$county->guid.'" >
									<img src="'.get_stylesheet_directory_uri().'/assets/images/no-image.png" alt=""  with="100%" style="width: 100%;">
								</a>';
							} 
							?>						
							</div>
						 </figure>
					  </div>
					  <div class="wpb_text_column wpb_content_element ">
						 <div class="wpb_wrapper">
							<h3><a href='<?php echo $county->guid; ?>' ><?php echo $county->post_title; ?></a></h3>
							<?php 
							 $str = wpautop( preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $county->post_content) );
							$str = limit_text(strip_tags($str), 40);
							echo '<p>' . $str . '</p>'; 
							?>
						 </div>
					  </div>
				   </div>
				</div>
			 </div>
			 <?php endforeach; ?>
		  </div>
	   </div>
	</div>
	</section>
<?php
endif;
/****************** End Examinator near me *****************/
the_post();
if(has_shortcode( get_the_content(), 'vc_row' ) || has_shortcode( get_the_content(), 'listingpro_submit' ) || has_shortcode( get_the_content(), 'listingpro_pricing' ) || is_front_page()) {
	if(has_shortcode( get_the_content(), 'vc_row' ) && has_shortcode( get_the_content(), 'listingpro_promotional' )){
		?>
		<section class="aliceblue lp-blog-for-app-view">
				<?php the_content(); ?>
		</section>
		 <?php
	}else{
		if(is_front_page()):
		?>
		 <section id="main-content">
			<?php the_content(); ?>
		 </section>
		 <?php else: ?>
		 <!-- section-contianer open -->
<div class="section-contianer">	
		<div class="container page-container-five">
			<!-- page title close -->
			<div class="row">
				<!-- content open -->
				<div class="col-md-8 col-sm-8">
					<div class="blog-post clearfix">
					<div class="post-content blog-test-page">
						<?php the_content(); ?>
					</div>
					<?php //wp_link_pages(); ?>
					<?php //comments_template('', true); ?>
				</div>
				</div>
				<!-- content close -->
				<!-- sider open -->
				<div class="col-md-4 col-sm-4 listing-second-view">
					<div class="side-bar">
					<?php get_template_part("sidebar");?>
					</div>
				</div>
			</div>
		</div>
</div>
		 <?php endif; ?>
<?php
	}
}else{
	?>
	<!-- section-contianer open -->
	<div class="section-contianer">
			<div class="container page-container-five">
				<!-- page title close -->
				<div class="row">
					<!-- content open -->
					<div class="col-md-8 col-sm-8">
						<div class="blog-post clearfix">
						<div class="post-content blog-test-page">
							<?php the_content(); ?>
						</div>
					</div>
					</div>
					<!-- content close -->
					<!-- sider open -->
					<div class="col-md-4 col-sm-4 listing-second-view">
						<div class="side-bar">
						<?php get_template_part("sidebar");?>
						</div>
					</div>
				</div>
			</div>
	</div>
	<?php
}
get_footer(); ?>