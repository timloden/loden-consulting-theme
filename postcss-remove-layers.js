/**
 * PostCSS plugin: postcss-editor-compat
 *
 * Strips CSS features that WordPress's add_editor_style() JS PostCSS parser
 * cannot handle:
 *   - @layer at-rules (unwraps contents, removes bare declarations)
 *   - @property at-rules (removed entirely)
 *
 * This allows Tailwind CSS v4 compiled output to be loaded via the standard
 * add_editor_style() WordPress API.
 */
const editorCompatPlugin = () => ({
  postcssPlugin: 'postcss-editor-compat',
  OnceExit(root) {
    // Remove all @property declarations.
    root.walkAtRules('property', (atRule) => {
      atRule.remove();
    });

    // Unwrap all @layer blocks (keep contents, remove wrapper).
    // walkAtRules visits pre-order, so nested @layer need repeated passes.
    let found = true;
    while (found) {
      found = false;
      root.walkAtRules('layer', (atRule) => {
        found = true;
        if (atRule.nodes && atRule.nodes.length) {
          atRule.replaceWith(atRule.nodes);
        } else {
          atRule.remove();
        }
      });
    }
  },
});

editorCompatPlugin.postcss = true;
module.exports = editorCompatPlugin;
