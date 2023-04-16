/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./templates/**/*.html.twig', './assets/**/*.{vue,js,ts}'],
  darkMode: 'class',
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
