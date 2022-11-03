<div id="restaurant_modal_<?php echo esc_attr($postID); ?>" class="tr_modal_dialog">
    <div class="modal_item">
        <a title="Close" class="tr_close">x</a>
		<?php $featuredImage = get_the_post_thumbnail_url($post, 'large'); ?>
        <?php do_action('tr_menu_before_modal_header', $post); ?>
		<?php if ( $featuredImage ): ?>
            <div style="background-image: url('<?php echo esc_url($featuredImage); ?>')" class="tr_header_holder">
                <div class="tr_header_section">
                    <h3><?php echo esc_html($post->post_title); ?></h3>
					<?php if ( $price ): ?>
                        <p class="centered_price"><?php echo esc_html($currency); ?><?php echo esc_html($price); ?></p>
					<?php endif; ?>
	                <?php do_action('tr_menu_after_modal_header_inner', $post); ?>
                </div>
            </div>
		<?php endif; ?>
        
        <div class="tr_modal_content">
	        <?php do_action('tr_menu_at_modal_content_start', $post); ?>
	        <?php if ( ! $featuredImage ): ?>
                <h2 class="tr_inner_title"><?php echo esc_html($post->post_title); ?></h2>
	        <?php endif; ?>

            <?php
	        if ($subheader = get_post_meta($post->ID, '_ninja_restaurant_sub_header', true)):
		        ?>
                <h4 class="tr_sub_header"><?php echo esc_html($subheader); ?></h4>
	        <?php endif; ?>

	        <?php
	        $categories = wp_get_post_terms( $post->ID, \TrendyRestaurantMenu\Classes\PostTypeClass::$mealTypeName );
	        if ( count( $categories ) ):
		        echo '<div class="tr_tax_items">';
		        foreach ( $categories as $category ):
			        echo '<span>' . esc_html($category->name) . '</span>';
		        endforeach;
		        echo "</div>";
	        endif;
	        ?>
            <div class="tr_item_content">
				<?php echo do_shortcode($post->post_content); ?>
            </div>
        </div>
	    <?php do_action('tr_menu_after_modal_content', $post); ?>
        <?php if ( $nutrition ) : ?>
            <div class="tr_inner_content tr_nutrition">
                <h4 class="tr_inner_title">
					<?php _e( 'Nutrition', 'tr_menu' ); ?>
                </h4>
                <div class="tr_nutrition_lists">
                    <ul class="nutrition_info">
						<?php foreach ( $nutrition as $nutrition_label => $nutrition_value ): ?>
                            <li>
                                <span class="nutrition_label"><strong><?php echo esc_html($nutrition_label); ?></strong></span>:
                                <span class="nutrition_value"><?php echo esc_html($nutrition_value); ?></span>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
		<?php endif; ?>
	    <?php do_action('tr_menu_before_modal_ingredients', $post, $ingredients); ?>
        <?php if ( $ingredients ): ?>
            <div class="tr_inner_content tr_nutrition">
                <h4 class="tr_inner_title">
					<?php _e( 'Ingredients', 'tr_menu' ); ?>
                </h4>
                <div class="ingredients">
				    <?php echo do_shortcode($ingredients); ?>
                </div>
            </div>
		<?php endif; ?>
	    <?php do_action('tr_menu_after_modal_ingredients', $post, $ingredients); ?>
    </div>
</div>