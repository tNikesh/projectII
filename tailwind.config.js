/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#fffaf1',
        secondary: '#d6c4ae',
      },
      dropShadow:{
        'video-card': '1px 3px 2px #B0ACB5',
      },
    },
  },
  plugins: []
}

