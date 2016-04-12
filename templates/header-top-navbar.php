<header class="banner navbar navbar-default navbar-static-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php _e( 'Toggle navigation', 'wedocs' ); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
		</div>

		<nav class="collapse navbar-collapse" role="navigation">
			<?php
				if ( has_nav_menu('primary_navigation') ) :
					wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav') );
				endif;
			?>
		</nav>
	</div>
</header>

<div class="top-search-form" id="top-search-form">
	<div class="container">

	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
				<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">

					<div class="input-group">
						<label class="hide"><?php _e('Search for:', 'wedocs'); ?></label>
						<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control input-lg" placeholder="<?php _e('Search', 'wedocs'); ?> <?php bloginfo('name'); ?>">
						<input type="hidden" name="search_param" value="<?php echo is_search() ? esc_attr( $_REQUEST['search_param'] ) : 'all'; ?>" id="search_param">

						<div class="input-group-btn">
		                    <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 0;">
		                    	<span id="search_concept">
		                    		<?php
		                    		$param = isset( $_GET['search_param'] ) ? sanitize_text_field( $_GET['search_param'] ) : 'all';

		                    		if ( is_search() && $param != 'all' ) {
		                    			$page_id = (int) $param;

		                    			if ( $search_title = get_post_field( 'post_title', $page_id, 'display' ) ) {
		                    				echo esc_html( $search_title );
		                    			} else {
		                    				_e( 'All Docs', 'wedocs' );
		                    			}

		                    		} else {
		                    			_e( 'All Docs', 'wedocs' );
		                    		} ?>
		                    	</span> <span class="caret"></span>
		                    </button>
							<ul class="dropdown-menu">
								<?php
								$docs = get_pages( array(
									'parent'    => 0,
									'post_type' => 'docs'
								) );

								foreach ($docs as $doc) {
									printf( '<li><a href="#%s">%s</a></li>', $doc->ID, $doc->post_title );
								}
								?>
								<li class="divider"></li>
								<li><a href="#all"><?php _e('All Docs', 'wedocs'); ?></a></li>
							</ul>

							<button type="submit" class="search-submit btn btn-primary btn-lg"><?php _e('Search', 'wedocs'); ?></button>
						</div><!-- /btn-group -->
					</div><!-- /input-group -->

				</form>
	        </div>
	    </div>
	</div>
</div>