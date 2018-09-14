<?php
/**
 * Template name: Inner Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */


get_header();
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
<?php
get_footer(); ?>