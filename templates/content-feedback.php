<?php global $post; ?>

<div class="wedoc-feedback-wrap">
    <?php
    $positive = (int) get_post_meta( $post->ID, 'positive', true );
    $negative = (int) get_post_meta( $post->ID, 'negative', true );
    ?>
    <a href="#" class="tip positive" data-id="<?php the_ID(); ?>" data-type="positive" title="<?php printf( _n( '%d people found this useful', '%d peoples found this useful', $positive, 'wedocs' ), $positive ); ?>"><i class="fa fa-check-square-o"></i> <?php echo $positive; ?></a>
    <a href="#" class="tip negative" data-id="<?php the_ID(); ?>" data-type="negative" title="<?php printf( _n( '%d people found this not useful', '%d peoples found this not useful', $negative, 'wedocs' ), $negative ); ?>"><i class="fa fa-times"></i> <?php echo $negative; ?></a>
</div>