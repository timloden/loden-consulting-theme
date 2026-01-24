# Loden Consulting Theme

A modern WordPress theme built with Tailwind CSS v4, daisyUI components, ACF blocks support, WooCommerce compatibility, and performance optimizations.

## Requirements

- WordPress 6.0+
- PHP 8.0+
- Node.js 18+ (for development)
- npm 9+ (for development)

## Installation

1. Download or clone the theme to your `wp-content/themes/` directory
2. Activate the theme in WordPress Admin > Appearance > Themes

For development, continue with the setup steps below.

## Development Setup

1. Navigate to the theme directory:
   ```bash
   cd wp-content/themes/loden-consulting-theme
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Build assets:
   ```bash
   npm run build
   ```

## Build Commands

| Command | Description |
|---------|-------------|
| `npm run build` | Build all assets for production |
| `npm run build:js` | Build JavaScript only |
| `npm run build:css` | Build CSS only |
| `npm run start` | Watch mode for development (JS + CSS) |
| `npm run start:js` | Watch mode for JavaScript only |
| `npm run start:css` | Watch mode for CSS only |
| `npm run lint:js` | Lint JavaScript files |
| `npm run lint:css` | Lint CSS files |

## Directory Structure

```
loden-consulting-theme/
├── acf-json/                    # ACF field group JSON sync
├── blocks/                      # ACF blocks
│   └── example-block/
│       ├── block.json           # Block configuration
│       └── render.php           # Block template
├── inc/                         # PHP includes
│   ├── acf-blocks.php           # ACF block registration
│   ├── assets.php               # Script/style enqueuing
│   ├── performance.php          # Performance optimizations
│   ├── svg-support.php          # SVG upload handling
│   ├── template-functions.php   # Template helper functions
│   ├── template-tags.php        # Template tags
│   └── woocommerce.php          # WooCommerce support
├── js/                          # Compiled JS (tracked in git)
├── src/
│   ├── css/
│   │   ├── app.css              # Main Tailwind entry point
│   │   ├── editor.css           # Editor-specific styles
│   │   ├── config.css           # Shared design tokens (colors, typography, etc.)
│   │   └── custom/
│   │       ├── base.css         # Base/reset styles
│   │       ├── utilities.css    # Custom utilities
│   │       └── components/
│   │           └── woocommerce.css
│   └── js/
│       ├── frontend.js          # Main frontend script
│       └── block-editor.js      # Block editor customizations
├── template-parts/              # Reusable template parts
│   ├── content/
│   ├── header/
│   └── footer/
├── woocommerce/                 # WooCommerce template overrides
├── functions.php                # Main functions file
├── style.css                    # Compiled styles (tracked in git)
├── style-editor.css             # Compiled editor styles
├── package.json                 # npm configuration
├── postcss.config.js            # PostCSS configuration (includes WP theme header)
└── postcss.editor.config.js     # PostCSS configuration for editor styles
```

## Features

### Tailwind CSS v4

The theme uses Tailwind CSS v4 with the `@tailwindcss/postcss` plugin. Design tokens are centralized in `src/css/config.css` using the `@theme` directive:

```css
@theme {
  /* Colors */
  --color-primary: #2563eb;
  --color-primary-dark: #1d4ed8;
  --color-secondary: #64748b;
  --color-accent: #f59e0b;

  /* Typography */
  --font-sans: ui-sans-serif, system-ui, sans-serif, ...;

  /* Spacing, Layout, etc. */
  --container-padding: 1rem;
  --section-spacing: 4rem;
}
```

This config file is imported by both `app.css` and `editor.css` to keep frontend and editor styles in sync. The `@tailwindcss/typography` plugin is included for prose styling.

**Note:** WordPress global styles (`global-styles-inline-css`) are disabled to prevent conflicts with Tailwind. All styling is managed through Tailwind utilities and the config file.

### daisyUI Components

[daisyUI](https://daisyui.com/) is included as a component library built on Tailwind CSS. It provides pre-styled, customizable components.

**Available components include:**
- Buttons, badges, cards, alerts
- Modals, drawers, dropdowns
- Forms, inputs, selects
- Navigation, tabs, breadcrumbs
- And many more...

**Example usage in PHP templates:**

```php
<!-- Button -->
<button class="btn btn-primary">Click me</button>

