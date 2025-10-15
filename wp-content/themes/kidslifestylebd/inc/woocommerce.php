<?php

// Add WooCommerce Support
function stit_add_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'stit_add_woocommerce_support');

// Force "Buy Now" to redirect to Checkout instead of Cart
add_filter('woocommerce_add_to_cart_redirect', function ($url) {
    if (
        isset($_REQUEST['buy_now']) &&
        isset($_REQUEST['add-to-cart']) &&
        strpos(wp_get_referer(), '/product/') !== false
    ) {
        return wc_get_checkout_url();
    }
    return $url;
});

add_action('wp_enqueue_scripts', function () {
    if (function_exists('is_woocommerce') || is_page()) {
        wp_enqueue_script('wc-add-to-cart');
        wp_enqueue_script('wc-add-to-cart-variation');
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('jquery');
    }
}, 20);

// Disable AJAX add to cart for variable products when "Buy Now" is used
// add_action('wp_enqueue_scripts', function () {
//     if (is_product() && isset($_REQUEST['buy_now'])) {
//         wp_dequeue_script('wc-add-to-cart-variation');
//     }
// }, 999);

// Change the number of products or columns
add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 7;
    return $args;
});

// Remove Sidebar
function remove_woocommerce_sidebar()
{
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('template_redirect', 'remove_woocommerce_sidebar');

// Woo Full Name Checkout with Bootstrap

add_filter('woocommerce_checkout_fields', function ($fields) {
    $keep_billing = [
        'billing_full_name',
        'billing_phone',
        'billing_address_1',
        'billing_country', 
        // 'billing_address_2', 
        // 'billing_city', 
        // 'billing_postcode', 
        // 'billing_state'
    ];

    foreach ($fields['billing'] as $key => $field) {
        if (!in_array($key, $keep_billing)) {
            unset($fields['billing'][$key]);
        }
    }
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    $fields['billing']['billing_full_name'] = array(
        'type' => 'text',
        'label' => __('নাম', 'woocommerce'),
        'placeholder' => _x('নাম', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('form-row-wide'),
        'input_class' => array('form-control'),
        'priority' => 10,
    );
    if (isset($fields['billing']['billing_country'])) {
        $fields['billing']['billing_address_1']['required'] = true;
        $fields['billing']['billing_country']['label'] = __('দেশ/এলাকা', 'woocommerce');
    }
    if (isset($fields['billing']['billing_address_1'])) {
        $fields['billing']['billing_address_1']['required'] = true;
        $fields['billing']['billing_address_1']['label'] = __('ঠিকানা', 'woocommerce');
        $fields['billing']['billing_address_1']['placeholder'] = __('বাসা নং, রোড নং, থানা, জেলা', 'woocommerce');
        $fields['billing']['billing_address_1']['class'][] = 'form-row-wide';
    }
    if (isset($fields['billing']['billing_phone'])) {
        $fields['billing']['billing_phone']['required'] = true;
        $fields['billing']['billing_phone']['label'] = __('নাম্বার', 'woocommerce');
        $fields['billing']['billing_phone']['placeholder'] = _x('নাম্বার', 'placeholder', 'woocommerce');
    }
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['required'] = false;
        $fields['order']['order_comments']['label'] = __('অর্ডার নোটস', 'woocommerce');
        $fields['order']['order_comments']['placeholder'] = __('আপনার অর্ডার সম্পর্কে নোট, যেমন ডেলিভারির জন্য বিশেষ নির্দেশনা।', 'woocommerce');
    }
    foreach ($fields as $fieldset_key => $fieldset) {
        foreach ($fieldset as $key => $field) {
            if (!isset($fields[$fieldset_key][$key]['input_class'])) {
                $fields[$fieldset_key][$key]['input_class'] = array();
            }
            $fields[$fieldset_key][$key]['input_class'][] = 'form-control';
            $fields[$fieldset_key][$key]['class'][] = 'mb-3'; // Optional spacing
        }
    }

    // Optionally, disable "Ship to a different address" checkbox
    // add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

    return $fields;

}, 20);

add_filter('woocommerce_default_address_fields', function($fields) {
    $fields['address_1']['label'] = __('ঠিকানা', 'woocommerce');
    $fields['address_1']['placeholder'] = __('বাসা নং, রোড নং, থানা, জেলা', 'woocommerce');
    $fields['address_1']['class'][] = 'form-row-wide';
    $fields['address_1']['required'] = true;
    return $fields;
});

// Save Full Name (split) for billing & shipping
add_action('woocommerce_checkout_create_order', function ($order, $data) {
    // Billing
    if (!empty($data['billing_full_name'])) {
        $full_name = trim($data['billing_full_name']);
        $parts = explode(' ', $full_name, 2);
        $order->set_billing_first_name($parts[0]);
        $order->set_billing_last_name(isset($parts[1]) ? $parts[1] : '');
    }

    // Shipping
    if (!empty($data['shipping_full_name'])) {
        $full_name = trim($data['shipping_full_name']);
        $parts = explode(' ', $full_name, 2);
        $order->set_shipping_first_name($parts[0]);
        $order->set_shipping_last_name(isset($parts[1]) ? $parts[1] : '');
    }
}, 10, 2);

// Show Full Name in admin order details
add_action('woocommerce_admin_order_data_after_billing_address', function ($order) {
    $full_name = trim($order->get_billing_first_name() . ' ' . $order->get_billing_last_name());
    echo '<p><strong>' . __('Billing Full Name') . ':</strong> ' . esc_html($full_name) . '</p>';
});
add_action('woocommerce_admin_order_data_after_shipping_address', function ($order) {
    $full_name = trim($order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name());
    echo '<p><strong>' . __('Shipping Full Name') . ':</strong> ' . esc_html($full_name) . '</p>';
});

// My Account edit address forms
add_filter('woocommerce_billing_fields', function ($fields) {
    if (is_account_page()) {
        unset($fields['billing_first_name']);
        unset($fields['billing_last_name']);
        $fields['billing_full_name'] = array(
            'label'       => __('Full Name', 'woocommerce'),
            'placeholder' => _x('Full Name', 'placeholder', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'input_class' => array('form-control'),
            'priority'    => 10,
        );
    }
    return $fields;
}, 999);

add_filter('woocommerce_shipping_fields', function ($fields) {
    if (is_account_page()) {
        unset($fields['shipping_first_name']);
        unset($fields['shipping_last_name']);
        $fields['shipping_full_name'] = array(
            'label'       => __('Full Name', 'woocommerce'),
            'placeholder' => _x('Full Name', 'placeholder', 'woocommerce'),
            'required'    => false,
            'class'       => array('form-row-wide'),
            'input_class' => array('form-control'),
            'priority'    => 10,
        );
    }
    return $fields;
}, 999);

// Save My Account edits
add_action('woocommerce_customer_save_address', function ($user_id, $load_address) {
    if ($load_address === 'billing' && isset($_POST['billing_full_name'])) {
        $full_name = trim(sanitize_text_field($_POST['billing_full_name']));
        $parts = explode(' ', $full_name, 2);
        update_user_meta($user_id, 'billing_first_name', $parts[0]);
        update_user_meta($user_id, 'billing_last_name', isset($parts[1]) ? $parts[1] : '');
    }

    if ($load_address === 'shipping' && isset($_POST['shipping_full_name'])) {
        $full_name = trim(sanitize_text_field($_POST['shipping_full_name']));
        $parts = explode(' ', $full_name, 2);
        update_user_meta($user_id, 'shipping_first_name', $parts[0]);
        update_user_meta($user_id, 'shipping_last_name', isset($parts[1]) ? $parts[1] : '');
    }
}, 10, 2);


// Style buttons
add_filter('woocommerce_order_button_html', function ($button) {
    return str_replace('button alt', 'button alt see-btn w-100', $button);
});

// Completely remove the Terms & Conditions checkbox field from checkout fields.
add_filter('woocommerce_checkout_fields', function ($fields) {
    if (isset($fields['account']['terms'])) {
        unset($fields['account']['terms']);
    }
    if (isset($fields['terms'])) {
        unset($fields['terms']);
    }
    return $fields;
}, 99);

// Remove the Privacy Policy text, Terms page content, and checkbox output.
remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);

// Provide AJAX URL and nonce for checkout remove
add_action('wp_enqueue_scripts', function () {
    wp_localize_script('wc-checkout', 'my_ajax_object', array(
        'ajax_url'     => admin_url('admin-ajax.php'),
        'remove_nonce' => wp_create_nonce('my_remove_checkout_item_nonce'),
        'qty_nonce'    => wp_create_nonce('update-qty-nonce'),
    ));
});

// Handle AJAX remove
add_action('wp_ajax_remove_checkout_item', 'handle_checkout_item_removal');
add_action('wp_ajax_nopriv_remove_checkout_item', 'handle_checkout_item_removal');

function handle_checkout_item_removal()
{
    check_ajax_referer('my_remove_checkout_item_nonce', 'nonce');
    $cart_item_key = sanitize_text_field($_POST['cart_item_key'] ?? '');
    if ($cart_item_key && WC()->cart->remove_cart_item($cart_item_key)) {
        WC()->cart->calculate_totals();
        ob_start();
        woocommerce_order_review();
        $new_table = ob_get_clean();
        wp_send_json_success(array(
            'fragments' => array(
                '#checkout-table' => $new_table,
            ),
        ));
    } else {
        wp_send_json_error('Could not remove item.');
    }
    wp_die();
}

/**
 * AJAX handler to update quantity
 */
add_action('wp_ajax_update_checkout_item_qty', 'handle_ajax_update_checkout_item_qty');
add_action('wp_ajax_nopriv_update_checkout_item_qty', 'handle_ajax_update_checkout_item_qty');

function handle_ajax_update_checkout_item_qty()
{
    check_ajax_referer('update-qty-nonce', 'nonce');
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);
    if (!$cart_item_key || $quantity < 0) {
        wp_send_json_error('Invalid request.');
    }
    WC()->cart->set_quantity($cart_item_key, $quantity, true);
    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    ob_start();
    woocommerce_order_review();
    $fragments['.woocommerce-checkout-review-order-table'] = ob_get_clean();
    wp_send_json_success(['fragments' => $fragments]);
}

