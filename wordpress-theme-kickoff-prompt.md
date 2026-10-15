# WordPress Clothing Brand Theme — Kickoff Prompt

Paste this as your FIRST message to Claude (or any AI coding tool) before any code is written.
Fill in the [BRACKETS] with your client's details.

---

## PROMPT TO SEND

You are building a custom WordPress theme for a clothing brand called **[CLIENT BRAND NAME]**.

**Reference site:** https://www.khushposh.co/
Study its structure and UX patterns (not the code, just the layout logic):
- Sticky header with logo, mega-menu (categories like Denim, Tops, Bottoms), search, cart icon
- Full-width hero banner/slider with a seasonal campaign + 3-4 category tiles below it
- "Shop by Cut/Category" grid section
- "New Arrivals" product grid (2 images per card, swap on hover, price shown)
- Trust badges row (returns, secure payment, order tracking, customer count)
- Reviews/rating strip
- Footer with quick links, newsletter signup, payment method icons, social links
- Country/region selector, announcement bar

**Stack:** [e.g. Custom theme, PHP + ACF + WooCommerce / Elementor / Bricks — specify which]
**Pages needed:** Home, Shop/Collection, Single Product, Cart, Checkout, About, Contact, Policy pages
**Brand colors/fonts:** [give hex codes + font names, or say "propose 2-3 options first"]

### BEFORE WRITING ANY CODE, do this setup step:

Create these files in the project root and keep them updated as we work — treat them as our shared memory so fixing one thing never breaks another:

1. **`PROJECT-SPEC.md`** — brand name, color palette (with hex codes), typography scale, spacing scale, breakpoints (mobile/tablet/desktop px values), button/card/section styles. This is the single source of truth for design tokens. Every component must pull from here, never hardcode a new color or font size inline.

2. **`COMPONENTS.md`** — a running list of every section/component built so far: name, file path, what it depends on (which CSS classes, which template parts, which ACF fields), and a one-line description. Update this every time you add or touch a component.

3. **`CHANGELOG.md`** — one line per change: date, what was changed, which files were touched. This is what stops "fix X breaks Y" — you check this before touching a file someone else (or a past session) already modified.

4. **`KNOWN-ISSUES.md`** — anything left incomplete, any responsive breakpoint not yet tested, any browser quirk. Update as issues are found and resolved.

### Working rules for the whole project:

- Always check `PROJECT-SPEC.md` and `COMPONENTS.md` before changing a file — don't guess at existing conventions.
- Never modify a component's shared CSS/class to fix one page if that class is used elsewhere (per `COMPONENTS.md`) — create a scoped/modifier class instead.
- Every new section must be tested at 3 breakpoints (mobile ~375px, tablet ~768px, desktop ~1440px) before being marked done in `COMPONENTS.md`.
- Don't introduce a new color, font size, or spacing value that isn't already in `PROJECT-SPEC.md` — if a new one is genuinely needed, add it to the spec file first, then use it.
- After every change, update `CHANGELOG.md` with what was touched, so nothing gets silently overwritten later.
- When I report a bug, first tell me which file(s) and component(s) it involves (per `COMPONENTS.md`) before changing anything, so we both know the blast radius.

Confirm you've created these 4 files and summarized the plan before writing any theme code.

---

## FIX-REQUEST TEMPLATE (use for every bug/change after kickoff)

Keep this short — the AI should already have context from the files above, so you don't need to re-explain the whole project each time.

```
Bug/change: [describe what's wrong or what you want changed]
Where: [page/section name, e.g. "product grid on Shop page"]
Check COMPONENTS.md first — tell me what else uses this component/class
before you change it, then fix it and update CHANGELOG.md.
```

## RESPONSIVENESS CHECK (run after any layout change)

```
Check this change at mobile (375px), tablet (768px), and desktop (1440px).
Confirm nothing else on the page shifted, then update KNOWN-ISSUES.md
if anything is still broken at any breakpoint.
```

---

### Why this works
- The 4 files act as persistent memory across sessions/chats — you're not re-explaining the whole site every time, which is what burns tokens.
- `COMPONENTS.md` is what prevents "fixed the header, broke the footer" — the AI checks shared dependencies before editing.
- `PROJECT-SPEC.md` stops color/font drift — everything traces back to one palette instead of the AI inventing new shades each session.
- `CHANGELOG.md` gives you (and future AI sessions) a paper trail, so nothing gets silently reverted or duplicated.
