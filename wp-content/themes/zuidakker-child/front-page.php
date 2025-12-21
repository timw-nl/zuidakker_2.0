<?php
/**
 * The front page template file
 * This displays the homepage with the 5 pillars and updates section
 *
 * @package Zuidakker Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="hero-section">
	<div class="container">
		<h1><?php _e('Welkom bij Zuidakker', 'zuidakker-child'); ?></h1>
		<p><?php _e('Ontdek Zuidakker door onze vijf hoofdgebieden: tuinen, geschiedenis, ontmoeting, voedseleducatie en verblijf.', 'zuidakker-child'); ?></p>
	</div>
</div>

<?php
// Display the 5 pillars using our custom shortcode
echo do_shortcode('[pillars_grid]');
?>

<?php
// Display the updates section
echo do_shortcode('[updates_section]');
?>

<?php
get_footer();