// Add Wishlist to My Account Menu
add_filter('woocommerce_account_menu_items', 'custom_add_wishlist_menu_item', 40);
function custom_add_wishlist_menu_item($items)
{
    // Add 'wishlist' item before logout
    $wishlist_item = array('wishlist' => 'Wishlist');
    $logout = array('customer-logout' => $items['customer-logout']);
    unset($items['customer-logout']);

    // Merge the wishlist and logout item
    $items = array_merge($items, $wishlist_item, $logout);
    return $items;
}

// Change the Wishlist URL to /wishlist/
add_filter('woocommerce_get_endpoint_url', 'custom_change_wishlist_menu_url', 10, 4);
function custom_change_wishlist_menu_url($url, $endpoint, $value, $permalink)
{
    if ($endpoint === 'wishlist') {
        // Use absolute URL to /wishlist/
        return home_url('/wishlist/');
    }

    return $url;
}

// Add is-active class when on Wishlist page

add_filter('woocommerce_account_menu_item_classes', 'custom_highlight_wishlist_menu', 10, 2);
function custom_highlight_wishlist_menu($classes, $endpoint)
{
    $current_url = trim($_SERVER['REQUEST_URI'], '/');
    $on_wishlist = preg_match('#(^wishlist$|/wishlist/?$)#', $current_url);

    // Add is-active only to wishlist endpoint
    if ($endpoint === 'wishlist' && $on_wishlist) {
        $classes[] = 'is-active';
    }

    // Remove is-active from others when on /wishlist
    if ($endpoint !== 'wishlist' && $on_wishlist) {
        $classes = array_diff($classes, ['is-active']);
    }

    return $classes;
}


