# WEARLAB — Project Specification (Design Tokens)

> Single source of truth. Never hardcode a new color, font size, or spacing value that isn't listed here.  
> If a new token is needed, add it here FIRST, then use it.

## Brand

| Key | Value |
|-----|-------|
| Brand Name | WEARLAB |
| Tagline | EVERYDAY, ELEVATED. |
| SEO Title | WEARLAB \| Modern Pakistani Streetwear |
| Meta Description | Discover WEARLAB — modern Pakistani streetwear designed for everyday wear. Shop drop shoulders, polos, T-shirts and customized apparel. |
| Currency | PKR |
| Country | Pakistan |

## Color Palette

| Token | CSS Variable | Hex | Usage |
|-------|-------------|-----|-------|
| Black | `--wl-black` | `#111111` | Primary text, buttons, headings |
| Dark | `--wl-dark` | `#1A1A1A` | Body text, nav links |
| White | `--wl-white` | `#FFFFFF` | Backgrounds, button text on dark |
| Off-White | `--wl-off-white` | `#F5F5F5` | Alternate section backgrounds |
| Light BG | `--wl-light-bg` | `#FAFAFA` | Subtle background sections |
| Gray | `--wl-gray` | `#888888` | Secondary text, placeholders |
| Light Gray | `--wl-light-gray` | `#E5E5E5` | Borders, dividers |
| Medium Gray | `--wl-medium-gray` | `#666666` | Meta text, descriptions |
| Accent | `--wl-accent` | `#111111` | Same as black — monochrome brand |
| Error | `--wl-error` | `#D32F2F` | Form errors, sale badges |
| Success | `--wl-success` | `#2E7D32` | Success messages |

## Typography

| Token | CSS Variable | Value |
|-------|-------------|-------|
| Font Family (Headings) | `--wl-font-heading` | `'Inter', -apple-system, BlinkMacSystemFont, sans-serif` |
| Font Family (Body) | `--wl-font-body` | `'Inter', -apple-system, BlinkMacSystemFont, sans-serif` |
| Heading Weight Bold | `--wl-fw-bold` | `700` |
| Heading Weight Semi | `--wl-fw-semi` | `600` |
| Body Weight Regular | `--wl-fw-regular` | `400` |
| Body Weight Medium | `--wl-fw-medium` | `500` |

### Type Scale

| Name | CSS Variable | Desktop | Mobile |
|------|-------------|---------|--------|
| Display | `--wl-fs-display` | 56px | 36px |
| H1 | `--wl-fs-h1` | 42px | 28px |
| H2 | `--wl-fs-h2` | 32px | 24px |
| H3 | `--wl-fs-h3` | 24px | 20px |
| H4 | `--wl-fs-h4` | 20px | 18px |
| Body Large | `--wl-fs-body-lg` | 18px | 16px |
| Body | `--wl-fs-body` | 16px | 15px |
| Body Small | `--wl-fs-body-sm` | 14px | 13px |
| Caption | `--wl-fs-caption` | 12px | 11px |
| Overline | `--wl-fs-overline` | 12px | 11px |

### Letter Spacing

| Name | Value | Usage |
|------|-------|-------|
| Tight | `-0.02em` | Display headings |
| Normal | `0` | Body text |
| Wide | `0.08em` | Overlines, buttons, small caps |
| Extra Wide | `0.15em` | Announcement bar |

## Spacing Scale

Base unit: **4px**

| Token | Value |
|-------|-------|
| `--wl-space-1` | 4px |
| `--wl-space-2` | 8px |
| `--wl-space-3` | 12px |
| `--wl-space-4` | 16px |
| `--wl-space-5` | 20px |
| `--wl-space-6` | 24px |
| `--wl-space-7` | 32px |
| `--wl-space-8` | 40px |
| `--wl-space-9` | 48px |
| `--wl-space-10` | 64px |
| `--wl-space-11` | 80px |
| `--wl-space-12` | 120px |

## Breakpoints

