/**
 * Block Editor JavaScript
 *
 * Customizations for the WordPress block editor.
 */

import { registerBlockStyle, unregisterBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

/**
 * Register custom block styles
 */
domReady(() => {
  // Button block styles
  registerBlockStyle('core/button', {
    name: 'primary',
    label: 'Primary',
  });

  registerBlockStyle('core/button', {
    name: 'secondary',
    label: 'Secondary',
  });

  registerBlockStyle('core/button', {
    name: 'outline',
    label: 'Outline',
  });

  // Remove default button styles if desired
  // unregisterBlockStyle('core/button', 'fill');
  // unregisterBlockStyle('core/button', 'outline');

  // Image block styles
  registerBlockStyle('core/image', {
    name: 'rounded',
    label: 'Rounded',
  });

  registerBlockStyle('core/image', {
    name: 'shadow',
    label: 'Shadow',
  });

  // Group block styles
  registerBlockStyle('core/group', {
    name: 'card',
    label: 'Card',
  });

  registerBlockStyle('core/group', {
    name: 'bordered',
    label: 'Bordered',
  });

  // Heading block styles
  registerBlockStyle('core/heading', {
    name: 'underlined',
    label: 'Underlined',
  });

  // Quote block styles
  registerBlockStyle('core/quote', {
    name: 'large',
    label: 'Large',
  });

  // List block styles
  registerBlockStyle('core/list', {
    name: 'checklist',
    label: 'Checklist',
  });

  registerBlockStyle('core/list', {
    name: 'no-markers',
    label: 'No Markers',
  });

  // Separator block styles
  registerBlockStyle('core/separator', {
    name: 'thick',
    label: 'Thick',
  });

  // Table block styles
  registerBlockStyle('core/table', {
    name: 'striped',
    label: 'Striped',
  });
});

/**
 * Custom block variations could be added here
 *
 * Example:
 * import { registerBlockVariation } from '@wordpress/blocks';
 *
 * registerBlockVariation('core/columns', {
 *   name: 'two-columns-wide-right',
 *   title: 'Two Columns: Wide Right',
 *   innerBlocks: [
 *     ['core/column', { width: '33.33%' }],
 *     ['core/column', { width: '66.66%' }],
 *   ],
 *   scope: ['block'],
 * });
 */

/**
 * Filter block settings if needed
 *
 * Example: Modify default attributes
 * import { addFilter } from '@wordpress/hooks';
 *
 * addFilter(
 *   'blocks.registerBlockType',
 *   'loden-consulting/modify-block-defaults',
 *   (settings, name) => {
 *     if (name === 'core/paragraph') {
 *       return {
 *         ...settings,
 *         attributes: {
 *           ...settings.attributes,
 *           // Custom default attributes
 *         },
 *       };
 *     }
 *     return settings;
 *   }
 * );
 */
