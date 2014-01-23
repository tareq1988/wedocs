<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
    </article>
<?php endwhile; ?>