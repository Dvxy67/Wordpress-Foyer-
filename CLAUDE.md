# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress theme for "Foyer Ander Lechtois" — a community housing organization. Mobile-first, touch-friendly theme featuring a 3-card interactive slider. No build system — all files are served directly by WordPress (PHP, CSS, vanilla JS).

## Development Setup

This theme runs on a local MAMP WordPress installation at:
`/Applications/MAMP/htdocs/foyer_local/wp-content/themes/foyer-theme/`

WordPress admin: typically `http://localhost/foyer_local/wp-admin`

There are no build steps, no package.json, no compilation. Edit files directly and refresh the browser.

## Architecture

### Key files

- `functions.php` — Theme registration, asset enqueueing (with `filemtime()` cache-busting), WordPress Customizer sections, and helper functions `get_foyer_image()` / `get_foyer_link()`
- `style.css` — All CSS (mobile-first, single file, includes theme metadata header required by WordPress)
- `assets/js/slider.js` — Vanilla JS slider: touch swipe, keyboard nav, velocity-based gesture detection, real-time CSS position measurements via `requestAnimationFrame`
- `front-page.php` — Homepage template, renders the 3-card slider

### Page templates

Custom page templates follow the `page-*.php` naming convention:
- `page-foyer.php`, `page-habitants.php`, `page-logement-sous-menu.php`, `page-pannes-quartier.php`, `page-quartiers.php`, `page-rapport-annuel.php`, `page-texte.php`

### WordPress Customizer options

Configured in `functions.php`, exposed under **Apparence > Personnaliser**:
- **Images des Cartes**: images for each of the 3 cards (habitant, logement, foyer) + footer logo
- **Liens des Cartes**: URLs for each card

Access in templates via `get_foyer_image($key)` and `get_foyer_link($key)` helpers.

### Slider logic (`assets/js/slider.js`)

The slider reads card positions directly from the DOM (no hardcoded pixel values). It supports:
- Touch swipe with velocity detection
- Keyboard (arrow keys, Home, End)
- Pagination dots
- `requestAnimationFrame` for smooth animation

## Theme Colors

- Background: purple gradient (`#7B68EE` → `#6A5ACD`)
- Card "habitant": golden (`#F4D03F` → `#E8C547`)
- Card "logement": pink (`#F1A7A7` → `#E89B9B`)
- Card "foyer": green (`#7DCEA0` → `#73C6B6`)
- Title band: red `#FF0000`

## Pending work

See `quartier_manquant.md` for the list of ~10 neighborhoods still missing from the quartiers page.
See `intranet_note.md` for planned UI/UX improvements to the intranet/SharePoint integration.
