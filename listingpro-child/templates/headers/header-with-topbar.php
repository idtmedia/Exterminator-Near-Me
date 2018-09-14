<?php 
	/* Header with topBar */
	global $listingpro_options;
	$upload_url = wp_upload_dir();
	$fb = $listingpro_options['fb'];
    $tw = $listingpro_options['tw'];
    $gog = $listingpro_options['gog'];
    $insta = $listingpro_options['insta'];
    $tumb = $listingpro_options['tumb'];
    $fyout = $listingpro_options['f-yout'];
    $flinked = $listingpro_options['f-linked'];
    $fpintereset = $listingpro_options['f-pintereset'];
    $fvk = $listingpro_options['f-vk'];

	$lp_top_bar = $listingpro_options['top_bar_enable'];
	$listing_style = $listingpro_options['listing_style'];
	$header_fullwidth = $listingpro_options['header_fullwidth'];
	$headerSrch = $listingpro_options['search_switcher'];
	$topBannerView = $listingpro_options['top_banner_styles'];

	$headerWidth = '';
	if($header_fullwidth == 1){
		$headerWidth = 'fullwidth-header';
	}else{
		$headerWidth = 'container';
	}

	$listing_style = '';
	$listing_styledata = '';
	$headerClass = 'header-normal';
	$listing_style = $listingpro_options['listing_style'];
	if(isset($_GET['list-style']) && !empty($_GET['list-style'])){
		$listing_style = esc_html($_GET['list-style']);
	}
	if(is_tax('location') || is_tax('listing-category')  || is_tax('list-tags') || is_tax('features') || is_search()){
		if($listing_style == '2' || $listing_style == '3'){
			$headerClass = 'header-fixed';
		}
	}
	$menuColor= '';
	if(!is_front_page() || is_home()){
		$menuColor =  ' lp-menu-bar-color';
	}elseif ( $topBannerView == 'map_view' && is_front_page() ) {
		$menuColor =  ' lp-menu-bar-color';
	}
	
	$menuClass = '';
	 if(!is_front_page()){
		 $menuClass = 'col-md-12';
	 }else{
		  $menuClass = 'col-md-12';
	 }
