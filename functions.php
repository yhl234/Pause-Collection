<?php
/*This file is part of PauseCollection, storefront child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function PauseCollection_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'PauseCollection_enqueue_child_styles' );

/*Write here your own functions */

// remove
// replace footer credit
function remove_storefront_credit(){
	remove_action( 'storefront_footer','storefront_credit', 20 );
}
function pause_credit(){
		$links_output = '';
		if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
			$separator = '<span role="separator" aria-hidden="true"></span>';
			$links_output = get_the_privacy_policy_link( '', ( ! empty( $links_output ) ? $separator : '' ) ) . $links_output;
		}
		
		$links_output = apply_filters( 'storefront_credit_links_output', $links_output );
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>

			<?php if ( ! empty( $links_output ) ) { ?>
				<br />
				<?php echo wp_kses_post( $links_output ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
}
add_action('storefront_footer', 'remove_storefront_credit');
add_action('storefront_footer', 'pause_credit', 20 );

function remove_storefront_sidebar() {
	if ( is_woocommerce() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
	}
}
add_action( 'get_header', 'remove_storefront_sidebar' );

// Remove body class and change it into Fullwidth
function pause_remove_sidebar_class_body( $wp_classes ) {
$wp_classes[] = 'page-template-template-fullwidth-php';
return $wp_classes;
}
add_filter( 'body_class', 'pause_remove_sidebar_class_body', 10 );



// Reorder header hooks
function reorder_header_cart(){
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_header_cart', 60);
    add_action('storefront_header', 'storefront_product_search', 60);
    add_action( 'storefront_header', 'pc_header_cart', 40);
}
add_action( 'storefront_header', 'reorder_header_cart' );

function pc_header_cart() {
    if ( storefront_is_woocommerce_activated() ) {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <div class="branding-right">
            <ul id="site-header-cart" class="site-header-cart menu">
                <li class="<?php echo esc_attr( $class ); ?>">
                    <?php storefront_cart_link(); ?>
                </li>
                <li>
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </li>
            </ul>
            <a id="site-header-account" href="https://yhl234.xyz/my-account/">My account</a>

        </div>

        <?php
    }
}


// Add My Account hook
function pc_header_account(){
     echo '<div>
               <a href="https://yhl234.xyz/my-account/">My account</a>
           </div>';
}
//add_action( 'storefront_header', 'pc_header_account', 41 );


// Remove section from Customizer
function pause_customize_register() {     
global $wp_customize;
$wp_customize->remove_section( 'storefront_layout');
} 
add_action( 'customize_register', 'pause_customize_register', 11 );




