<li class="category">
    <h3><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></h3>

    <div class="inside">
        <?php if ( !empty( $category->description ) ) { ?>
            <?php echo $category->description; ?>
        <?php } ?>
    </div>
</li>