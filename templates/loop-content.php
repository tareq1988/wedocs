<li class="doc">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <div class="inside">
        <?php the_excerpt(); ?>

        <?php get_template_part( 'templates/content', 'feedback' ); ?>
    </div>
</li>