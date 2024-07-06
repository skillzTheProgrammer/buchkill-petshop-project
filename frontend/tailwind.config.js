/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        primary: '#4EC690',
        primaryDark: '#2DB479',
        primaryLight: '#EDF5F1',
        footerBG: '#EDF5F1',
        appGrey: '#0000008A',
        appBlue: '#1976D2',
      },
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      },
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem' }],
        sm: ['14px', { lineHeight: '24px' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
      },
    },
  },
  plugins: [require('@tailwindcss/forms')],
}