<!-- Card -->
<div class="card bg-base-100 shadow-xl">
  <div class="card-body">
    <h2 class="card-title">Card Title</h2>
    <p>Card content goes here.</p>
    <div class="card-actions justify-end">
      <button class="btn btn-primary">Action</button>
    </div>
  </div>
</div>

<!-- Modal -->
<button class="btn" onclick="openModal('my-modal')">Open Modal</button>
<dialog id="my-modal" class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Hello!</h3>
    <p class="py-4">Modal content here.</p>
    <div class="modal-action">
      <button class="btn" onclick="closeModal('my-modal')">Close</button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
```

**JavaScript helpers available globally:**
- `openModal(id)` / `closeModal(id)` - Control modal dialogs
- `openDrawer(id)` / `closeDrawer(id)` / `toggleDrawer(id)` - Control drawers
- `toggleTheme()` / `setTheme('light'|'dark')` - Theme switching

**Theme customization:**

daisyUI theme colors are configured in `src/css/config.css` to match your brand colors. Light and dark themes are enabled by default.

See [daisyUI documentation](https://daisyui.com/components/) for all available components.

### ACF Blocks

Blocks are auto-registered from the `blocks/` directory. Each block needs:

- `block.json` - Block configuration
- `render.php` - Block template

Optional:
- `style.css` - Block-specific styles
- `script.js` - Block-specific JavaScript

ACF field groups are synced via JSON in the `acf-json/` directory.

To create a new block:

1. Create a new directory in `blocks/` (e.g., `blocks/my-block/`)
2. Add `block.json` with block configuration
3. Add `render.php` with the block template
4. Create ACF field group and assign to the block

### WooCommerce Support

The theme includes WooCommerce compatibility with:

- Product gallery features (zoom, lightbox, slider)
- Custom wrapper markup
- Cart fragments for AJAX updates
- Styled components in `src/css/custom/components/woocommerce.css`

WooCommerce template overrides can be placed in the `woocommerce/` directory.

### Performance Optimizations

Built-in optimizations include:

- WordPress global styles removal (prevents Tailwind conflicts)
- Emoji script removal
- jQuery Migrate removal on frontend
- Unnecessary meta tag cleanup (RSD, WLW, shortlink, generator)
- Native lazy loading for images
- High-priority fetch for featured images
- Heartbeat API optimization
- Dashicons removal for non-logged-in users
- Self-pingback prevention
- XML-RPC disabled

### SVG Support

SVG uploads are enabled with security sanitization:

- Removes potentially dangerous elements (script, foreignObject, etc.)
- Strips event handler attributes
- Removes javascript: URLs
- Displays SVG thumbnails in media library

## Customization

### Adding Custom Styles

Add custom CSS to the appropriate file in `src/css/custom/`:

- `base.css` - Base/reset styles
- `utilities.css` - Custom utility classes
- `components/` - Component-specific styles

### Adding Custom JavaScript

Edit `src/js/frontend.js` for frontend functionality or `src/js/block-editor.js` for editor customizations.

### Design Tokens (Colors, Typography, Spacing)

All design tokens are defined in `src/css/config.css`. This single file controls:

- Colors (primary, secondary, accent, semantic colors)
- Typography (font families, sizes)
- Spacing (container padding, section spacing)
- Layout (container widths, content width)
- Borders & radius
- Shadows
- Transitions

Both `app.css` and `editor.css` import this file, so changes are automatically reflected in both frontend and block editor.

### Navigation Menus

Two menu locations are registered:

- `primary` - Main navigation in header
- `footer` - Footer navigation

### Widget Areas

Four widget areas are available:

- `sidebar-1` - Main sidebar
- `footer-1` - Footer column 1
- `footer-2` - Footer column 2
- `footer-3` - Footer column 3

## License

GPL-2.0-or-later
