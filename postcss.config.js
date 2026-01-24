const themeHeader = `/*
Theme Name: Loden Consulting
Theme URI: https://lodenconsulting.com
Author: Loden Consulting
Author URI: https://lodenconsulting.com
Description: A modern WordPress theme with Tailwind CSS v4, ACF blocks, and WooCommerce support.
Version: 1.0.0
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: loden-consulting
*/`;

module.exports = {
  plugins: {
    'postcss-import': {},
    '@tailwindcss/postcss': {},
    'postcss-header': { header: themeHeader },
    'cssnano': process.env.NODE_ENV === 'production' ? {} : false,
  },
};
