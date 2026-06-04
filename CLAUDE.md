# CLAUDE.md

Guidance for Claude Code when working in this repo.

## Project

A website for **Zenmatters**, a small home-based massage practice in Baarn (NL). Built so the owner (non-technical) can edit copy and images via the Kirby Panel.

**Language**: Site content is **Dutch**. Code, comments, and commit messages are English. Blueprint `label` values are Dutch (Panel UX is for the owner).

## Stack

- KirbyCMS 5 (flat-file PHP CMS, PHP 8.2+)
- Plain CSS with custom properties — no build step (`assets/css/main.css`)
- Self-hosted fonts: TT Fors Trial (Regular + Bold) in `assets/fonts/`
- Deploy target: managed PHP host (Fortrabbit / Uberspace)

## Structure

```
content/                   Flat-file content (edited via Panel or directly)
  site.txt                 Global: siteName, navigation, contact info
  home/home.txt            All homepage section fields
  privacyverklaring/       Privacy page content
site/
  blueprints/site.yml      Panel fields for global settings (Site tab)
  blueprints/pages/        Per-page Panel blueprints
  config/config.php        Kirby configuration
  snippets/                Section partials — one file per section:
                           header, footer, hero, about, naomi,
                           treatments, pricing, summer-offer, practical, contact
  templates/               Page templates (home.php, privacyverklaring.php)
assets/
  css/main.css             All CSS (brand tokens + BEM component styles)
  fonts/                   TT Fors Trial woff/woff2 files
  images/                  Logo files (logo-small.png, logo-xl.png)
kirby/                     Kirby core — managed by Composer, not committed
vendor/                    PHP vendor — not committed
```

## Conventions

- **No build step.** CSS is plain CSS with custom properties. Edit `assets/css/main.css` directly; never introduce a preprocessor or bundler without asking.
- **Content files use `----` as field separators.** Every field boundary in a `.txt` file must be a line containing only `----`. Missing separators cause fields to bleed into each other (the title will absorb subsequent fields).
- **All images go through Kirby's file API.** Templates call `$page->field()->toFile()` and then `$file->thumb(['width' => N])->url()`. Always set an `alt` attribute; use the file's `alt` meta field when available.
- **Dutch labels in blueprints, English field names.** `name: naomiHeading` with `label: Koptekst`.
- **No analytics, no cookies, no third-party scripts.** This is a deliberate privacy choice — don't add Plausible, GA, or similar without asking.
- **No fonts from Google CDN.** Fonts are self-hosted under `assets/fonts/`.
- **PHP version**: Kirby 5 requires PHP 8.2+. Use `/opt/homebrew/bin/php` locally — not MAMP's PHP 8.1 alias.

## Blueprint rules

- Global fields (siteName, navigation, contact) live in `site/blueprints/site.yml` and are read via `$site->field()`. Don't duplicate them on individual page blueprints.
- Homepage sections are grouped into **tabs** in `site/blueprints/pages/home.yml` — one tab per section. Keep the tab order in sync with the render order in `site/templates/home.php`.
- Rich text fields use the `writer` type with only `bold` and `italic` marks — no headings inside body copy. Headings live on the section component.
- Structure fields store repeatable items (treatments, pricing groups, certifications, nav items). Each item is a YAML `-\n  key: value` block in the content file.
- Boolean toggles like `summerActive` hide entire sections. Prefer toggling over deleting content so the owner can restore it without re-entering data.
- Pricing items use a `textarea` field with one price per line (`60 min | €80`). The template splits on `|` and newlines. The blueprint label explains the format.

## Panel

- First-time setup: visit `/panel` → create an admin account. The `panel.install` option in `config.php` allows this; disable it after the first account is created.
- Blueprint tabs group related fields (Hero / Over Zenmatters / Over Naomi / Behandelingen / Tarieven / Aanbieding / Praktisch).
- Global settings (siteName, navigation, contact info) are edited under **Site** in the Panel sidebar, not on the home page.
- The Panel is the sole editing interface — there is no visual overlay / click-to-edit. Changes save immediately; the flat-file store means no publish step.

## Privacy & GDPR

- Owner is in the EU; site serves EU visitors. Default posture is **collect nothing**.
- Contact happens off-site (Signal/WhatsApp/email/phone). No forms collect data.
- If a contact form is added later: server-side only, no third-party form services, and update `content/privacyverklaring/privacyverklaring.txt`.
- Content and media are stored on the PHP host server (EU region). The privacy statement must name the actual hosting provider — update it once the host is confirmed.

## Gotchas

- Content file field separators are `----` (four dashes), not `---`. Using three dashes will not split the field and the title absorbs everything that follows.
- `content/site.txt` stores global settings (`$site->field()`). It is **not** a page — don't reference it as `page('site')`.
- The `kirby/` directory is the Kirby core installed by Composer. It is git-ignored. After cloning, run `composer install` before the site will function.
- Page caching is disabled in `config.php` during development (`'active' => false`). Enable it for production.
- Kirby requires a paid license for production use. Purchase at `getkirby.com/buy` and place the key in `site/config/.license` (git-ignored by default).

## Common tasks

**Add a new section to the homepage**
1. Add fields to `site/blueprints/pages/home.yml` (new tab or within an existing tab)
2. Add matching fields to `content/home/home.txt` (with `----` separators around each new field)
3. Create a snippet in `site/snippets/<name>.php`
4. Add `<?php snippet('<name>') ?>` in `site/templates/home.php`

**Add a new standalone page**
1. Create `content/<slug>/<slug>.txt` with at minimum `Title: …\n----`
2. Create `site/blueprints/pages/<slug>.yml`
3. Create `site/templates/<slug>.php`

**Change brand colors**
- Edit `:root` custom properties in `assets/css/main.css` only. The palette (`--color-navy-*`, `--color-sand-*`, `--color-ink-*`, `--color-paper`) is the single source of truth. Don't hardcode hex values in snippets.

## Out of scope

Don't add without asking:
- Analytics, cookies, tracking pixels
- Third-party fonts loaded from external CDNs
- Booking systems, payment integrations
- i18n / multiple locales (site is Dutch-only by design)
- A database or headless API layer

## Commands

```bash
# Requires PHP 8.2+ — use Homebrew PHP, not MAMP
/opt/homebrew/bin/php -S localhost:8765 kirby/router.php

# Install/update Kirby and PHP dependencies
composer install
composer update

# Regenerate Composer autoload after adding plugins
composer dump-autoload
```
