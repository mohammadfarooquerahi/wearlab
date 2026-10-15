document.addEventListener('DOMContentLoaded', function() {
    // Utilities
    const getAjaxUrl = () => (window.wearlab_ajax && window.wearlab_ajax.url) ? window.wearlab_ajax.url : ((window.wearlab && window.wearlab.ajax_url) ? window.wearlab.ajax_url : '/wp-admin/admin-ajax.php');

    // 1. Sticky Header
    const header = document.querySelector('.wl-header');
    if (header) {
        let lastScrollY = window.scrollY;
        let ticking = false;

        const updateHeader = () => {
            if (window.scrollY > 100) {
                header.classList.add('wl-header--scrolled');
            } else {
                header.classList.remove('wl-header--scrolled');
            }
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            lastScrollY = window.scrollY;
            if (!ticking) {
                window.requestAnimationFrame(updateHeader);
                ticking = true;
            }
        });
    }

    // 2. Mobile Menu Toggle & Accordions
    const mobileToggle = document.querySelector('.wl-mobile-toggle');
    const mobileMenu = document.querySelector('.wl-mobile-menu');
    const mobileClose = document.querySelector('.wl-mobile-menu__close');
    const mobileBackdrop = document.querySelector('.wl-mobile-menu-backdrop');

    if (mobileToggle && mobileMenu) {
        const toggleMenu = (force) => {
            const isOpen = typeof force === 'boolean' ? force : !mobileMenu.classList.contains('wl-mobile-menu--open');
            if (isOpen) {
                mobileMenu.classList.add('wl-mobile-menu--open');
                document.body.classList.add('wl-menu-open');
                if (mobileBackdrop) mobileBackdrop.classList.add('is-active');
            } else {
                mobileMenu.classList.remove('wl-mobile-menu--open');
                document.body.classList.remove('wl-menu-open');
                if (mobileBackdrop) mobileBackdrop.classList.remove('is-active');
            }
        };

        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });
        if (mobileClose) {
            mobileClose.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMenu(false);
            });
        }
        if (mobileBackdrop) {
            mobileBackdrop.addEventListener('click', () => toggleMenu(false));
        }

        document.addEventListener('click', (e) => {
            if (mobileMenu.classList.contains('wl-mobile-menu--open') && 
                !mobileMenu.contains(e.target) && 
                !mobileToggle.contains(e.target)) {
                toggleMenu(false);
            }
        });

        // Mobile drawer accordion toggles for subcategories
        mobileMenu.querySelectorAll('.wl-mobile-nav__toggle').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const item = btn.closest('.wl-mobile-nav__item');
                if (item) {
                    item.classList.toggle('is-open');
                }
            });
        });
    }

    // 3. Search Overlay
    const searchTriggers = document.querySelectorAll('.wl-search-trigger');
    const searchOverlay = document.querySelector('.wl-search-overlay');
    
    if (searchTriggers.length && searchOverlay) {
        const searchInput = searchOverlay.querySelector('input[type="search"]');
        const searchClose = searchOverlay.querySelector('.wl-search-overlay__close');

        const openSearch = (e) => {
            if (e) e.preventDefault();
            searchOverlay.classList.add('wl-search-overlay--open');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 100);
            }
        };

        const closeSearch = () => {
            searchOverlay.classList.remove('wl-search-overlay--open');
        };

        searchTriggers.forEach(t => t.addEventListener('click', openSearch));
        if (searchClose) searchClose.addEventListener('click', closeSearch);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchOverlay.classList.contains('wl-search-overlay--open')) {
                closeSearch();
            }
        });
    }

    // 4. Announcement Bar Marquee
    const announcementTrack = document.querySelector('.wl-announcement__track');
    if (announcementTrack) {
        const content = announcementTrack.innerHTML;
        announcementTrack.innerHTML = content + content; 
        // Note: Actual animation should be handled by CSS keyframes on .wl-announcement__track
    }

    // 5. FAQ Accordion
    const faqItems = document.querySelectorAll('.wl-faq__item');
    if (faqItems.length) {
        faqItems.forEach(item => {
            const question = item.querySelector('.wl-faq__question');
            const answer = item.querySelector('.wl-faq__answer');
            
            if (question && answer) {
                question.addEventListener('click', () => {
                    const isOpen = item.classList.contains('wl-faq__item--open');
                    
                    // Close others
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('wl-faq__item--open');
                            const otherAnswer = otherItem.querySelector('.wl-faq__answer');
                            if (otherAnswer) otherAnswer.style.maxHeight = null;
                        }
                    });

                    // Toggle current
                    if (isOpen) {
                        item.classList.remove('wl-faq__item--open');
                        answer.style.maxHeight = null;
                    } else {
                        item.classList.add('wl-faq__item--open');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    }
                });
            }
        });
    }

    // 6. Smooth Scroll
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const headerOffset = 70;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
  
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 7. Scroll Animations
    const animatedElements = document.querySelectorAll('.wl-animate');
    if (animatedElements.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('wl-animate--visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach(el => observer.observe(el));
    }

    // 8. Newsletter Form (homepage + footer)
    const newsletterForms = document.querySelectorAll('.wl-newsletter__form, .wl-newsletter-form, .wl-footer__subscribe-form');
    newsletterForms.forEach(function(newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            const messageEl = this.querySelector('.wl-newsletter__message') || document.createElement('div');

            if (!this.querySelector('.wl-newsletter__message')) {
                messageEl.className = 'wl-newsletter__message';
                this.appendChild(messageEl);
            }

            if (!emailInput || !emailInput.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                messageEl.textContent = 'Please enter a valid email address.';
                messageEl.className = 'wl-newsletter__message wl-error';
                return;
            }

            const formData = new FormData(this);
            formData.append('action', 'wearlab_newsletter');
            if (typeof wearlab_ajax !== 'undefined' && wearlab_ajax.nonce) {
                formData.append('nonce', wearlab_ajax.nonce);
            }
            if (!formData.get('email') && emailInput.value) {
                formData.append('email', emailInput.value);
            }

            fetch(getAjaxUrl(), {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageEl.textContent = data.data.message || 'Successfully subscribed!';
                    messageEl.className = 'wl-newsletter__message wl-success';
                    this.reset();
                } else {
                    messageEl.textContent = data.data.message || 'An error occurred.';
                    messageEl.className = 'wl-newsletter__message wl-error';
                }
            })
            .catch(() => {
                messageEl.textContent = 'Server error. Please try again later.';
                messageEl.className = 'wl-newsletter__message wl-error';
            });
        });
    });

    // 9. Contact Form
    const contactForm = document.querySelector('.wl-contact__form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'wearlab_contact');
            
            const messageEl = this.querySelector('.wl-contact__message') || document.createElement('div');
            if (!this.querySelector('.wl-contact__message')) {
                messageEl.className = 'wl-contact__message';
                this.appendChild(messageEl);
            }

            let isValid = true;
            this.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) isValid = false;
            });

            if (!isValid) {
                messageEl.textContent = 'Please fill out all required fields.';
                messageEl.className = 'wl-contact__message wl-error';
                return;
            }

            fetch(getAjaxUrl(), {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageEl.textContent = data.data.message || 'Message sent successfully.';
                    messageEl.className = 'wl-contact__message wl-success';
                    this.reset();
                } else {
                    messageEl.textContent = data.data.message || 'Error sending message.';
                    messageEl.className = 'wl-contact__message wl-error';
                }
            }).catch(() => {
                messageEl.textContent = 'Server error. Please try again later.';
                messageEl.className = 'wl-contact__message wl-error';
            });
        });
    }

    // 10. Customization Form
    const customizationForm = document.querySelector('.wl-customization__form');
    if (customizationForm) {
        customizationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'wearlab_customization');
            
            const messageEl = this.querySelector('.wl-customization__message') || document.createElement('div');
            if (!this.querySelector('.wl-customization__message')) {
                messageEl.className = 'wl-customization__message';
                this.appendChild(messageEl);
            }

            fetch(getAjaxUrl(), {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageEl.textContent = data.data.message || 'Request submitted.';
                    messageEl.className = 'wl-customization__message wl-success';
                    this.reset();
                } else {
                    messageEl.textContent = data.data.message || 'Error submitting request.';
                    messageEl.className = 'wl-customization__message wl-error';
                }
            }).catch(() => {
                messageEl.textContent = 'Server error. Please try again later.';
                messageEl.className = 'wl-customization__message wl-error';
            });
        });
    }

    // 11. Quantity Controls
    document.addEventListener('click', function(e) {
        if (e.target.closest('.wl-qty-minus') || e.target.closest('.wl-qty-plus')) {
            const btn = e.target.closest('button') || e.target;
            const isPlus = btn.classList.contains('wl-qty-plus');
            const wrapper = btn.closest('.wl-qty-wrapper') || btn.parentElement;
            const input = wrapper.querySelector('.wl-qty-input');
            
            if (input) {
                e.preventDefault();
                let val = parseInt(input.value) || 1;
                if (isPlus) {
                    if (val < 99) val++;
                } else {
                    if (val > 1) val--;
                }
                input.value = val;
                // Trigger change event for wooCommerce handlers if necessary
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
    });

    // 13. PDP Interactive Handlers (Swatches, Quantity, Accordions, Size Guide, Share)
    const updateSelectedVariation = () => {
        const form = document.querySelector('.wl-pdp__form');
        if (!form) return;
        const varScript = form.querySelector('.wl-pdp-variations');
        const varInput = form.querySelector('input[name="variation_id"]');
        if (!varScript || !varInput) return;

        try {
            const variations = JSON.parse(varScript.textContent || '[]');
            if (!Array.isArray(variations) || !variations.length) return;

            const selectedAttrs = {};
            form.querySelectorAll('.wl-pdp-attr-input').forEach(input => {
                if (input.name) {
                    selectedAttrs[input.name] = input.value.toLowerCase().trim();
                }
            });

            const match = variations.find(v => {
                if (!v.attributes) return false;
                for (const [attrKey, attrVal] of Object.entries(v.attributes)) {
                    if (attrVal === '' || attrVal === null) continue;
                    const selected = selectedAttrs[attrKey];
                    if (selected && selected !== attrVal.toLowerCase().trim()) {
                        return false;
                    }
                }
                return true;
            });

            if (match && match.variation_id) {
                varInput.value = match.variation_id;
            } else if (variations[0] && variations[0].variation_id) {
                varInput.value = variations[0].variation_id;
            }
        } catch(err) {
            console.error('Error parsing variations:', err);
        }
    };

    // Initialize variation on load
    updateSelectedVariation();

    // Swatches (Size & Colour)
    document.querySelectorAll('.wl-pdp-swatches').forEach(group => {
        group.addEventListener('click', (e) => {
            const btn = e.target.closest('.wl-pdp-swatch');
            if (!btn || btn.classList.contains('is-disabled')) return;
            group.querySelectorAll('.wl-pdp-swatch').forEach(b => b.classList.remove('is-selected'));
            btn.classList.add('is-selected');

            const val = btn.getAttribute('data-value');
            const field = group.closest('.wl-pdp-field');
            if (field) {
                const hiddenInput = field.querySelector('.wl-pdp-attr-input');
                if (hiddenInput) {
                    hiddenInput.value = val;
                    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
            updateSelectedVariation();
        });
    });

    // PDP Quantity Buttons
    document.querySelectorAll('.wl-pdp-qty').forEach(wrap => {
        const input = wrap.querySelector('.wl-pdp-qty__input');
        if (!input) return;

        wrap.querySelectorAll('.wl-pdp-qty__btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const delta = parseInt(btn.getAttribute('data-qty'), 10) || 0;
                let cur = parseInt(input.value, 10) || 1;
                cur = Math.max(1, Math.min(99, cur + delta));
                input.value = cur;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
    });

    // PDP Gallery Slider (KhushPosh-style slide view + touch swipe + counter + thumbnails)
    const pdpGallery = document.querySelector('[data-pdp-gallery]');
    if (pdpGallery) {
        const slides = pdpGallery.querySelectorAll('.wl-pdp__shot');
        const total = slides.length;
        const currentEl = document.querySelector('[data-gallery-current]');
        const prevBtn = document.querySelector('[data-gallery-prev]');
        const nextBtn = document.querySelector('[data-gallery-next]');
        const thumbs = document.querySelectorAll('[data-thumb-index]');

        let currentIndex = 0;

        const updateActiveState = (idx) => {
            currentIndex = Math.max(0, Math.min(total - 1, idx));
            if (currentEl) {
                currentEl.textContent = (currentIndex + 1);
            }
            thumbs.forEach((th, i) => {
                th.classList.toggle('is-active', i === currentIndex);
            });
        };

        const scrollToSlide = (idx) => {
            if (idx < 0) idx = total - 1;
            if (idx >= total) idx = 0;
            const targetSlide = slides[idx];
            if (targetSlide) {
                pdpGallery.scrollTo({
                    left: targetSlide.offsetLeft,
                    behavior: 'smooth'
                });
                updateActiveState(idx);
            }
        };

        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                scrollToSlide(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                scrollToSlide(currentIndex + 1);
            });
        }

        thumbs.forEach(th => {
            th.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const idx = parseInt(th.getAttribute('data-thumb-index'), 10) || 0;
                scrollToSlide(idx);
            });
        });

        // Listen to scroll to update counter on touch swipe
        let scrollTimeout;
        pdpGallery.addEventListener('scroll', () => {
            window.clearTimeout(scrollTimeout);
            scrollTimeout = window.setTimeout(() => {
                const scrollLeft = pdpGallery.scrollLeft;
                const width = pdpGallery.clientWidth || 1;
                const calculatedIndex = Math.round(scrollLeft / width);
                updateActiveState(calculatedIndex);
            }, 40);
        }, { passive: true });
    }

    // PDP Accordions (Description, Details, Take Care of Me)
    document.querySelectorAll('.wl-pdp-acc__item').forEach(item => {
        const btn = item.querySelector('.wl-pdp-acc__btn');
        if (btn) {
            btn.addEventListener('click', () => {
                const isOpen = item.classList.contains('is-open');
                item.classList.toggle('is-open', !isOpen);
            });
        }
    });

    // Size Guide Modal
    const sizeGuideModal = document.querySelector('.wl-size-guide');
    if (sizeGuideModal) {
        document.querySelectorAll('[data-open-size-guide]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                sizeGuideModal.removeAttribute('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        const closeSizeGuide = () => {
            sizeGuideModal.setAttribute('hidden', '');
            document.body.style.overflow = '';
        };

        sizeGuideModal.querySelectorAll('[data-close-size-guide]').forEach(el => {
            el.addEventListener('click', closeSizeGuide);
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sizeGuideModal.hasAttribute('hidden')) {
                closeSizeGuide();
            }
        });
    }

    // Share Button (Native Web Share API with clipboard fallback)
    const shareBtn = document.querySelector('[data-share]');
    if (shareBtn) {
        shareBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                }).catch(() => {});
            } else {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const originalText = shareBtn.innerHTML;
                    shareBtn.textContent = 'Link copied!';
                    setTimeout(() => {
                        shareBtn.innerHTML = originalText;
                    }, 2000);
                }).catch(() => {});
            }
        });
    }
    // 15. Shop Page — Filter Sidebar Toggle & Filter Accordion
    const shopSidebar = document.querySelector('.wl-shop-sidebar');
    const filterToggleBtn = document.querySelector('.wl-shop-filter-toggle');
    const filterBackdrop = document.querySelector('.wl-shop-filter-backdrop');

    const openFilterSidebar = () => {
        if (shopSidebar) {
            shopSidebar.classList.add('is-open');
            if (filterBackdrop) filterBackdrop.classList.add('is-visible');
            document.body.style.overflow = 'hidden';
        }
    };

    const closeFilterSidebar = () => {
        if (shopSidebar) {
            shopSidebar.classList.remove('is-open');
            if (filterBackdrop) filterBackdrop.classList.remove('is-visible');
            document.body.style.overflow = '';
        }
    };

    if (filterToggleBtn) {
        filterToggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openFilterSidebar();
        });
    }

    if (filterBackdrop) {
        filterBackdrop.addEventListener('click', closeFilterSidebar);
    }

    const mobileFilterClose = document.querySelector('.wl-shop-sidebar__mobile-close');
    if (mobileFilterClose) {
        mobileFilterClose.addEventListener('click', (e) => {
            e.preventDefault();
            closeFilterSidebar();
        });
    }

    // Filter widget accordion toggles
    document.querySelectorAll('.wl-filter-widget__header').forEach(header => {
        header.addEventListener('click', () => {
            const widget = header.closest('.wl-filter-widget');
            if (widget) {
                widget.classList.toggle('is-open');
            }
        });
    });

    // Auto-open all filter widgets on desktop
    if (window.innerWidth > 1024) {
        document.querySelectorAll('.wl-filter-widget').forEach(w => {
            w.classList.add('is-open');
        });
    }

    // 14. KhushPosh Cart Drawer Controller
    const cartDrawer = document.getElementById('wlCartDrawer');
    const openCartDrawer = () => {
        if (cartDrawer) {
            cartDrawer.classList.add('is-open');
            cartDrawer.setAttribute('aria-hidden', 'false');
            document.body.classList.add('wl-cart-drawer-open');
        }
    };

    const closeCartDrawer = () => {
        if (cartDrawer) {
            cartDrawer.classList.remove('is-open');
            cartDrawer.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('wl-cart-drawer-open');
        }
    };

    // Global hook for other scripts
    window.wlOpenCartDrawer = openCartDrawer;
    window.wlCloseCartDrawer = closeCartDrawer;

    // Header cart trigger
    const headerCartBtn = document.querySelector('.wl-header__cart');
    if (headerCartBtn) {
        headerCartBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openCartDrawer();
        });
    }

    // Close triggers
    document.querySelectorAll('[data-close-cart]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeCartDrawer();
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && cartDrawer && cartDrawer.classList.contains('is-open')) {
            closeCartDrawer();
        }
    });

    // Handle AJAX Add to Cart and Buy It Now from PDP
    const pdpForm = document.querySelector('.wl-pdp__form');
    if (pdpForm) {
        // Buy It Now button click
        const buyNowBtn = pdpForm.querySelector('.wl-buy-now');
        if (buyNowBtn) {
            buyNowBtn.addEventListener('click', function(e) {
                e.preventDefault();
                buyNowBtn.classList.add('is-loading');
                buyNowBtn.textContent = 'Processing...';

                updateSelectedVariation();

                const formData = new FormData(pdpForm);
                formData.append('action', 'wearlab_add_to_cart');
                formData.append('buy_now', '1');
                if (window.wearlab_ajax && window.wearlab_ajax.nonce) {
                    formData.append('nonce', window.wearlab_ajax.nonce);
                }

                fetch(getAjaxUrl(), {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    const destUrl = (data.data && data.data.checkout_url) ? data.data.checkout_url : '/checkout/';
                    window.location.href = destUrl;
                })
                .catch(() => {
                    // Fallback directly to checkout
                    window.location.href = '/checkout/';
                });
            });
        }

        // Add to Cart submit
        pdpForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const atcBtn = this.querySelector('.wl-pdp__atc');
            if (atcBtn) {
                atcBtn.classList.add('is-loading');
            }

            updateSelectedVariation();

            const formData = new FormData(pdpForm);
            formData.append('action', 'wearlab_add_to_cart');
            if (window.wearlab_ajax && window.wearlab_ajax.nonce) {
                formData.append('nonce', window.wearlab_ajax.nonce);
            }

            fetch(getAjaxUrl(), {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (atcBtn) atcBtn.classList.remove('is-loading');
                if (data.success) {
                    if (data.data && data.data.count !== undefined) {
                        const countEl = document.querySelector('.wl-cart-count');
                        if (countEl) countEl.textContent = data.data.count;
                    }
                    if (data.data && data.data.html) {
                        const drawerContent = document.getElementById('wlCartDrawerContent');
                        if (drawerContent) drawerContent.innerHTML = data.data.html;
                    }
                    openCartDrawer();
                } else {
                    openCartDrawer();
                }
            })
            .catch(() => {
                if (atcBtn) atcBtn.classList.remove('is-loading');
                openCartDrawer();
            });
        });
    }

    // Cart Drawer Qty Change & Item Removal (event delegation)
    const cartDrawerContent = document.getElementById('wlCartDrawerContent');
    
    const recalculateDemoTotals = () => {
        if (!cartDrawerContent) return;
        let totalSum = 0;
        let totalCount = 0;
        const items = cartDrawerContent.querySelectorAll('.wl-cart-drawer__item');
        
        items.forEach(item => {
            const qtyVal = parseInt(item.querySelector('.wl-cart-drawer__qty-val')?.textContent.trim(), 10) || 0;
            const unitPrice = parseFloat(item.querySelector('[data-unit-price]')?.getAttribute('data-unit-price')) || 1999;
            const lineTotal = qtyVal * unitPrice;
            totalSum += lineTotal;
            totalCount += qtyVal;
            const lineTotalEl = item.querySelector('[data-item-total]');
            if (lineTotalEl) {
                lineTotalEl.textContent = 'Rs.' + lineTotal.toLocaleString('en-US') + '.00';
            }
        });

        // Update footer estimated total
        const footerTotal = cartDrawerContent.querySelector('.wl-cart-drawer__total-val');
        if (footerTotal) {
            footerTotal.textContent = 'Rs.' + totalSum.toLocaleString('en-US') + '.00 PKR';
        }

        // Update header cart badge
        const cartBadge = document.querySelector('.wl-cart-count');
        if (cartBadge) {
            cartBadge.textContent = totalCount;
        }

        // If all items removed, show empty state
        if (items.length === 0) {
            const bodyEl = cartDrawerContent.querySelector('.wl-cart-drawer__body');
            if (bodyEl) {
                bodyEl.innerHTML = '<div style="text-align: center; padding: 60px 20px;"><p style="font-size: 16px; color: #555; margin-bottom: 20px;">Your cart is currently empty.</p><a href="/shop/" class="wl-btn wl-btn--primary" style="display:inline-block; padding: 12px 28px; text-decoration: none;">Continue Shopping</a></div>';
            }
            if (footerTotal) {
                footerTotal.textContent = 'Rs. 0.00 PKR';
            }
        }
    };

    if (cartDrawerContent) {
        cartDrawerContent.addEventListener('click', (e) => {
            // Quantity buttons
            const qtyBtn = e.target.closest('[data-qty-change]');
            if (qtyBtn) {
                e.preventDefault();
                const delta = parseInt(qtyBtn.getAttribute('data-qty-change'), 10) || 0;
                const wrap = qtyBtn.closest('.wl-cart-drawer__qty');
                const key = wrap ? wrap.getAttribute('data-cart-key') : null;
                const valEl = wrap ? wrap.querySelector('.wl-cart-drawer__qty-val') : null;
                let currentVal = valEl ? parseInt(valEl.textContent.trim(), 10) || 1 : 1;
                const newVal = Math.max(1, currentVal + delta);

                if (valEl) valEl.textContent = newVal;

                // If real WooCommerce cart key (32 hex characters)
                if (key && key.length === 32 && window.wearlab_ajax) {
                    const fd = new FormData();
                    fd.append('action', 'wearlab_update_cart_qty');
                    fd.append('cart_item_key', key);
                    fd.append('quantity', newVal);
                    fd.append('nonce', window.wearlab_ajax.nonce);

                    fetch(getAjaxUrl(), { method: 'POST', body: fd })
                        .then(r => r.json())
                        .then(res => {
                            if (res.success && res.data) {
                                if (res.data.count !== undefined) {
                                    const c = document.querySelector('.wl-cart-count');
                                    if (c) c.textContent = res.data.count;
                                }
                                if (res.data.html) {
                                    cartDrawerContent.innerHTML = res.data.html;
                                }
                            }
                        }).catch(() => {});
                } else {
                    // Demo mode or offline test: recalculate line total and footer subtotal dynamically!
                    recalculateDemoTotals();
                }
                return;
            }

            // Remove button
            const removeBtn = e.target.closest('[data-remove-key]');
            if (removeBtn) {
                e.preventDefault();
                const key = removeBtn.getAttribute('data-remove-key');
                const itemEl = removeBtn.closest('.wl-cart-drawer__item');

                // If real WooCommerce cart key
                if (key && key.length === 32 && window.wearlab_ajax) {
                    if (itemEl) {
                        itemEl.style.opacity = '0.4';
                        itemEl.style.pointerEvents = 'none';
                    }
                    const fd = new FormData();
                    fd.append('action', 'wearlab_remove_cart_item');
                    fd.append('cart_item_key', key);
                    fd.append('nonce', window.wearlab_ajax.nonce);

                    fetch(getAjaxUrl(), { method: 'POST', body: fd })
                        .then(r => r.json())
                        .then(res => {
                            if (res.success && res.data) {
                                if (res.data.count !== undefined) {
                                    const c = document.querySelector('.wl-cart-count');
                                    if (c) c.textContent = res.data.count;
                                }
                                if (res.data.html) {
                                    cartDrawerContent.innerHTML = res.data.html;
                                }
                            }
                        }).catch(() => {});
                } else if (itemEl) {
                    // Instantly slide up & remove demo item and update all totals
                    itemEl.style.transition = 'all 0.25s ease';
                    itemEl.style.opacity = '0';
                    itemEl.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        itemEl.remove();
                        recalculateDemoTotals();
                    }, 250);
                }
            }
        });
    }
});