?>
<header class="header-with-topbar <?php if(is_front_page()){ echo 'lp-header-bg'; } ?> <?php echo esc_attr($headerClass); ?>">
	<?php if(is_front_page()){ ?> <div class="lp-header-overlay"></div> <?php } ?>
	<?php if( $lp_top_bar == true ){ ?>
		<div class="lp-topbar">
			<div class="<?php echo esc_attr($headerWidth); ?>">
				<div class="row">
					<div class="col-md-9 col-sm-9 text-left">
						<?php echo listingpro_top_bar_menu(); ?>
					</div>
					<div class="col-md-3 col-sm-3 text-right">
						<?php get_template_part( 'templates/join-now'); ?>
					</div>
				</div>
			</div>
		</div><!-- ../topbar -->
	<?php } ?>
	<div class="lp-menu-bar <?php echo esc_attr($menuColor);  ?>">
		<div class="<?php echo esc_attr($headerWidth); ?>">
			<div id="menu" class="small-screen">
				<?php
					$listing_access_only_users = $listingpro_options['lp_allow_vistor_submit'];
					$showAddListing = true;
					if( isset($listing_access_only_users)&& $listing_access_only_users==1 ){
						$showAddListing = false;
						if(is_user_logged_in()){
							$showAddListing = true;
						}
					}
					if($showAddListing==true) {
							$addURL = listingpro_url('add_listing_url_mode');
							if(!empty($addURL)) {
							?>
							<a href="<?php echo listingpro_url('add_listing_url_mode'); ?>" class="lpl-button"><?php esc_html_e('Add Listing', 'listingpro');?></a>
							<?php 
						}
					}
				?>
				<?php
					if (!is_user_logged_in()) {
						?>
					<a class="lpl-button md-trigger" data-modal="modal-3"><?php esc_html_e('Join Now', 'listingpro');?></a>
					<?php }  else { ?>					<a href="<?php echo wp_logout_url( esc_url(home_url('/')) ); ?>" class="lpl-button" style="right: 10px;"><?php esc_html_e('Sign out ','listingpro'); ?></a>					<?php } ?>
				<?php
					echo listingpro_mobile_menu();
				?>
			</div>
			<div class="row">
				<div class="header-right-panel clearfix col-lg-5 col-md-6 col-sm-4 col-xs-4">
					<?php
						if($headerSrch == 1) {
							if(!is_front_page() && !is_page_template('template-dashboard.php')){
								get_template_part('templates/search/top_search');
							}
						}
					?>
					
					
					<!--<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="slide-nav">
						<div class="container">
							<div class="navbar-header">
								<a class="navbar-toggle"> 
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
							</div>
							<div id="slidemenu">   
								<?php echo listingpro_primary_logo(); ?> 
								<div class="lp-listing-adlisting">
									<a href="<?php echo listingpro_url('add_listing_url_mode'); ?>" class="lpl-button">
										<?php esc_html_e('Add Listing', 'listingpro'); ?>
									</a>
									<a href="#" class="lpl-button md-trigger" data-modal="modal-3">
										<?php esc_html_e('Join Now', 'listingpro'); ?>
									</a>
								</div>
								<?php echo listingpro_mobile_menu(); ?>    
							</div>
						</div>
					</div>-->
					
					
					<div class="col-xs-4 col-sm-4 mobile-nav-icon">
						<a href="#menu" class="nav-icon">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
					<div class="<?php echo esc_attr($menuClass); ?> col-xs-12 lp-menu-container pull-left">
						<?php
							$listing_access_only_users = $listingpro_options['lp_allow_vistor_submit'];
							$showAddListing = true;
							if( isset($listing_access_only_users)&& $listing_access_only_users==1 ){
								$showAddListing = false;
								if(is_user_logged_in()){
									$showAddListing = true;
								}
							}
							$showAddListing = false;
							if($showAddListing==true){
							$addURL = listingpro_url('add_listing_url_mode');
							if(!empty($addURL)){
						?>
							<div class="pull-left lp-add-listing-btn">
								<ul>
									<li>
										<a href="<?php echo listingpro_url('add_listing_url_mode'); ?>">
											<i class="fa fa-plus"></i>
											<?php echo esc_html__('Add Listing', 'listingpro'); ?>
										</a>
									</li>
								</ul>
							</div>
						<?php 
							}
							}
						?>
						<div class="lp-menu pull-left menu">
							<?php
								if(is_front_page()) {
									echo listingpro_primary_menu();
								}else {
									echo listingpro_inner_menu();
								}
							?>
						</div>
					</div>
				</div>
				
				<div class="col-lg-2 col-md-2 col-xs-4 col-sm-4 lp-logo-container">
					<div class="lp-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<?php
							if(is_front_page()){
							    listingpro_primary_logo(); 
							}
							else{
								listingpro_secondary_logo(); 
							}
							?>
						</a>
					</div>
				</div>
				<div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 lp-socials-container  pull-right">
					<div class="lp-socials  pull-right">
						<?php //if ( is_active_sidebar( 'header-socials-sidebar' ) ) : ?>
							<?php //dynamic_sidebar( 'header-socials-sidebar' ); ?>
						<?php //endif; ?>
						<?php if(!empty($tw) || !empty($gog) || !empty($fb) || !empty($insta) || !empty($tumb) || !empty($fpintereset) || !empty($flinked) || !empty($fyout) || !empty($fvk)){ ?>
								
                                <ul class="social-icons header-social-icons">
									 <?php if(!empty($fyout)){ ?>
                                        <li>
                                            <a href="<?php echo esc_url($fyout); ?>" target="_blank">
												<img src="<?php echo $upload_url['baseurl']; ?>/2018/07/you-tube.png" />
                                                <?php //echo listingpro_icons('ytwite'); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
									
                                    <?php if(!empty($fb)){ ?>
                                        <li>
                                            <a href="<?php echo esc_url($fb); ?>" target="_blank">
												<img src="<?php echo $upload_url['baseurl']; ?>/2018/07/facebook-icon.png" />
                                                <?php //echo listingpro_icons('facebook'); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                   
                                    <?php if(!empty($tw)){ ?>
                                        <li>
                                            <a href="<?php echo esc_url($tw); ?>" target="_blank">
												<img src="<?php echo $upload_url['baseurl']; ?>/2018/07/twitter.png" />
												
                                                <?php //echo listingpro_icons('tw-footer'); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    
                                    <?php if(!empty($gog)){ ?>
                                        <li>
                                            <a href="<?php echo esc_url($gog); ?>" target="_blank">
												<img src="<?php echo $upload_url['baseurl']; ?>/2018/07/g-plus.png" />
                                                <?php //echo listingpro_icons('google'); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    
                                </ul>
                            <?php } ?>
					</div>
				</div>
				
			</div>
		</div>
	</div><!-- ../menu-bar -->
</header>
