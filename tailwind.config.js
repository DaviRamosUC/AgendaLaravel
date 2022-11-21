/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/index.blade.php",
    "./resources/js/components/*.{html,js,vue}",
    "./resources/**/*.{html,js,vue}",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
