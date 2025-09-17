<?php
defined('ABSPATH') || exit;

do_action('woocommerce_review_order_before_cart_contents');
?>

<div class="woocommerce-notices-wrapper"><?php wc_print_notices(); ?></div>

<table class="shop_table woocommerce-checkout-review-order-table" id="checkout-table">

    <thead>
        <tr>
            <th>Product</th>
            <th class="right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = $cart_item['data'];

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) : ?>
                <tr>
                    <td class="d-flex align-items-center product-box">
                        <button type="button" class="remove-checkout-item btn p-0 m-0 d-block" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button>
                        <div class="product-img"><?php echo $_product->get_image('woocommerce_thumbnail'); ?></div>
                        <div class="product-info w-100">
                            <h6><?php echo wp_kses_post($_product->get_name()); ?></h6>
                            <div class="quantity-wrapper w-100">
                                <div class="d-flex align-items-center w-100">
                                    <button type="button" class="quantity-minus btn">-</button>
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $min = 1;
                                        $max = 1;
                                    } else {
                                        $min = 0;
                                        $max = $_product->get_max_purchase_quantity();
                                    }
                                    echo woocommerce_quantity_input(array(
                                        'input_name'  => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item['quantity'],
                                        'max_value'   => $max,
                                        'min_value'   => $min,
                                    ), $_product, false);
                                    ?>
                                    <button type="button" class="quantity-plus btn">+</button>
                                </div>
                            </div>
                            <p class="mb-0 mt-2 product-mobile-price"><?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?></p>
                        </div>
                    </td>
                    <td class="product-d-price"><?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?></td>
                </tr>
        <?php endif;
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Subtotal</th>
            <td class="right"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
            <?php do_action('woocommerce_review_order_before_shipping'); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action('woocommerce_review_order_after_shipping'); ?>
        <?php endif; ?>
        <tr>
            <th>Total</th>
            <td class="total-amount right"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>
    </tfoot>
</table>
<input type="hidden" name="woocommerce-process-checkout-nonce" value="xyz">


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const removeProductsCheckout = () => {
            document.querySelectorAll('.remove-checkout-item').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();

                    const cartItemKey = btn.dataset.cartItemKey;
                    if (!cartItemKey) {
                        console.error('Missing cart item key');
                        return;
                    }

                    const table = document.querySelector('#checkout-table');
                    if (table) table.classList.add('loading');

                    const formData = new URLSearchParams();
                    formData.append('action', 'remove_checkout_item');
                    formData.append('cart_item_key', cartItemKey);
                    formData.append('nonce', my_ajax_object.remove_nonce);

                    fetch(my_ajax_object.ajax_url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success && data.data.fragments) {
                                for (const selector in data.data.fragments) {
                                    const el = document.querySelector(selector);
                                    if (el) el.innerHTML = data.data.fragments[selector];
                                }
                                document.body.dispatchEvent(new Event('update_checkout'));
                                setTimeout(() => {
                                    removeProductsCheckout();
                                    quantityCheckout();
                                }, 1000);
                            } else {
                                console.error(data);
                                alert(data.data || 'Error removing item.');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('AJAX error.');
                        })
                        .finally(() => {
                            if (table) table.classList.remove('loading');
                        });
                });
            });
        };
        const updateQty = (cartItemKey, qty) => {
            const table = document.querySelector('#checkout-table');
            if (table) table.classList.add('loading');

            const formData = new URLSearchParams();
            formData.append('action', 'update_checkout_item_qty');
            formData.append('cart_item_key', cartItemKey);
            formData.append('quantity', qty);
            formData.append('nonce', my_ajax_object.qty_nonce);

            fetch(my_ajax_object.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.data.fragments) {
                        for (const selector in data.data.fragments) {
                            const el = document.querySelector(selector);
                            if (el) el.innerHTML = data.data.fragments[selector];
                        }
                        document.body.dispatchEvent(new Event('update_checkout'));
                        setTimeout(() => {
                            quantityCheckout();
                        }, 1000);
                    } else {
                        console.error(data);
                        alert(data.data || 'Error updating quantity.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('AJAX error.');
                })
                .finally(() => {
                    if (table) table.classList.remove('loading');
                });
        };
        const quantityCheckout = () => {
            document.querySelectorAll('.quantity-wrapper').forEach(wrapper => {
                const minusBtn = wrapper.querySelector('.quantity-minus');
                const plusBtn = wrapper.querySelector('.quantity-plus');
                const input = wrapper.querySelector('input.qty');

                if (!input) return;

                const cartItemKey = input.name.match(/\[(.*?)\]/)[1];
                let debounceTimer;

                const triggerUpdate = (qty) => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        updateQty(cartItemKey, qty);
                    }, 1000);
                };

                minusBtn.addEventListener('click', () => {
                    let qty = parseInt(input.value) || 0;
                    if (qty > 1) {
                        input.value = qty - 1;
                        triggerUpdate(input.value);
                    }
                });

                plusBtn.addEventListener('click', () => {
                    let qty = parseInt(input.value) || 0;
                    input.value = qty + 1;
                    triggerUpdate(input.value);
                });

                input.addEventListener('change', () => {
                    let qty = parseInt(input.value) || 1;
                    if (qty < 1) qty = 1;
                    input.value = qty;
                    triggerUpdate(qty);
                });
            });

        };
        setTimeout(() => {
            removeProductsCheckout();
            quantityCheckout();
        }, 2000);
    });
</script>