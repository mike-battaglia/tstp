<?php
function subscribers_content_shortcode($atts, $content = null) {
    // Get current user
    $user = wp_get_current_user();
    $user_id = $user->ID;

    // Check if the user has active subscription
    if ((wcs_user_has_subscription($user_id, '', 'active')||wcs_user_has_subscription($user_id, '', 'pending-cancel'))) {
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
    if ((wcs_user_has_subscription($user_id, '', 'active')||wcs_user_has_subscription($user_id, '', 'pending-cancel'))) {
        // If active, parse any nested shortcodes and display the content 
        return '';
    }
    // If no active subscription, do not display anything
    return do_shortcode($content);
}
add_shortcode('nonsubscribers_content', 'nonsubscribers_content_shortcode');

function display_user_first_name_shortcode() {
    $current_user = wp_get_current_user();
    $first_name = $current_user->user_firstname;
    
    if ( ! empty( $first_name ) ) {
        return $first_name;
    } else {
        return '';
    }
}
add_shortcode( 'user_first_name', 'display_user_first_name_shortcode' );

function loggedout_content_shortcode($atts, $content = null) {
    // check if user is logged out
    if (!is_user_logged_in()) {
        // If logged out, parse any nested shortcodes and display the content 
        return do_shortcode($content);
    }
    // If logged in, do not display anything
    return '';
}
add_shortcode('loggedout_content', 'loggedout_content_shortcode');

function loggedin_content_shortcode($atts, $content = null) {
    // check if user is logged in
    if (is_user_logged_in()) {
        // If logged in, parse any nested shortcodes and display the content 
        return do_shortcode($content);
    }
    // If logged out, do not display anything
    return '';
}
add_shortcode('loggedin_content', 'loggedin_content_shortcode');

function get_subscription_link() {
$current_user_id = get_current_user_id();
$subscriptions = wcs_get_users_subscriptions( $current_user_id );

if ( ! empty( $subscriptions ) ) {
    foreach ( $subscriptions as $subscription ) {
        $subscription_status = $subscription->get_status();
        
        if ( in_array( $subscription_status, array( 'active', 'pending-cancel' ) ) ) {
            $subscription_id = $subscription->get_id();
            $subscription_url = wc_get_endpoint_url( 'view-subscription', $subscription_id, wc_get_page_permalink( 'myaccount' ) );
            
            // Output the subscription link
            return do_shortcode('<a class="button" href="' . esc_url( $subscription_url ) . '#switch-note">Subscription #' . $subscription_id . ', Status="' . $subscription_status. '"</a>');
        	}
   		}
	} else {
		// Handle the case when the user has no subscriptions
		return 'No subscriptions found.';
		}
	}
add_shortcode('subscription_link', 'get_subscription_link');

/// ☕☕☕🟢🟢🟢
function claim_seat_shortcode() {
    $content = '<h1>Hello, [user_first_name].</h1>
    <h3>Your subscription comes with a number of seats for you and your team.</h3>
    <p>You need to claim your seat before you can access protected pages.</p>
    <p><a href="/my-account/teams" class="button restriction" style="float:left!important;">Claim seat →</a></p>';
    return do_shortcode($content);
}
add_shortcode( 'claimseat', 'claim_seat_shortcode' );

function get_access_prompt_shortcode() {
    if (is_user_logged_in()) {
		$content = '<h1>Hello, [user_first_name].</h1>
		<h3>Your [wcm_restrict plans="man-ed"]Manufacturer\'s[/wcm_restrict][wcm_restrict plans="con-ed"]Contractor\'s[/wcm_restrict] Edition membership does not grant access to this [wcm_restrict plans="man-ed"]Contractors[/wcm_restrict][wcm_restrict plans="con-ed"]Manufacturers[/wcm_restrict]-Only content.</h3>
		[subscribers_content]<p>Please upgrade to an All-Access subscription to view this page.</p>[subscription_link][/subscribers_content]
		[nonsubscribers_content]<p>Please ask your company account manager to upgrade your subscription to All-Access Edition.</p>[/nonsubscribers_content]';
		return do_shortcode($content);
	}
}
add_shortcode( 'get_access', 'get_access_prompt_shortcode' );

function nonmembers_prompt_shortcode() {
    // check if user is logged out
    $content = '';
	if (is_user_logged_in()) {
		$content .= '<h1>Hello, [user_first_name].</h1>
		[subscribers_content]<h3>Your subscription comes with a number of seats for you and your team.</h3>
    	<p>You need to claim your seat before you can access protected pages.</p>
	    <p><a href="/my-account/teams" class="button restriction" style="float:left!important;">Claim seat →</a></p>[/subscribers_content]
		[nonsubscribers_content]<p>Please purchase a subscription to access this content.</p><a href="/product/subscription/?attribute_edition=all-access-edition&attribute_tier=start-up-5-seats&attribute_billing=monthly" class="button restriction" style="float:left!important;">Subscribe</a>
		[/nonsubscribers_content]';
	}
	if (!is_user_logged_in()) {
		$content .= '<h3>Please purchase a subscription to access this content.</h3><a href="/product/subscription/?attribute_edition=all-access-edition&attribute_tier=start-up-5-seats&attribute_billing=monthly" class="button restriction" style="float:left!important;">Subscribe</a>';
	}
	return do_shortcode($content);
}

add_shortcode( 'nonmembers_prompt', 'nonmembers_prompt_shortcode' );

/// ☕☕☕🔴🔴🔴

// Restriction message for a subscriber with no seat.

/*function get_subscription_name() {
$current_user_id = get_current_user_id();
$subscriptions = wcs_get_users_subscriptions( $current_user_id );

if ( ! empty( $subscriptions ) ) {
    foreach ( $subscriptions as $subscription ) {
        $subscription_status = $subscription->get_status();
        
        if ( in_array( $subscription_status, array( 'active', 'pending-cancel' ) ) ) {
            $subscription_id = $subscription->get_id();
            $subscription_url = wc_get_endpoint_url( 'view-subscription', $subscription_id, wc_get_page_permalink( 'myaccount' ) );
            
            // Output the subscription link
            $subscription_meta = get_post( $subscription_id );
			$output = '<ul>';
			foreach ( $subscription_meta as $key => $value ) {
				$output .= "<li><strong>$key</strong>: $value</li>";
			}
			$output .= '</ul>';
				return do_shortcode($output);
        	}
		}
	} else {
		// Handle the case when the user has no subscriptions
		return 'No subscriptions found.';
		}
	}
add_shortcode('subscription_name', 'get_subscription_name');
*/

