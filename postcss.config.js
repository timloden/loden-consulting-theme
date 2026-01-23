module.exports = {
  plugins: {
    'postcss-import': {},
    '@tailwindcss/postcss': {},
    'cssnano': process.env.NODE_ENV === 'production' ? {} : false,
  },
};
