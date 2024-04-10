<?php
function subscribers_content_shortcode($atts, $content = null) {
    // Get current user
    $user = wp_get_current_user();
    $user_id = $user->ID;

    // Check if the user has active subscription
    if (wcs_user_has_subscription($user_id, '', 'active')) {
        // If active, parse any nested shortcodes and display the content 
        return do_shortcode($content);
    }
    // If no active subscription, do not display anything
    return '';
}
add_shortcode('subscribers_content', 'subscribers_content_shortcode');

function nonsubscribers_content_shortcode($atts, $content = null) {
    // Get current user
    $user = wp_get_current_user();
    $user_id = $user->ID;

    // Check if the user has active subscription
    if (wcs_user_has_subscription($user_id, '', 'active')) {
        // If active, parse any nested shortcodes and display the content 
        return '';
    }
    // If no active subscription, do not display anything
    return do_shortcode($content);
}
add_shortcode('nonsubscribers_content', 'nonsubscribers_content_shortcode');
