<?php
/**
 * The front page template file
 * This displays the homepage with the 5 pillars
 *
 * @package kadence
 */

namespace Kadence;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="hero-section">
	<div class="container">
		<h1><?php _e('Welcome to Zuidakker', 'kadence'); ?></h1>
		<p><?php _e('Discover our community platform with five main areas of activity', 'kadence'); ?></p>
	</div>
</div>

<?php
// Display the 5 pillars using our custom shortcode
echo do_shortcode('[pillars_grid]');
?>

<?php
get_footer();
