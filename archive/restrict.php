<?php

function restrict_content_shortcode() {
    // start with an empty message
    $user_id = get_current_user_id();
    $user_firstname = get_user_meta( $user_id, 'first_name', true );
    $r_message = '<div id="restrict-message"><h2>';
	// check if user is logged in
    if ( is_user_logged_in() ) {
        // user is logged in
        $r_message .= 'Hello, ' . $user_firstname . '.';
        // check if the user has an active WooCommerce Subscription
        if ( wcs_user_has_subscription( $user_id, '', 'active' ) ) {
			// user is a subscriber
			$r_message .= ' You have an active subscription,';
            // check if the subscriber has an active membership
            if ( wc_memberships_is_user_active_member( $user_id, 'man-ed' ) ) {
                // subscriber has manufacturer's membership
                $r_message .= ' and have been assigned a seat on your organization\'s Manufacturer\'s Edition membership.</h2>';
            } else if ( wc_memberships_is_user_active_member( $user_id, 'con-ed' ) ) {
                // subscriber has a contractor's membership
                $r_message .= ' and have been assigned a seat on your organization\'s Contractor\'s Edition membership.</h2>';
            } else  if ( wc_memberships_is_user_active_member( $user_id, 'all-access' ) ) {
                // subscriber has an all-access membership
                $r_message .= ' and have been assigned a seat on your organization\'s All Access Edition membership.</h2>';
            } else  if ( wc_memberships_is_user_active_member( $user_id, 'sales-tax-vip' ) ) {
                // subscriber has an all-access membership
                $r_message .= ' and have been assigned a seat on your organization\'s Sales Tax VIP membership.</h2>';
            } else {
                // subscriber doess not have any membership
                $r_message .= ' but you have not been assigned a seat in your organization.</h2><p>Please go to <u><a href="/my-account/teams/">My Organization</a></u> to claim your seat and start accessing the material.</p><div class="restrict-button"><a href="/my-account/teams/" class="button">Claim Seat</a></div>';
            }
		} else {
			// user is not a subscriber
			$r_message .= ' You are not a subscriber.</h2>';
		}
	} else {
		//user is not logged in
		$r_message .= 'You must be logged in to access this content.</h2><p><b><u><a href="{login_url}">Click here to log in.</a></u></b></p>';
    }
    $r_message .= '</div>';
    return $r_message;
}
add_shortcode( 'restrict_content', 'restrict_content_shortcode' );