// Enqueue JS and Add AJAX Script

function enqueue_custom_wishlist_script()
{
    wp_enqueue_script('custom-wishlist', get_template_directory_uri() . '/assets/js/wishlist.js', ['jquery'], null, true);
    wp_localize_script('custom-wishlist', 'wishlist_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('wishlist_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_wishlist_script');

// Add product in wishlist

add_action('wp_ajax_add_to_wishlist', 'custom_add_to_wishlist');
add_action('wp_ajax_nopriv_add_to_wishlist', 'custom_add_to_wishlist');

function custom_add_to_wishlist()
{
    $product_id = intval($_POST['product_id']);

    if (!$product_id || get_post_type($product_id) !== 'product') {
        wp_send_json_error(['message' => 'Invalid product.']);
    }

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $wishlist = get_user_meta($user_id, '_custom_wishlist', true);
        if (!is_array($wishlist)) {
            $wishlist = [];
        }

        if (in_array($product_id, $wishlist)) {
            wp_send_json_success([
                'message' => 'Already in wishlist',
                'redirect_to_wishlist' => true,
                'redirect_url' => site_url('/wishlist')
            ]);
        }

        $wishlist[] = $product_id;
        update_user_meta($user_id, '_custom_wishlist', $wishlist);

        wp_send_json_success(['message' => 'Added to wishlist']);
    } else {
        wp_send_json_error(['message' => 'Please log in to save wishlist']);
    }

    wp_die();
}

// Remove products from wishlist

add_action('wp_ajax_remove_from_wishlist', 'custom_remove_from_wishlist');
add_action('wp_ajax_nopriv_remove_from_wishlist', 'custom_remove_from_wishlist');

function custom_remove_from_wishlist()
{
    check_ajax_referer('wishlist_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    if (!$product_id || get_post_type($product_id) !== 'product') {
        wp_send_json_error(['message' => 'Invalid product.']);
    }

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $wishlist = get_user_meta($user_id, '_custom_wishlist', true) ?: [];

        $wishlist = array_diff($wishlist, [$product_id]);
        update_user_meta($user_id, '_custom_wishlist', $wishlist);

        wp_send_json_success(['message' => 'Removed from wishlist']);
    } else {
        wp_send_json_error(['message' => 'Please log in to modify wishlist']);
    }

    wp_die();
}

