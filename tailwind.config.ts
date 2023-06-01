/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./templates/**/*.html.twig', './assets/**/*.{vue,js,ts}', './node_modules/flowbite/**/*.js'],
  darkMode: 'class',
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
