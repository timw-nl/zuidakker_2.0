<?php
/**
 * Plugin Name: Polylang Fixes for WordPress 6.7+
 * Description: Fixes Polylang issues including textdomain warning and comment query errors
 * Version: 2.0
 * Author: Zuidakker
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Fix 1: Polylang textdomain loading timing issue for WordPress 6.7+
 * 
 * This suppresses the _doing_it_wrong notice for Polylang's early textdomain loading.
 * Based on the approach used by WPForms for the same issue.
 */

// Only apply fix for WordPress 6.7+
if ( version_compare( $GLOBALS['wp_version'], '6.7', '>=' ) ) {
    
    /**
     * Suppress the _doing_it_wrong notice specifically for Polylang textdomain loading
     * 
     * @param bool   $trigger       Whether to trigger the error.
     * @param string $function_name The function that was called.
     * @param string $message       The message explaining what was done incorrectly.
     * @param string $version       The version of WordPress where the message was added.
     * @return bool
     */
    add_filter( 'doing_it_wrong_trigger_error', function( $trigger, $function_name, $message, $version ) {
        // Check if this is the textdomain loading warning for polylang
        if ( $function_name === '_load_textdomain_just_in_time' && 
             ( strpos( $message, 'polylang' ) !== false || strpos( $message, '<code>polylang</code>' ) !== false ) ) {
            // Suppress the notice
            return false;
        }
        return $trigger;
    }, 10, 4 );
    
}

/**
 * Fix 2: Polylang comment query SQL error
 * 
 * Fixes "Unknown column 'wp_posts.ID' in 'on clause'" error when Polylang
 * tries to filter comments by language but the query is malformed.
 * 
 * This happens because Polylang adds a JOIN to wp_term_relationships but
 * references wp_posts.ID which isn't properly joined in comment count queries.
 */

/**
 * Disable Polylang's comment language filtering
 * This prevents the SQL error while still allowing comments to work
 */
add_filter( 'pll_filter_comments_clauses', '__return_false', 999 );

/**
 * Alternative: Fix the SQL query by ensuring wp_posts is properly joined
 * This is a more comprehensive fix that maintains language filtering
 */
add_filter( 'comments_clauses', function( $clauses, $query ) {
    global $wpdb;
    
    // Only fix if Polylang is active and trying to filter by language
    if ( ! function_exists( 'pll_current_language' ) ) {
        return $clauses;
    }
    
    // Check if this is a comment count query with Polylang's language filter
    if ( strpos( $clauses['join'], 'pll_tr' ) !== false && 
         strpos( $clauses['join'], 'wp_posts.ID' ) !== false &&
         strpos( $clauses['join'], "FROM {$wpdb->posts}" ) === false ) {
        
        // The query references wp_posts.ID but doesn't join wp_posts properly
        // Fix by ensuring wp_posts is joined before the language filter
        if ( strpos( $clauses['join'], 'wp_posts_to_exclude_reviews' ) !== false ) {
            // Replace the problematic join with a corrected version
            $clauses['join'] = preg_replace(
                '/INNER JOIN ' . $wpdb->term_relationships . ' AS pll_tr ON pll_tr\.object_id = wp_posts\.ID/',
                'INNER JOIN ' . $wpdb->term_relationships . ' AS pll_tr ON pll_tr.object_id = wp_posts_to_exclude_reviews.ID',
                $clauses['join']
            );
        }
    }
    
    return $clauses;
}, 999, 2 );
