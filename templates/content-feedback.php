<?php global $post; ?>

<div class="wedoc-feedback-wrap">
    <?php
    $positive = (int) get_post_meta( $post->ID, 'positive', true );
    $negative = (int) get_post_meta( $post->ID, 'negative', true );

    $positive_title = $positive ? sprintf( _n( '%d person found this useful', '%d persons found this useful', $positive, 'wedocs' ), $positive ) : __( 'No votes yet', 'wedocs' );
    $negative_title = $negative ? sprintf( _n( '%d person found this not useful', '%d persons found this not useful', $negative, 'wedocs' ), $negative ) : __( 'No votes yet', 'wedocs' );
    ?>
    <a href="#" class="tip positive" data-id="<?php the_ID(); ?>" data-type="positive" title="<?php echo esc_attr( $positive_title ); ?>"><i class="fa fa-check-square-o"></i> <?php echo $positive; ?></a>
    <a href="#" class="tip negative" data-id="<?php the_ID(); ?>" data-type="negative" title="<?php echo esc_attr( $negative_title ); ?>"><i class="fa fa-times"></i> <?php echo $negative; ?></a>
</div>