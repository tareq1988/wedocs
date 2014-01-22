<li class="doc">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <div class="inside">
        <?php the_excerpt(); ?>

        <div class="feedback">
            <?php
            $positive = (int) get_post_meta( $post->ID, 'positive', true );
            $negative = (int) get_post_meta( $post->ID, 'negative', true );
            ?>
            <a href="#" class="tip positive" title="<?php printf( __( '%d people found this useful', 'wedevs-docs' ), $positive ); ?>"><i class="fa fa-check-square-o"></i> <?php echo $positive; ?></a>
            <a href="#" class="tip negative" title="<?php printf( __( '%d people found this not useful', 'wedevs-docs' ), $negative ); ?>"><i class="fa fa-times"></i> <?php echo $negative; ?></a>
        </div>
    </div>
</li>