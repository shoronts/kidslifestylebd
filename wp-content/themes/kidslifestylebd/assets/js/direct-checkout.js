jQuery(function ($) {

    function checkShipping() { };

    function initCheckoutEvents(container) {

        // Shipping / totals updates
        $(container).find('input.shipping_method').on('change', function () {
            const selectedMethod = $(this).val();
            const form = $(container).find('form.checkout');
            const formData = form.serializeArray();

            formData.push({ name: 'action', value: 'direct_checkout_load' });
            formData.push({ name: '_nonce', value: DirectCheckout.nonce });
            formData.push({ name: 'shipping_method[]', value: selectedMethod });

            $.ajax({
                url: DirectCheckout.ajax_url,
                type: 'POST',
                data: formData,
                success: function (res) {
                    if (res.success) {
                        $(container).html(res.data);
                        initCheckoutEvents(container); // rebind handlers for refreshed checkout
                    } else {
                        console.error('Shipping update failed:', res.data);
                    }
                },
                error: function (xhr) {
                    console.error('AJAX error:', xhr.responseText);
                }
            });
        });

        // Checkout submit
        $(container).find('form.checkout').off('submit').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const formData = form.serialize();

            $.post(DirectCheckout.ajax_url, {
                action: 'direct_checkout_submit',
                _nonce: DirectCheckout.nonce,
                form: formData
            }, function (res) {
                if (res.success && res.data.redirect) {
                    window.location.href = res.data.redirect;
                } else {
                    form.find('.woocommerce-error, .woocommerce-message').remove();
                    form.prepend('<div class="woocommerce-error">' + (res.data?.message || 'Checkout failed.') + '</div>');
                }
            });
        });
    }

    function loadCheckout(product_id, variation_id = 0, attributes = {}) {
        $.post(DirectCheckout.ajax_url, {
            action: 'direct_checkout_load',
            _nonce: DirectCheckout.nonce,
            product_id,
            variation_id,
            attributes: JSON.stringify(attributes)
        }, function (res) {
            if (res.success) {
                $('#checkout-container').html(res.data);
                initCheckoutEvents($('#checkout-container'));
            } else {
                $('#checkout-container').html('<p>Error: ' + res.data + '</p>');
            }
        });
    }

    // Initial load
    const wrapper = $('.direct-checkout-wrapper');
    if (wrapper.length) {
        const product_id = wrapper.data('product-id');
        const variation_input = wrapper.find('input[name="variation_id"]:checked');
        const variation_id = variation_input.val() || 0;
        const attributes = variation_input.data('attributes') || {};
        loadCheckout(product_id, variation_id, attributes);
    }

    // Reload checkout on variation change
    $('body').on('change', 'input[name="variation_id"]', function () {
        const product_id = $(this).closest('.direct-checkout-wrapper').data('product-id');
        const variation_id = $(this).val();
        const attributes = $(this).data('attributes') || {};
        loadCheckout(product_id, variation_id, attributes);
    });
});