// Add class to billing input fields
add_filter('woocommerce_billing_fields', 'custom_billing_fields_class');
function custom_billing_fields_class($fields)
{
    foreach ($fields as $key => &$field) {
        $field['input_class'][] = 'form-control';
    }
    return $fields;
}

// Add class to shipping input fields
add_filter('woocommerce_shipping_fields', 'custom_shipping_fields_class');
function custom_shipping_fields_class($fields)
{
    foreach ($fields as $key => &$field) {
        $field['input_class'][] = 'form-control';
    }
    return $fields;
}

// Add meta box
add_action('add_meta_boxes', function () {
    add_meta_box(
        'hover_image_box',
        __('Hover Image', 'woocommerce'),
        'render_hover_image_box',
        'product',
        'side',
        'low'
    );
});

// Add Hover Image meta box under Product Image
add_action('add_meta_boxes', function () {
    add_meta_box(
        'hover_image_box',
        __('Hover Image', 'woocommerce'),
        'render_hover_image_box',
        'product',
        'side',
        'low'
    );
});

// Add Hover Image meta box under Product Image
add_action('add_meta_boxes', function () {
    add_meta_box(
        'hover_image_box',
        __('Hover Image', 'woocommerce'),
        'render_hover_image_box',
        'product',
        'side',
        'low'
    );
});

