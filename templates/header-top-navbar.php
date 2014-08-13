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

<div class="container">
	<div class="top-search-form">
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-2">
				<form role="search" method="get" class="search-form form-inline" action="<?php echo home_url('/'); ?>">
				    <div class="form-group col-md-5">
				        <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'wedocs'); ?> <?php bloginfo('name'); ?>">
				        <label class="hide"><?php _e('Search for:', 'wedocs'); ?></label>
				    </div>

				    <div class="form-group col-md-3">
				    	<?php wp_dropdown_categories( array( 'show_option_all' => __( 'All Documents', 'wedocs' ), 'hide_empty' => false, 'hierarchical' => true, 'class' => 'form-control', 'id' => 'wedevs-category' ) ); ?>
				    </div>

				    <div class="form-group col-md-2">
				    	<button type="submit" class="search-submit btn btn-primary"><?php _e('Search', 'wedocs'); ?></button>
				    </div>
				</form>
	        </div>
	    </div>
	</div> <!-- .top-search-form -->

	<div class="row">
		<div class="col-md-12">
			<?php wedocs_breadcrumbs(); ?>
		</div>
	</div>
</div>
