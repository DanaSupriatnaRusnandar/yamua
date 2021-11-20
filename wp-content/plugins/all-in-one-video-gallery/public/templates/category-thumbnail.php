<?php

/**
 * Category Thumbnail.
 *
 * @link    https://plugins360.com
 * @since   1.0.0
 *
 * @package All_In_One_Video_Gallery
 */

$permalink = aiovg_get_category_page_url( $term );        
$image_id  = get_term_meta( $term->term_id, 'image_id', true );
$image     = aiovg_get_image_url( $image_id, 'large' );
?>

<div class="aiovg-thumbnail">
    <a href="<?php echo esc_url( $permalink ); ?>" class="aiovg-responsive-container" style="padding-bottom: <?php echo esc_attr( $attributes['ratio'] ); ?>;">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="aiovg-responsive-element" />
    </a>
    
    <div class="aiovg-caption">
        <div class="aiovg-title">
            <a href="<?php echo esc_url( $permalink ); ?>" class="aiovg-link-title"><?php echo esc_html( $term->name ); ?></a>
        </div>
            
        <?php if ( ! empty( $attributes['show_description'] ) && $term->description ) : ?>
            <div class="aiovg-description"><?php echo wp_kses_post( nl2br( $term->description ) ); ?></div>
        <?php endif; ?>
        
        <?php if ( ! empty( $attributes['show_count'] ) ) : ?>
            <div class="aiovg-count aiovg-text-muted">
                <svg class="aiovg-svg-icon aiovg-svg-icon-videos" width="16" height="16" viewBox="0 0 32 32">
                    <path d="M0 4v24h32v-24h-32zM6 26h-4v-4h4v4zM6 18h-4v-4h4v4zM6 10h-4v-4h4v4zM24 26h-16v-20h16v20zM30 26h-4v-4h4v4zM30 18h-4v-4h4v4zM30 10h-4v-4h4v4zM12 10v12l8-6z"></path>
                </svg>
                <?php 
                if ( $term->count > 1 ) {
                    printf( __( '%s videos', 'all-in-one-video-gallery' ), $term->count ); 
                } else {
                    printf( __( '%s video', 'all-in-one-video-gallery' ), $term->count ); 
                }    
                ?>
            </div>
        <?php endif; ?>
    </div>            			
</div>