<?php
/**
 * Template Name: Page Template
* The front page template file
*/
get_header('home');
?>
<section class="masthead">
    <?php
    the_post_thumbnail('full');
    ?>
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

