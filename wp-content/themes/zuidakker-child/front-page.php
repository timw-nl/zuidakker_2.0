<?php
/**
 * The front page template file
 * This displays the Dutch homepage content with proper Kadence styling
 *
 * @package zuidakker-child
 */

namespace Kadence;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

kadence()->print_styles( 'kadence-content' );

// Hero section removed for homepage - we use custom hero in content
?>
<div id="primary" class="content-area">
	<div class="content-container site-container">
		<div id="main" class="site-main">
			<?php
			/**
			 * Hook for anything before main content
			 */
			do_action( 'kadence_before_main_content' );
			?>
			<div class="content-wrap">
				<?php
				// Get the actual homepage content (post ID 27)
				$homepage_id = get_option( 'page_on_front' );
				if ( $homepage_id ) {
					// Set up the post data for the homepage
					global $post;
					$post = get_post( $homepage_id );
					setup_postdata( $post );
					
					// Display only content without title
					?>
					<article class="entry content-bg single-content">
						<div class="entry-content single-content">
							<?php the_content(); ?>
						</div>
					</article>
					<?php
					
					wp_reset_postdata();
				} else {
					// Fallback content with proper Kadence structure
					?>
					<article class="entry content-bg single-content">
						<div class="entry-content single-content">
							<h1>Welkom bij Zuidakker</h1>
							<p>Ontdek ons gemeenschapsplatform met vijf hoofdactiviteiten</p>
							<?php echo do_shortcode('[pillars_grid]'); ?>
						</div>
					</article>
					<?php
				}
				?>
			</div>
			<?php	      
			/**
			 * Hook for anything after main content
			 */
			do_action( 'kadence_after_main_content' );
			?>
		</div><!-- #main -->
	</div>
</div><!-- #primary -->

<?php
get_footer();
