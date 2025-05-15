/* @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{php,html,js}", // Scan all subdirectories correctly
    "./template-parts/**/*.{php,html,js}",
    "./blocks/**/*.{php,html,js}",
    "./woocommerce/**/*.{php,html,js}",
    "./BicBlock/**/*.{php,html,js}"
  ],
  theme: {
    extend: { 
      fontFamily: {
        Poppins: ['Poppins', 'sans-serif'],
      },
      colors: {
        'primary': '#FB0404',
        'light-red': '#fb04040d',
        'black': '#080404',
      },
      fontSize: {
        h1: '36px',
        h2: '36px',
        h3: '30px',
        h4: '24px',
        h5: '18px',
        h6: '18px',
        p: '18px',
        'p-small': '14px',
      },
      container: {
        center: true, // Keep the container centered
        padding: '50px', // Set left & right padding to 50px
        screens: {
          DEFAULT: '1440px', // Force the container width to 124px
        },
      },

      maxWidth:{
      }
    },
  },
  plugins: []
};