| Name | Value | Max-Width Query |
|------|-------|----------------|
| Mobile | 375px | `max-width: 767px` |
| Tablet | 768px | `max-width: 1023px` |
| Desktop | 1024px+ | `min-width: 1024px` |
| Wide | 1440px | `min-width: 1440px` |

## Container

| Token | Value |
|-------|-------|
| Max Width | 1200px |
| Padding (Desktop) | 40px each side |
| Padding (Tablet) | 24px each side |
| Padding (Mobile) | 16px each side |

## Button Styles

| Property | Primary | Secondary | Outline |
|----------|---------|-----------|---------|
| Background | `--wl-black` | `--wl-white` | transparent |
| Text Color | `--wl-white` | `--wl-black` | `--wl-black` |
| Border | none | 1px solid `--wl-black` | 1px solid `--wl-black` |
| Border Radius | 0 | 0 | 0 |
| Padding | 14px 32px | 14px 32px | 14px 32px |
| Font Size | 13px | 13px | 13px |
| Font Weight | 600 | 600 | 600 |
| Letter Spacing | 0.08em | 0.08em | 0.08em |
| Text Transform | uppercase | uppercase | uppercase |
| Hover (Primary) | bg `--wl-dark` | bg `--wl-off-white` | bg `--wl-black`, text `--wl-white` |
| Transition | all 0.3s ease | all 0.3s ease | all 0.3s ease |

## Card Styles (Product Cards)

| Property | Value |
|----------|-------|
| Border | none |
| Shadow | none |
| Border Radius | 0 |
| Image Aspect Ratio | 3:4 |
| Image Object Fit | cover |
| Text Alignment | left |
| Title Font Size | 14px |
| Title Font Weight | 500 |
| Price Font Size | 14px |
| Price Font Weight | 600 |
| Gap (between cards) | 8px desktop, 4px mobile |

## Section Styles

| Property | Value |
|----------|-------|
| Section Padding (Desktop) | 80px 0 |
| Section Padding (Mobile) | 48px 0 |
| Section Heading Size | H2 (32px desktop) |
| Section Heading Weight | 700 |
| Section Heading Transform | uppercase |
| Overline Size | 12px |
| Overline Weight | 500 |
| Overline Transform | uppercase |
| Overline Letter Spacing | 0.15em |
| Overline Color | `--wl-gray` |

## Header

| Property | Value |
|----------|-------|
| Announcement Bar BG | `--wl-black` |
| Announcement Bar Text | `--wl-white` |
| Announcement Bar Font Size | 12px |
| Header BG | `--wl-white` |
| Header Height (Desktop) | 70px |
| Header Height (Mobile) | 60px |
| Header Border Bottom | 1px solid `--wl-light-gray` |
| Sticky | Yes, on scroll |
| Nav Link Size | 14px |
| Nav Link Weight | 500 |
| Nav Link Transform | none |
| Nav Link Spacing | 32px gap |

## Footer

| Property | Value |
|----------|-------|
| Background | `--wl-black` |
| Text Color | `--wl-white` at 70% opacity |
| Heading Color | `--wl-white` |
| Link Hover | `--wl-white` at 100% opacity |
| Padding | 80px 0 40px |
| Column Count | 5 (desktop), stacked (mobile) |
| Bottom Bar Border | 1px solid rgba(255,255,255,0.15) |

## CSS Class Naming Convention

Prefix all custom classes with `wl-` to avoid conflicts:

```
.wl-header          — Header wrapper
.wl-announcement    — Announcement bar
.wl-nav             — Navigation
.wl-hero            — Hero section
.wl-section         — Generic section wrapper
.wl-container       — Max-width container
.wl-grid            — Grid layouts
.wl-card            — Product/category cards
.wl-btn             — Buttons
.wl-btn--primary    — Primary button modifier
.wl-btn--secondary  — Secondary button modifier
.wl-btn--outline    — Outline button modifier
.wl-footer          — Footer wrapper
.wl-form            — Form elements
.wl-product-*       — Product-specific components
.wl-shop-*          — Shop page components
```
