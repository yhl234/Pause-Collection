<?php
/**
 * Template Name: Home Template
* The front page template file
*/
get_header('home');
?>

<section>
        <?php do_shortcode('[pc_feature_products_shortcode]') ?>
    </section>


<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		while ( have_posts() ) : the_post();
		the_content();
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

