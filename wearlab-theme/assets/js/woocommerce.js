document.addEventListener('DOMContentLoaded', function() {
    
    // Utilities
    const getAjaxUrl = () => (window.wearlab && window.wearlab.ajax_url) ? window.wearlab.ajax_url : '/wp-admin/admin-ajax.php';
    const getWcAjaxUrl = (endpoint) => {
        if (window.wc_add_to_cart_params && window.wc_add_to_cart_params.wc_ajax_url) {
            return window.wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', endpoint);
        }
        return `/?wc-ajax=${endpoint}`;
    };

    // 8. Toast Notification
    const showToast = (message, type = 'success') => {
        const toast = document.createElement('div');
        toast.className = `wl-toast wl-toast--${type}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Trigger reflow to animate
        void toast.offsetWidth;
        toast.classList.add('wl-toast--visible');
        
        setTimeout(() => {
            toast.classList.remove('wl-toast--visible');
            setTimeout(() => toast.remove(), 300); // Wait for transition
        }, 3000);
    };
    
    // Expose toast globally if needed elsewhere
    window.wlShowToast = showToast;

    // 1. Product Image Gallery
    const galleryThumbs = document.querySelectorAll('.wl-product-gallery__thumb');
    const galleryMain = document.querySelector('.wl-product-gallery__main img');
    
    if (galleryThumbs.length && galleryMain) {
        galleryThumbs.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all
                galleryThumbs.forEach(t => t.classList.remove('wl-product-gallery__thumb--active'));
                
                // Add active class to clicked
                this.classList.add('wl-product-gallery__thumb--active');
                
                // Update main image
                const newSrc = this.querySelector('img').getAttribute('src');
                const newFullSrc = this.getAttribute('data-full-image') || newSrc;
                
                galleryMain.setAttribute('src', newFullSrc);
                
                // If using srcset, might need to update or clear it
                if (galleryMain.hasAttribute('srcset')) {
                    galleryMain.setAttribute('srcset', '');
                }
            });
        });
    }

    // 2. Size Selector
    const sizeOptions = document.querySelectorAll('.wl-size-option');
    const variationInput = document.querySelector('input[name="variation_id"]');
    const attributeSizeInput = document.querySelector('input[name="attribute_pa_size"]') || document.querySelector('select[name="attribute_pa_size"]');
    
    if (sizeOptions.length) {
        sizeOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.classList.contains('disabled')) return;
                
                // Update visual selection
                sizeOptions.forEach(opt => opt.classList.remove('wl-size-option--selected'));
                this.classList.add('wl-size-option--selected');
                
                const value = this.getAttribute('data-value');
                
                // If this is a variable product form
                if (attributeSizeInput) {
                    attributeSizeInput.value = value;
                    attributeSizeInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });
    }

    // Archive page AJAX add to cart toast notification
    document.querySelectorAll('.ajax_add_to_cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // standard wooCommerce handles this, but we can hook into it to show toast
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class') {
                        if (btn.classList.contains('added')) {
                            showToast('Added to cart successfully!');
                            observer.disconnect();
                        }
                    }
                });
            });
            observer.observe(btn, { attributes: true });
        });
    });

    // 5. Product Card Hover (Mobile touch support)
    const productCards = document.querySelectorAll('.wl-product-card');
    if (productCards.length) {
        productCards.forEach(card => {
            card.addEventListener('touchstart', function() {
                // Remove from others
                productCards.forEach(c => {
                    if (c !== this) c.classList.remove('wl-product-card--hover');
                });
                this.classList.toggle('wl-product-card--hover');
            }, { passive: true });
        });
    }

    // 6. Cart Page Quantity Update
    const cartForms = document.querySelectorAll('form.woocommerce-cart-form');
    if (cartForms.length) {
        cartForms.forEach(form => {
            form.addEventListener('change', function(e) {
                if (e.target.classList.contains('wl-cart-qty') || e.target.classList.contains('qty')) {
                    const updateBtn = form.querySelector('[name="update_cart"]');
                    if (updateBtn) {
                        updateBtn.disabled = false;
                        updateBtn.click(); // Auto-update cart on qty change
                    }
                }
            });
        });
    }

    // 7. Remove Cart Item (Handled mostly by WooCommerce standard fragments, but added animation hook)
    document.body.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.wl-cart-remove') || e.target.closest('.remove');
        if (removeBtn && removeBtn.closest('tr')) {
            const row = removeBtn.closest('tr');
            row.style.opacity = '0.5';
            row.style.pointerEvents = 'none';
        }
    });

    // 9. Product Tabs
    const tabHeaders = document.querySelectorAll('.wl-product-tab__header');
    if (tabHeaders.length) {
        tabHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                if (!targetId) return;

                const wrapper = this.closest('.wl-product-tabs');
                if (!wrapper) return;

                // Remove active classes
                wrapper.querySelectorAll('.wl-product-tab__header').forEach(h => h.classList.remove('wl-product-tab__header--active'));
                wrapper.querySelectorAll('.wl-product-tab__content').forEach(c => c.style.display = 'none');

                // Add active class and show content
                this.classList.add('wl-product-tab__header--active');
                const content = wrapper.querySelector(targetId);
                if (content) {
                    content.style.display = 'block';
                }
            });
        });
    }

    // 10. Shop Filters (Mobile)
    const filterToggle = document.querySelector('.wl-shop-filters-toggle');
    const shopSidebar = document.querySelector('.wl-shop-sidebar');
    const filterClose = document.querySelector('.wl-shop-sidebar__close');

    if (filterToggle && shopSidebar) {
        const toggleFilters = (force) => {
            const isOpen = typeof force === 'boolean' ? force : !shopSidebar.classList.contains('wl-shop-sidebar--open');
            if (isOpen) {
                shopSidebar.classList.add('wl-shop-sidebar--open');
                document.body.classList.add('wl-filters-open');
            } else {
                shopSidebar.classList.remove('wl-shop-sidebar--open');
                document.body.classList.remove('wl-filters-open');
            }
        };

        filterToggle.addEventListener('click', () => toggleFilters(true));
        if (filterClose) {
            filterClose.addEventListener('click', () => toggleFilters(false));
        }

        // Close on clicking outside
        document.addEventListener('click', (e) => {
            if (shopSidebar.classList.contains('wl-shop-sidebar--open') && 
                !shopSidebar.contains(e.target) && 
                !filterToggle.contains(e.target)) {
                toggleFilters(false);
            }
        });
    }

    // 11. Price Range Filter
    const priceRangeSlider = document.querySelector('.wl-price-range');
    if (priceRangeSlider) {
        const minInput = priceRangeSlider.querySelector('.wl-price-range__min');
        const maxInput = priceRangeSlider.querySelector('.wl-price-range__max');
        const minOutput = priceRangeSlider.querySelector('.wl-price-range__output-min');
        const maxOutput = priceRangeSlider.querySelector('.wl-price-range__output-max');
        
        if (minInput && maxInput) {
            const updateVisuals = () => {
                let minVal = parseInt(minInput.value);
                let maxVal = parseInt(maxInput.value);
                
                if (minVal > maxVal) {
                    let tmp = minVal;
                    minVal = maxVal;
                    maxVal = tmp;
                }
                
                if (minOutput) minOutput.textContent = `PKR ${minVal}`;
                if (maxOutput) maxOutput.textContent = `PKR ${maxVal}`;
                
                // Update hidden inputs for WooCommerce if they exist
                const wcMinPrice = document.querySelector('#min_price');
                const wcMaxPrice = document.querySelector('#max_price');
                if (wcMinPrice) wcMinPrice.value = minVal;
                if (wcMaxPrice) wcMaxPrice.value = maxVal;
            };
            
            minInput.addEventListener('input', updateVisuals);
            maxInput.addEventListener('input', updateVisuals);
            
            // Auto submit on change
            const form = priceRangeSlider.closest('form');
            if (form) {
                minInput.addEventListener('change', () => form.submit());
                maxInput.addEventListener('change', () => form.submit());
            }
        }
    }
});
