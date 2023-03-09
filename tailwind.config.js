/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // './assets/styles/**/*.css',
    './assets/**/*.{vue,js,ts,jsx,tsx,css}',
    './templates/**/*.{html,twig}',
    // './templates/*.{html, twig}',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    // require('@tailwindcss/forms'),
  ],
};