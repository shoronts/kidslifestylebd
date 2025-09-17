jQuery(document).ready(function ($) {
    function sendWishlistRequest(action, productId, button) {
        if (action === 'add_to_wishlist') {
            button.find('.default').addClass('d-none');
            button.find('.loading').removeClass('d-none');
            button.find('.complete').addClass('d-none');
        }

        $.ajax({
            url: wishlist_ajax.ajax_url,
            type: 'POST',
            data: {
                action: action,
                nonce: wishlist_ajax.nonce,
                product_id: productId
            },
            success: function (response) {
                if (response.success) {
                    if (action === 'add_to_wishlist') {
                        button.find('.loading').addClass('d-none');
                        button.find('.complete').removeClass('d-none');
                    } else {
                        $('#product-num-' + productId).remove();
                        button.siblings('.add-to-wishlist-btn').show();
                    }
                    if (response.data.redirect_to_wishlist) {
                        window.location.href = response.data.redirect_url;
                        return;
                    }
                } else {
                    if (action === 'add_to_wishlist') {
                        button.find('.loading').addClass('d-none');
                        button.find('.default').removeClass('d-none');
                    }
                    alert(response.data.message);
                }
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    }

    $('.add-to-wishlist-btn').on('click', function () {
        const productId = $(this).data('product-id');
        sendWishlistRequest('add_to_wishlist', productId, $(this));
    });

    $('.remove-from-wishlist-btn').on('click', function () {
        const productId = $(this).data('product-id');
        sendWishlistRequest('remove_from_wishlist', productId, $(this));
    });
});
