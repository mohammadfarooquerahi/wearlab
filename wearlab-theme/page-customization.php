<?php
/**
 * Template Name: Customization
 */
get_header();
?>

<div class="wl-page-hero">
    <div class="wl-container">
        <h1 class="wl-page-hero__title">YOUR IDEA. YOUR DESIGN.</h1>
        <p class="wl-page-hero__subtitle">Elevate your team, event, or brand with premium customized apparel.</p>
    </div>
</div>

<div class="wl-container wl-customization-page">
    <div class="wl-services-section">
        <div class="wl-service-card">
            <h3>Custom Printing</h3>
            <p>High-quality screen printing and embroidery on our premium blanks.</p>
        </div>
        <div class="wl-service-card">
            <h3>Team & Event Apparel</h3>
            <p>Uniforms and event merchandise that stand out.</p>
        </div>
    </div>

    <div class="wl-custom-form-wrapper">
        <h2>REQUEST A QUOTE</h2>
        <form class="wl-form wl-custom-form">
            <div class="wl-form-row">
                <div class="wl-form-group">
                    <label>Full Name</label>
                    <input type="text" class="wl-input" required>
                </div>
                <div class="wl-form-group">
                    <label>Organization / Brand</label>
                    <input type="text" class="wl-input">
                </div>
            </div>

            <div class="wl-form-row">
                <div class="wl-form-group">
                    <label>Email Address</label>
                    <input type="email" class="wl-input" required>
                </div>
                <div class="wl-form-group">
                    <label>WhatsApp Number</label>
                    <input type="tel" class="wl-input" required>
                </div>
            </div>

            <div class="wl-form-row">
                <div class="wl-form-group">
                    <label>Product Type</label>
                    <select class="wl-select">
                        <option>Drop Shoulder T-Shirt</option>
                        <option>Standard T-Shirt</option>
                        <option>Polo Shirt</option>
                        <option>Hoodie</option>
                    </select>
                </div>
                <div class="wl-form-group">
                    <label>Customization Type</label>
                    <select class="wl-select">
                        <option>Screen Printing</option>
                        <option>Embroidery</option>
                        <option>DTF Printing</option>
                    </select>
                </div>
            </div>

            <div class="wl-form-row">
                <div class="wl-form-group">
                    <label>Minimum Pieces (30+ required)</label>
                    <input type="number" class="wl-input" min="30" value="30" required>
                </div>
                <div class="wl-form-group">
                    <label>Required Date</label>
                    <input type="date" class="wl-input">
                </div>
            </div>

            <div class="wl-form-group">
                <label>Design Upload (Optional)</label>
                <input type="file" class="wl-input">
            </div>

            <div class="wl-form-group">
                <label>Additional Details</label>
                <textarea class="wl-textarea" rows="4"></textarea>
            </div>

            <button type="submit" class="wl-btn wl-btn--primary">SUBMIT REQUEST</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>
