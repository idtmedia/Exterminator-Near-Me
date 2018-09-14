<?php
/**
 * Template name: State Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header();
/****************** End Examinator near me *****************/
// the_post();
if(has_shortcode( get_the_content(), 'vc_row' ) || has_shortcode( get_the_content(), 'listingpro_submit' ) || has_shortcode( get_the_content(), 'listingpro_pricing' ) || is_front_page()) {
	
	if(has_shortcode( get_the_content(), 'vc_row' ) && has_shortcode( get_the_content(), 'listingpro_promotional' )){
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
						<?php wp_link_pages(); ?>
						<?php comments_template('', true); ?>
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
	}else{
		?>
	 <section id="main-content">
		<?php if( have_rows('buttons') ): ?>
			<div id="" class="lp-section-row ">
				<div class="lp_section_inner  clearfix container">
					<div class="row lp-section-content clearfix">
						<div class="wpb_column vc_column_container vc_col-sm-12">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											<h2>Find a Local Pest Control Professional in your County:</h2>
											<div class="vc_btn3-container vc_btn3-left">
												<ul style="padding: 0;">
													<?php while( have_rows('buttons') ): the_row(); ?>
    													        <div class="col-md-3 col-sm-4 col-xs-12">
														            <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-custom" style="background-color:#c60000;margin: 5px;color:#ffffff;" href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('title'); ?>"><?php the_sub_field('title'); ?></a>										
													            </div>
													<?php endwhile; ?>	 
												</ul>		 
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	 </section>
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
						<?php wp_link_pages(); ?>
						<?php comments_template('', true); ?>
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
						<?php wp_link_pages(); ?>
						<?php comments_template('', true); ?>
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