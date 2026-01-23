# Loden Consulting Theme

A modern WordPress theme built with Tailwind CSS v4, ACF blocks support, WooCommerce compatibility, and performance optimizations.

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
│   │   ├── theme-header.css     # WordPress theme header
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
├── theme.json                   # Block editor configuration
├── package.json                 # npm configuration
└── postcss.config.js            # PostCSS configuration
```

## Features

### Tailwind CSS v4

The theme uses Tailwind CSS v4 with the `@tailwindcss/postcss` plugin. Custom theme tokens are defined in `src/css/app.css` using the `@theme` directive:

```css
@theme {
  --color-primary: #2563eb;
  --color-primary-dark: #1d4ed8;
  --color-secondary: #64748b;
  --color-accent: #f59e0b;
}
```

The `@tailwindcss/typography` plugin is included for prose styling.

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

### Theme Colors

Update the color variables in:

1. `src/css/app.css` - Tailwind theme tokens
2. `src/css/editor.css` - Editor theme tokens (keep in sync)
3. `theme.json` - Block editor color palette

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
