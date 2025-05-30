document.addEventListener("DOMContentLoaded", function () {
    const cartButton = document.getElementById("cart-button");
    const cartDropdown = document.getElementById("cart-dropdown");
    loadCartItems();
    // Toggle cart on button click
    cartButton.addEventListener("click", function (event) {
        event.stopPropagation();
        jQuery('#cart-dropdown').addClass('is-active');
        jQuery('body').addClass('is-blur-bg');
        //loadCartItems();
    });


    jQuery('.header-cart-close').on('click',function(){
        jQuery('#cart-dropdown').removeClass('is-active');
        jQuery('body').removeClass('is-blur-bg');
    })

    // Close cart when clicking outside
    document.addEventListener("click", function (event) {
        if (!cartDropdown.contains(event.target) && event.target !== cartButton) {
            jQuery('#cart-dropdown').removeClass('is-active');
            jQuery('body').removeClass('is-blur-bg');
        }
    });
    

    // Load cart items
    function loadCartItems() {
        // console.log('floating cart fun');
        fetch(ajax_object.ajax_url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ action: "fetch_cart_items" }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // console.log('floating cart success');
                // console.log(data.data.cart_html);
                // document.getElementById("cart-items").innerHTML = data.data.cart_html;
                jQuery('#cart-items').html(data.data.cart_html);
    
                // Update the cart count
                document.querySelectorAll(".cart-count").forEach(el => {
                    el.textContent = data.data.cart_count;
                    el.style.display = data.data.cart_count > 0 ? 'inline-block' : 'none';
                });

                attachRemoveEvent();

            } else {
                console.error("Failed to load cart:", data);
            }
        })
        .catch(err => {
            console.error("Error loading cart items:", err);
        });
    }

    function attachRemoveEvent() {
        document.querySelectorAll(".remove-item").forEach(button => {
            button.addEventListener("click", function () {
                const cartKey = this.dataset.cartKey;
                const icon = this.querySelector(".remove-icon");
                const loader = this.querySelector(".woo-loading");
    
                icon.classList.add("hidden");
                loader.classList.remove("hidden");
    
                fetch(ajax_object.ajax_url, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ action: "remove_cart_item", cart_key: cartKey }),
                })
                .then(() => loadCartItems()); 
            });
        });
    }
        
    $(document.body).on('updated_checkout', function() {
        const message = $('.woocommerce-message:contains("Coupon code")').text();
        const errormessage = $('.coupon-error-notice').last().text();
        
        if (message && message.includes("Coupon code")) {
            const labelText = $('.custom-coupon-label').text().trim(); // "Coupon: test"
            const code = labelText.replace('Coupon:', '').trim();
            const popup = $('<div class="custom-coupon-popup">' + message + '</div>');
            $('body').append(popup);
            popup.fadeIn();
            $('#toggle-coupon').text(code + ' - Coupon Added!');
            setTimeout(() => {
                popup.fadeOut(() => popup.remove());
            }, 2000);
        }
    
        if($('.coupon-error-notice').length && $('.custom-coupon-label').length){
          $('.custom-coupon-popup').html('');
          const popup = $('<div class="custom-coupon-popup">' + errormessage + '</div>');
          $('body').append(popup);
          $('.coupon-error-notice').hide();
          popup.fadeIn();
          setTimeout(() => {
              popup.fadeOut(() => popup.remove());
          }, 2000);
        }
    });

    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        // fetchCartData();
        loadCartItems();
    });
});


function fetchCartData() {
    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'fetch_cart_items',
        },
        success: function(response) {
            if (response.success) {
                $('#cart-items').html(response.data.cart_html);
                document.querySelectorAll(".cart-count").forEach(el => {
                    el.textContent = response.data.cart_count;
                    el.style.display = response.data.cart_count > 0 ? 'inline-block' : 'none';
                });
            }
        }
    });
}