// Render Hover Image box (same as Featured Image UI)
function render_hover_image_box($post) {
    $hover_image_id = get_post_meta($post->ID, '_hover_image_id', true);
    $image = $hover_image_id ? wp_get_attachment_image_src($hover_image_id, 'thumbnail')[0] : '';

    ?>
    <div id="hover_image_container" style="margin-bottom: -10px;">
        <input type="hidden" id="hover_image_id" name="hover_image_id" value="<?php echo esc_attr($hover_image_id); ?>" />

        <div id="hover_image_preview" style="cursor:pointer;">
            <?php if ($image): ?>
                <img src="<?php echo esc_url($image); ?>" style="max-width:100%; height:auto;" />
                <p class="hover-instruction" style="font-size:12px; color:#666; margin-top:10px;">
                    <?php _e('Click the image to edit or update', 'woocommerce'); ?>
                </p>
            <?php else: ?>
                <a href="javascript:void(0)"><?php _e('Click to set hover image', 'woocommerce'); ?></a>
            <?php endif; ?>
        </div>

        <p style="margin-top:8px;">
            <a href="javascript:void(0)" class="remove-hover-image" style="color:#a00;<?php echo $hover_image_id ? '' : 'display:none;'; ?>">
                <?php _e('Remove Hover Image', 'woocommerce'); ?>
            </a>
        </p>
    </div>

    <script>
        jQuery(document).ready(function($){
            var frame;

            // Click on image area to upload/change
            $('#hover_image_preview').on('click', function(e){
                e.preventDefault();
                if(frame){ frame.open(); return; }
                frame = wp.media({
                    title: '<?php _e("Select or Upload Hover Image", "woocommerce"); ?>',
                    button: { text: '<?php _e("Use this image", "woocommerce"); ?>' },
                    multiple: false
                });
                frame.on('select', function(){
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#hover_image_id').val(attachment.id);
                    $('#hover_image_preview').html(
                        '<img src="'+attachment.url+'" style="max-width:100%; height:auto;" />' +
                        '<p class="hover-instruction" style="font-size:12px; color:#666; margin-top:6px;">' +
                        '<?php _e("Click the image to edit or update", "woocommerce"); ?>' +
                        '</p>'
                    );
                    $('.remove-hover-image').show();
                });
                frame.open();
            });

            // Remove hover image
            $('.remove-hover-image').on('click', function(e){
                e.preventDefault();
                $('#hover_image_id').val('');
                $('#hover_image_preview').html('<a href="javascript:void(0)"><?php _e("Click to set hover image", "woocommerce"); ?></a>');
                $(this).hide();
            });
        });
    </script>
    <?php
}

// Save Hover Image
add_action('save_post_product', function ($post_id) {
    if (isset($_POST['hover_image_id'])) {
        update_post_meta($post_id, '_hover_image_id', absint($_POST['hover_image_id']));
    }
});

add_action('wp_ajax_custom_add_to_cart', 'custom_add_to_cart');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart');

function custom_add_to_cart()
{
    if (empty($_POST['product_id'])) {
        wp_send_json_error(['message' => 'Product ID missing']);
    }

    $product_id   = absint($_POST['product_id']);
    $quantity     = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
    $buy_now      = !empty($_POST['buy_now']);
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $variations   = [];

    $product = wc_get_product($product_id);
    if (!$product) wp_send_json_error(['message' => 'Invalid product']);

    // Handle variable product
    if ($product->is_type('variable')) {
        $available_attributes = $product->get_attributes();
        foreach ($available_attributes as $name => $options) {
            $key = 'attribute_' . sanitize_title($name);
            if (isset($_POST[$key]) && $_POST[$key] !== '') {
                $variations[$name] = wc_clean($_POST[$key]);
            } else {
                wp_send_json_error(['message' => 'Please select all product options']);
            }
        }
        if (!$variation_id) {
            wp_send_json_error(['message' => 'Please select a valid product variation']);
        }
        $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations);
    } else {
        $added = WC()->cart->add_to_cart($product_id, $quantity);
    }

    if (!$added) wp_send_json_error(['message' => 'Failed to add product to cart']);

    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();

    $response = [
        'message'   => 'Product added successfully',
        'fragments' => [
            '.widget_shopping_cart_content' => $mini_cart
        ]
    ];

    if ($buy_now) {
        $response['buy_now']  = true;
        $response['redirect'] = wc_get_checkout_url();
    }

    wp_send_json_success($response);
}
