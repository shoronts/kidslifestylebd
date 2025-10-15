<?php

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); 
?>

<style>
/* Your existing custom styles */
.single_variation_wrap {
    display: flex;
    flex-direction: column;
}

.woocommerce-variation.single_variation {
    order: 1;
}

.variation-wrapper {
    order: 2;
}

.woocommerce-variation-add-to-cart {
    order: 3;
}
</style>

<form class="variations_form cart get-product mt-2" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
        <table class="variations d-none" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <tr>
                        <th class="label"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); ?></label></th>
                        <td class="value">
                            <?php
                            wc_dropdown_variation_attribute_options(array(
                                'options'   => $options,
                                'attribute' => $attribute_name,
                                'product'   => $product,
                            ));
                            echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#" aria-label="' . esc_attr__('Clear options', 'woocommerce') . '">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class="single_variation_wrap">
            <?php
            do_action('woocommerce_before_single_variation');
            do_action('woocommerce_single_variation');
            do_action('woocommerce_after_single_variation');
            ?>

            <?php foreach ($attributes as $attribute_name => $options) : ?>
                <div class="variation-wrapper mb-3">
                    <?php
                    foreach ($options as $option) :
                        $selected_value = isset($_REQUEST['attribute_' . sanitize_title($attribute_name)]) ? wc_clean(wp_unslash($_REQUEST['attribute_' . sanitize_title($attribute_name)])) : $product->get_variation_default_attribute($attribute_name);
                        $is_selected = ($option === $selected_value) ? 'selected' : '';
                    ?>
                        <button type="button"
                            class="variation-button <?php echo esc_attr($is_selected); ?>"
                            data-attribute-name="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"
                            data-value="<?php echo esc_attr($option); ?>">
                            <?php echo esc_html(apply_filters('woocommerce_variation_option_name', $option, $attribute_name, $product)); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const allWrappers = document.querySelectorAll(".variation-wrapper");

    allWrappers.forEach(wrapper => {
        const buttons = wrapper.querySelectorAll("button.variation-button");

        buttons.forEach(button => {
            button.addEventListener("click", e => {
                e.preventDefault();
                e.stopPropagation();

                // Keep class name consistent with server-side default ('selected')
                wrapper.querySelectorAll('button').forEach(b => { b.classList.remove('active'); b.classList.remove('selected'); });
                button.classList.add('active');

                const attrName = button.dataset.attributeName;
                const attrValue = button.dataset.value;

                const select = document.querySelector(`select[name="attribute_${attrName}"]`);
                if (select) {
                    select.value = attrValue;
                    // Dispatch both a native event and a jQuery event to ensure WooCommerce handlers pick it up
                    try {
                        select.dispatchEvent(new Event('change', { bubbles: true }));
                    } catch (e) {
                        // older browsers fallback
                        var evt = document.createEvent('HTMLEvents');
                        evt.initEvent('change', true, false);
                        select.dispatchEvent(evt);
                    }
                    if (window.jQuery) {
                        jQuery(select).trigger('change');
                    }
                }
            });
        });

        if (buttons.length > 0) buttons[0].click();
    });
});
</script>
