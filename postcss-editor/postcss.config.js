module.exports = {
  plugins: [
    require('postcss-import'),
    require('@tailwindcss/postcss'),
    require('../postcss-remove-layers'),
    require('postcss-nesting'),
    process.env.NODE_ENV === 'production' ? require('cssnano') : false,
  ].filter(Boolean),
};
