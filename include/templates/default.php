<div class="ninja_res_menu_group ninja_res_menu_<?php echo esc_attr($display); ?>">
	<?php foreach ( $items as $item ): ?>
		<?php setup_postdata( $item ); ?>
        <div class="res-item res_item_id_<?php echo esc_attr($item->ID); ?>  <?php echo esc_attr($modalClass); ?>"
             data-res_menu_id="<?php echo esc_attr($item->ID); ?>">
            <div class="res_featured_image">
                <a href="<?php get_the_permalink( $item ); ?>">
					<?php echo get_the_post_thumbnail( $item, 'medium' ); ?>
                </a>
            </div>
            <div class="res-item-content">
                <h3 class="res_item_title">
					<?php echo get_the_title( $item ); ?>
					<?php if ( $item->price ): ?>
                        <span class="res_item_price"> <?php echo esc_html($currency); ?><?php echo esc_html($item->price); ?></span>
					<?php endif; ?>
                </h3>
                <div class="res_item_content">
	                <?php echo trendyRestaurantMenuWordExcerpt($item, $excerptLength, 'default' ); ?>
                </div>
            </div>
        </div>
		<?php wp_reset_postdata(); ?>
	<?php endforeach; ?>
</div>

    