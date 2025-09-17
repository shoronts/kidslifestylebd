<?php

// Disable user enumeration
if (!is_admin()) {
    if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
        wp_redirect(home_url());
        exit;
    }
};

// Restrict API to Logged-in Users Only
add_filter('rest_authentication_errors', function ($result) {
    if ( is_user_logged_in() ) {
        return $result;
    }
    $request_uri = $_SERVER['REQUEST_URI'];
    // Define allowed endpoints for guests
    $allowed_endpoints = array(
        '/wp-json/wc/store/',  // WooCommerce Store API (frontend cart/checkout)
        '/wp-json/wc/v3/',     // WooCommerce legacy REST API
        '/wp-json/contact-form-7/', // Example: Contact Form 7
        // Add your custom endpoints here if needed
    );
    // Check if request matches any allowed endpoint
    foreach ( $allowed_endpoints as $endpoint ) {
        if ( strpos( $request_uri, $endpoint ) !== false ) {
            return $result;
        }
    }
    // Optionally log blocked requests for debugging
    if ( WP_DEBUG === true ) {
        error_log( '[REST API BLOCKED] URI: ' . $request_uri );
    }
    // Block everything else
    return new WP_Error(
        'rest_cannot_access',
        __( 'REST API restricted to logged-in users only.', 'your-textdomain' ),
        array( 'status' => 403 )
    );
});

remove_action('wp_head', 'wp_generator');

// block users who fail to log in three times 
function limit_failed_logins()
{
    $max_attempts = 3;
    $lockout_time = 3600;

    $failed_attempts = get_transient('failed_logins_' . $_SERVER['REMOTE_ADDR']);
    $remaining_time = get_transient('failed_logins_time_' . $_SERVER['REMOTE_ADDR']);

    if ($failed_attempts === false) {
        set_transient('failed_logins_' . $_SERVER['REMOTE_ADDR'], 1, $lockout_time);
        set_transient('failed_logins_time_' . $_SERVER['REMOTE_ADDR'], time(), $lockout_time);
    } else {
        if ($failed_attempts >= $max_attempts) {
            $time_left = $remaining_time + $lockout_time - time();
            if ($time_left > 0) {
                wp_die('You have been locked out due to multiple failed login attempts. Please try again in ' . human_time_diff(time(), $remaining_time + $lockout_time) . '.');
            } else {
                set_transient('failed_logins_' . $_SERVER['REMOTE_ADDR'], 1, $lockout_time);
                set_transient('failed_logins_time_' . $_SERVER['REMOTE_ADDR'], time(), $lockout_time);
            }
        } else {
            set_transient('failed_logins_' . $_SERVER['REMOTE_ADDR'], $failed_attempts + 1, $lockout_time);
        }
    }
}

add_action('wp_login_failed', 'limit_failed_logins');

// Change Login Page Background and Logo
function custom_login_background() {
    ?>
    <style type="text/css">
        body.login {
            background-color: #17387E;
        }

        #login .wp-login-logo a {
            background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/media/logo.png');
            background-size: contain;
            width: 100%;
            height: 80px;
            display: block;
        }

        #login #loginform,
        #login-message {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #login #loginform {
            padding: 20px;
        }
        
        #login-message {
            padding: 10px;
            border-left: none;
        }
        #login-message p {
            margin: 0;
            font-size: 16px;
            color: #333;
            text-align: center;
        }

        .login #backtoblog a, .login #nav a{
            color: #fff!important;
        }
        .login #backtoblog a:hover, .login #nav a:hover{
            color: #F79B1C!important;
        }
        .login #wp-submit {
            background-color: #17387E;
        }
        .login #wp-submit:hover {
            background-color: #F79B1C;
            border-color: #F79B1C;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_background');

// Replace the Admin Dashboard Header Logo
function custom_admin_logo_css() {
    echo '<style>
        #wp-admin-bar-wp-logo a span.ab-icon:before {
            content: ""!important;
            display: inline-block;
            width: 20px!important;
            height: 20px!important;
            background: url("' . esc_url(get_template_directory_uri() . '/assets/media/logo.png') . '") no-repeat center center;
            background-size: contain;
            vertical-align: middle;
            background-color: #17387E;
            border-radius: 4px; 
        }
        #wp-admin-bar-wp-logo>.ab-item{
            margin-top: -3px;
        }
        @media all and (max-width: 782px) {
            #wp-admin-bar-wp-logo>.ab-item {
                margin-top: 0;
            }
            #wp-admin-bar-wp-logo a span.ab-icon:before {
                height: 25px!important;
                width: 25px!important;
            }
        }
    </style>';
}
add_action('admin_head', 'custom_admin_logo_css');
add_action('admin_enqueue_scripts', 'custom_admin_logo_css');

// Logo in the Admin Dashboard Header

function add_custom_logo_to_admin_menu() {
    echo '
    <style>
        #adminmenu:before {
            content: "";
            display: block;
            height: 100px;
            background: url("' . esc_url(get_template_directory_uri() . '/assets/media/logo.png') . '") no-repeat center center;
            background-size: contain;
            background-color: #17387E;
            padding: 20px;
        }
    </style>';
}
add_action('admin_head', 'add_custom_logo_to_admin_menu');

