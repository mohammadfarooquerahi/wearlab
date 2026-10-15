# 📖 WEARLAB &mdash; Complete Website Operations & Client Handover Manual

Welcome to your official **WEARLAB E-Commerce Store** (`wearlab.store`) management guide. This document walks you through every feature of your store, from editing text and images to managing products, fulfilling orders, and customizing settings &mdash; all without writing a single line of code.

---

## Table of Contents
1. [Logging In to Your Website Dashboard](#1-logging-in-to-your-website-dashboard)
2. [Visual Homepage Editing (Live Customizer)](#2-visual-homepage-editing-live-customizer)
   - [Announcement Ticker Bar](#a-announcement-ticker-bar)
   - [Hero Banner](#b-hero-banner)
   - [Featured Products Section](#c-featured-products-section)
   - [Shop by Fit Cards (4 Lifestyle Cards)](#d-shop-by-fit-cards-4-lifestyle-cards)
   - [Brand Statement / Story Section](#e-brand-statement--story-section)
   - [Collection Banner](#f-collection-banner)
   - [Customer Reviews Section](#g-customer-reviews-section)
   - [Newsletter & Final Call to Action](#h-newsletter--final-call-to-action)
   - [Footer Settings](#i-footer-settings)
   - [Social Media & WhatsApp Concierge](#j-social-media--whatsapp-concierge)
3. [Editing Website Pages & Policies](#3-editing-website-pages--policies)
   - [About Us Page](#about-us-page)
   - [FAQ Page](#faq-page)
   - [Contact Us Page](#contact-us-page)
   - [Store Policies (Returns, Shipping, Payment, Privacy, Terms)](#store-policies)
   - [Order Tracking Page](#order-tracking-page)
4. [Product Catalog Management](#4-product-catalog-management)
   - [Adding a New Product](#adding-a-new-product)
   - [Setting Up Sizing Variations (S, M, L, XL)](#setting-up-sizing-variations-s-m-l-xl)
   - [Setting PKR Prices & Sale Discounts](#setting-pkr-prices--sale-discounts)
   - [Product Images & Image Slider Gallery](#product-images--image-slider-gallery)
   - [Inventory & Stock Management](#inventory--stock-management)
5. [Order Management & Cash on Delivery (COD)](#5-order-management--cash-on-delivery-cod)
   - [Viewing New Customer Orders](#viewing-new-customer-orders)
   - [Recommended COD Dispatch Workflow](#recommended-cod-dispatch-workflow)
   - [Updating Order Status](#updating-order-status)
6. [Customer Order Confirmation Emails (Hostinger SMTP)](#6-customer-order-confirmation-emails-hostinger-smtp)
7. [Navigation Menus & Footer Links](#7-navigation-menus--footer-links)
8. [Logo, Favicon & Brand Identity](#8-logo-favicon--brand-identity)
9. [Coupons & Promotional Discounts](#9-coupons--promotional-discounts)
10. [Daily Operations, Security & Best Practices](#10-daily-operations-security--best-practices)

---

## 1. Logging In to Your Website Dashboard

1. Open your web browser (Chrome, Edge, Safari, or Firefox).
2. Go to: **`https://wearlab.store/wp-admin`**
3. Enter your **Username / Email** and **Password**.
4. Click **Log In**.

> 💡 **Tip:** Bookmark `https://wearlab.store/wp-admin` in your browser bookmark bar for quick 1-click access every day.

---

## 2. Visual Homepage Editing (Live Customizer)

All sections on the WEARLAB homepage can be edited visually with a live real-time preview.

**How to access the visual editor:**
1. Log into WP Admin.
2. In the left navigation sidebar, navigate to **Appearance > Customize**.
3. You will see a list of organized WEARLAB sections on the left, with your live website preview on the right.
4. Whenever you make changes, click the blue **Publish** button at the top left to make your edits live instantly!

---

### A. Announcement Ticker Bar
*Controls the top scrolling announcement ribbon.*
- Go to: **Appearance > Customize > Brand & Announcement Bar**.
- **Enable Announcement Ticker:** Check or uncheck to show or hide the announcement bar.
- **Announcement 1:** Default: `FREE NATIONWIDE DELIVERY ACROSS PAKISTAN`
- **Announcement 2:** Default: `DROP 01 NOW LIVE • LIMITED ESSENTIALS`
- **Announcement 3:** Default: `PREMIUM HEAVYWEIGHT COTTON • 100% ORIGINAL`
- **Ticker Speed:** Adjust sliding animation duration (default is `24` seconds).

---

### B. Hero Banner
*The primary full-width banner customers see when first landing on the site.*
- Go to: **Appearance > Customize > Homepage: Hero Banner**.
- **Hero Title:** Change the main headline (e.g., `WEARLAB / 01`).
- **Hero Image:** Click **Select Image** to upload or change the background image (recommended size: `1920x1080px` or high-resolution vertical lifestyle shot).
- **Hero Button Label:** Change button text (e.g., `SHOP DROP 01`).
- **Hero Button Link:** Enter the destination URL (e.g., `/shop/`).

---

### C. Featured Products Section
*The product showcase section right below the hero.*
- Go to: **Appearance > Customize > Homepage: Featured Products**.
- **Overline Tag:** Small uppercase tag above the title (default: `CURATED STREETWEAR`).
- **Section Title:** Main section heading (default: `DROP 01 — ESSENTIALS`).
- **Description / Subtitle:** Short paragraph describing the drop.
- **View All Button Text:** Button label (e.g., `VIEW ALL PIECES`).
- **View All Button Link:** Link to product archive (e.g., `/shop/`).

---

### D. Shop by Fit Cards (4 Lifestyle Cards)
*The 4 visual lifestyle cards showcasing fits and categories.*
- Go to: **Appearance > Customize > Homepage: Shop by Fit Cards**.
- **Section Overline:** Default: `EXPLORE SILHOUETTES`.
- **Section Title:** Default: `SHOP BY FIT`.
- **Card 1, 2, 3, 4 Settings:**
  - **Title:** e.g., `OVERSIZED HOODIE`, `BOXY FIT TEE`, `RELAXED CARGO PANTS`, `VARSITY BOMBER`.
  - **Price Badge:** e.g., `PKR 4,490`, `PKR 2,490`.
  - **Link URL:** Destination category or product URL.
  - **Image:** Click **Select Image** to upload a high-resolution model lifestyle shot for that fit (recommended size: `800x1000px` portrait).

---

### E. Brand Statement / Story Section
*The minimalist brand philosophy section.*
- Go to: **Appearance > Customize > Homepage: Brand Statement**.
- **Overline Tag:** Default: `THE PHILOSOPHY`.
- **Heading:** Default: `NOT JUST CLOTHING. AN ATTITUDE.`.
- **Story Body Text:** Edit your brand ethos and description.
- **Button Label & Link:** Default: `DISCOVER OUR STORY` → `/about/`.

---

### F. Collection Banner
*The promotional collection spotlight banner.*
- Go to: **Appearance > Customize > Homepage: Collection Banner**.
- **Overline Tag:** Default: `LIMITED RELEASE`.
- **Title:** Default: `HEAVYWEIGHT FLEECE DROP`.
- **Description:** Promotional details (e.g. *Crafted from custom-milled 420 GSM French terry...*).
- **Button Label & Link:** Button text and destination link.
- **Banner Image:** Upload your featured collection editorial photo.

---

### G. Customer Reviews Section
*Builds buyer trust with verified customer feedback.*
- Go to: **Appearance > Customize > Homepage: Customer Reviews**.
- **Section Overline & Title:** Default: `WHAT THEY SAY` / `VERIFIED CLIENTS`.
- **Reviews 1, 2, and 3:**
  - **Author Name:** Customer's name (e.g., `Hamza K.`, `Bilal M.`, `Zainab R.`).
  - **City / Badge:** Location (e.g., `Lahore`, `Karachi`, `Islamabad`).
  - **Review Quote:** Testimonial text describing quality, fit, or fast delivery.

---

### H. Newsletter & Final Call to Action
*Drives subscriber signups and last-minute conversions.*
- Go to: **Appearance > Customize > Homepage: Newsletter & Final CTA**.
- **Newsletter Heading:** Default: `JOIN THE INNER CIRCLE`.
- **Newsletter Subtitle:** Default: `Receive private drop notices, early access, and secret releases.`
- **Final Banner Title:** Default: `READY TO ELEVATE YOUR WARDROBE?`
- **Final Banner Subtitle:** Default: `Experience high-density cotton, custom tailoring, and contemporary silhouettes.`
- **Final CTA Button Label & Link:** Default: `SHOP THE COLLECTION` → `/shop/`.

---

### I. Footer Settings
- Go to: **Appearance > Customize > Footer Settings**.
- **Country / Currency Text:** Default: `PAKISTAN (PKR ₨)`.
- **Copyright Notice:** Default: `© 2026 WEARLAB. ALL RIGHTS RESERVED.`

---

### J. Social Media & WhatsApp Concierge
- Go to: **Appearance > Customize > Social Links & WhatsApp**.
- **Instagram URL:** Enter your official Instagram profile link (e.g. `https://instagram.com/wearlab.pk`).
- **Facebook URL:** Enter your Facebook page link.
- **TikTok URL:** Enter your TikTok profile link.
- **WhatsApp Concierge Number:** Enter your store WhatsApp phone number with country code (e.g., `+923001234567` or `03001234567`).
- **Enable Floating WhatsApp Widget:** When checked, a floating WhatsApp icon appears on the bottom-left of every page. When clicked, it opens a direct WhatsApp chat with pre-filled greeting text!

---

## 3. Editing Website Pages & Store Policies

All static pages and policies support **Smart Content Fallback**:
- If you edit the page in WordPress, your custom text, images, and formatting display immediately.
- If you leave the editor empty, the theme automatically displays the pre-written policies.

### How to edit any page:
1. In WP Admin, go to **Pages > All Pages**.
2. Hover over the page you want to edit and click **Edit**.
3. Edit your content using the WordPress editor (add text, headings, bullet points, images).
4. Click the blue **Update** button at the top right.

### Core Policies Implemented on Your Store:

#### A. Shipping Policy (`/shipping-policy/`)
- **Order Processing:**
  - Orders are processed after confirmation.
  - Normal dispatch within **1–3 business days**.
  - Customized printing and embroidery orders may require additional processing time.
  - Customers may be contacted through WhatsApp or phone to confirm order details when required.
- **Delivery Time:**
  - Standard delivery within Pakistan generally takes **2–5 business days after dispatch**.
  - Remote areas may take longer. Delivery estimates may be affected by courier delays, weather, or public holidays.
- **Shipping Charges:**
  - Displayed during checkout or communicated before confirmation.
- **Order Tracking:**
  - Tracking numbers sent via WhatsApp, SMS, or available communication channels.
- **Incorrect Address:**
  - Customers are responsible for complete and accurate address and phone details.

#### B. Return & Exchange Policy (`/returns-policy/`)
- **Eligibility:**
  - Exchange requested within **7 days of receiving the order**.
  - Applies to: damaged/defective products, wrong item/size sent by WEARLAB, or manufacturing/printing defect.
- **Product Condition:**
  - Must be unused, unwashed, and in original condition with original tags and packaging retained.
  - Photo or video proof required before exchange approval.
- **Size Exchanges:**
  - Available subject to product availability. Customer responsible for return and reshipping courier costs.
- **Customized Products:**
  - Customized, printed, or embroidered products are **not eligible for return/exchange** for change of mind or personal preference.
- **Non-Returnable Conditions:**
  - Worn, washed, altered garments; removed tags; improper washing care; or requests after 7 days.
- **How to Request an Exchange:**
  - Contact support on WhatsApp with: 1. Order number, 2. Customer name, 3. Product name & size, 4. Reason, 5. Photo/video proof.

#### C. Privacy Policy (`/privacy-policy/`)
- **Information Collected:** Name, phone, email, address, city, order details, and payment info solely necessary for fulfillment.
- **Data Usage:** Order fulfillment, customer support, exchange processing, and service improvements.
- **Information Protection:** Industry-standard security and 256-bit SSL encryption.
- **Sharing of Information:** WEARLAB does **not sell or rent** personal info. Shared only with trusted couriers, payment gateways, and tech providers as needed.
- **Cookies & Third Parties:** Standard functional cookies and external link privacy terms.

#### D. Terms & Conditions (`/terms-conditions/`)
- **Product Information:** Reasonable efforts for color and description accuracy (noting screen and lighting calibration variances).
- **Pricing:** Right to adjust prices and drop availability without prior notice.
- **Order Cancellation:** Orders may be cancelled before dispatch subject to confirmation. Dispatched orders cannot be cancelled.
- **Product Availability:** Subject to batch availability with replacement or refund options if out of stock.
- **Customer Support:** Direct contact channels via WhatsApp and email.

#### E. Master All-In-One Policies Page (`/policies/`)
- All 4 policies are also unified on a single master page (`page-policies.php`) with quick anchor jump tabs and brand signature:
  `WEARLAB • Designed in Pakistan • wearlab.store`.

---

## 4. Product Catalog Management

### Adding a New Product
1. Go to **Products > Add New** in the left sidebar.
2. Enter the **Product Name** (e.g., `Oversized Vintage Wash Tee`).
3. In the main description box, write the product story, fabric composition (e.g. *100% 280 GSM Combed Cotton*), and styling tips.
4. On the right-hand panel:
   - **Product Categories:** Select the appropriate category (e.g. *T-Shirts*, *Hoodies*, or *New Arrivals*).
   - **Set Product Image:** Upload the primary main photo (front view).
   - **Product Gallery:** Click **Add product gallery images** to upload back view, side view, and detail close-up shots. Customers can swipe/slide through these on the product page.

---

### Setting Up Sizing Variations (S, M, L, XL)
For streetwear garments with multiple sizes:

1. Scroll down to the **Product Data** box below the text editor.
2. Change the dropdown from **Simple product** to **Variable product**.
3. Click on the **Attributes** tab on the left side of that box.
4. Click **Add** (Custom product attribute):
   - **Name:** `Size`
   - **Values:** Type: `S | M | L | XL` (separated by the vertical bar pipe character `|`).
   - Check the box: **Used for variations**.
   - Click **Save attributes**.
5. Click on the **Variations** tab on the left.
6. Click **Generate variations** (or select **Add variation** → **Create variations from all attributes**).
7. WordPress will create 4 variation rows: `S`, `M`, `L`, `XL`.
8. Expand each size variation and enter:
   - **Regular price (PKR):** e.g., `3490`
   - **Stock status:** `In stock`
9. Click **Save changes**.
10. Click the blue **Publish** button at the top right to make the product live!

---

### Setting PKR Prices & Sale Discounts
- **Regular Price (PKR):** Normal retail price (e.g., `3490`).
- **Sale Price (PKR):** (Optional) Discounted price (e.g., `2990`). When set, the product automatically displays a **SALE** badge and strikes through the old price!
- You can even click **Schedule** next to Sale Price to run a flash sale for specific dates.

---

### Inventory & Stock Management
- In the **Inventory** tab:
  - **SKU:** (Optional) Your internal inventory code (e.g., `WL-TEE-001`).
  - **Manage stock:** Check this box if you want WooCommerce to automatically stop sales when inventory reaches 0.
  - **Stock quantity:** Enter units available (e.g., `50`).
  - **Stock status:** Choose `In stock` or `Out of stock`.

---

## 5. Order Management & Cash on Delivery (COD)

### Viewing New Customer Orders
Whenever a customer purchases on WEARLAB:
1. Go to **WooCommerce > Orders** in WP Admin.
2. You will see a list of orders with Order ID (e.g., `#75`), Customer Name, Date, Status, and Total Amount.
3. Click on any Order Number to view:
   - Customer Full Name
   - Shipping Address (City, Area, House/Street)
   - Mobile Phone Number
   - Email Address
   - Items & Sizes ordered
   - Customer Order Notes (special delivery instructions)

---

### Recommended COD Dispatch Workflow

```
Customer places order on website
             │
             ▼
Order status: PROCESSING
             │
             ▼
1. Staff calls or WhatsApps customer to confirm address & size
   ("Hi [Name], confirming your WEARLAB order #75 for PKR 3,490...")
             │
             ▼
2. Package the item with WEARLAB branding & print shipping slip
             │
             ▼
3. Book parcel with courier (PostEx, Trax, Leopard, or TCS)
             │
             ▼
4. Change status in WP Admin to: COMPLETED
   (Paste courier tracking ID into order notes)
             │
             ▼
5. Courier delivers parcel & collects CASH at doorstep
```

---

### Updating Order Status
Inside the order details page:
- On the right side under **Order details**, change **Status**:
  - **Processing:** Order received, awaiting packaging/verification.
  - **On Hold:** Waiting for customer response or phone confirmation.
  - **Completed:** Handed over to courier / Dispatched.
  - **Cancelled:** Customer requested cancellation.
  - **Refunded:** Order returned/refunded.
- Click **Update** to save.

---

## 6. Customer Order Confirmation Emails (Hostinger SMTP)

Your store is programmed to send order confirmation emails to customers immediately when they complete checkout.

To guarantee that emails land directly in the customer's **Inbox** (and never in Spam), configure **WP Mail SMTP** with your Hostinger Titan Email:

### Step-by-Step SMTP Setup:
1. In WP Admin, go to **WP Mail SMTP > Settings**.
2. **Primary Settings:**
   - **From Email:** `orders@wearlab.store` (or your official Hostinger email).
   - **Force From Email:** Check this box.
   - **From Name:** `WEARLAB`
   - **Force From Name:** Check this box.
3. **Mailer:**
   - Select **Other SMTP**.
4. **Other SMTP Settings:**
   - **SMTP Host:** `smtp.hostinger.com`
   - **Encryption:** `SSL`
   - **SMTP Port:** `465`
   - **Auto TLS:** `ON`
   - **Authentication:** `ON`
   - **SMTP Username:** `orders@wearlab.store`
   - **SMTP Password:** *(Your Hostinger email password)*
5. Click **Save Settings**.
6. Click on the **Email Test** tab at the top:
   - Enter your personal Gmail address and click **Send Email**.
   - Check your Gmail inbox — you will see a confirmation email from `WEARLAB <orders@wearlab.store>`!

---

## 7. Navigation Menus & Footer Links

### Managing the Header Menu
1. Go to **Appearance > Menus**.
2. In the dropdown at the top, select **Primary Navigation** and click **Select**.
3. To add pages: Check pages from the left column (e.g. *Shop*, *New Arrivals*, *About*, *Contact*) and click **Add to Menu**.
4. Drag and drop items up or down to re-order them.
5. Drag an item slightly to the right to create a drop-down sub-menu.
6. Click **Save Menu**.

### Managing Footer Links
Under **Appearance > Menus**, select:
- **Footer Shop Menu:** For categories, new arrivals, best sellers.
- **Footer Support Menu:** For FAQ, Contact Us, Order Tracking.
- **Footer Legal Menu:** For Exchange & Returns, Shipping Policy, Privacy Policy, Terms.

---

## 8. Logo, Favicon & Brand Identity

1. Go to **Appearance > Customize > Site Identity**.
2. **Logo:**
   - Click **Change Logo** or **Upload Logo**.
   - Upload your high-resolution WEARLAB logo (transparent PNG or SVG recommended, width `180px` to `260px`).
3. **Site Icon (Favicon):**
   - Click **Select Site Icon**.
   - Upload a square icon (`512x512px` PNG).
   - This icon appears in browser tabs, mobile bookmarks, and search results.
4. Click **Publish**.

---

## 9. Coupons & Promotional Discounts

Create discount codes for influencer campaigns, seasonal drops, or VIP clients:

1. Go to **Marketing > Coupons** in WP Admin.
2. Click **Add coupon**.
3. **Coupon code:** Enter the code customers will type (e.g., `LAUNCH10` or `WELCOME500`).
4. **Discount type:**
   - *Percentage discount* (e.g., `10%` off total).
   - *Fixed cart discount* (e.g., `PKR 500` off total).
5. **Coupon amount:** Enter the value (e.g., `10` or `500`).
6. **Usage restriction tab:** (Optional) Set minimum spend (e.g., `PKR 5,000`) or exclude sale items.
7. **Usage limits tab:** Limit number of times the coupon can be used overall or per customer.
8. Click **Publish**.

---

## 10. Daily Operations, Security & Best Practices

1. **Daily Order Review:**
   - Check **WooCommerce > Orders** at 11:00 AM and 4:00 PM PKT daily.
   - Confirm addresses by calling customers before booking courier dispatch to minimize return rates (RTO).
2. **Product Photos:**
   - Always upload clean, well-lit, compressed images (under 300KB per image using tools like TinyPNG or WebP) so your website continues to load at lightning speed.
3. **WordPress & Plugin Updates:**
   - Keep WooCommerce updated. Always take a quick backup before updating major version numbers.
4. **Admin Security:**
   - Never share your primary Administrator password.
   - If adding staff or packaging team members, go to **Users > Add New** and assign them the **Shop Manager** role so they can only manage products and orders without altering theme code.
5. **Backups:**
   - Hostinger provides automatic daily backups under your hPanel dashboard under **Files > Backups**.

---

*Document prepared for WEARLAB Official Handover • Theme Version 1.5.1 • wearlab.store*
