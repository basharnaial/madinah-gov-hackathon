/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#fdf8f3',
          100: '#faf0e6',
          200: '#f4e0c9',
          300: '#ecc9a3',
          400: '#e1ac75',
          500: '#b99166', // Primary camel gold
          600: '#a67d55',
          700: '#8a6647',
          800: '#71543d',
          900: '#5d4633',
        },
        secondary: {
          50: '#fefdfa',
          100: '#fdfbf5',
          200: '#faf5e6',
          300: '#f5ecd3',
          400: '#eddfb5',
          500: '#e8d9bb', // Secondary light beige
          600: '#d4c19a',
          700: '#b8a47a',
          800: '#9a8763',
          900: '#7e6f52',
        },
        accent: {
          50: '#f0f9f4',
          100: '#dcf2e4',
          200: '#bce4cc',
          300: '#8dd1a8',
          400: '#56b57d',
          500: '#24784d', // Accent green
          600: '#1e5f3f',
          700: '#1a4b33',
          800: '#173d2b',
          900: '#143324',
        },
        muted: {
          50: '#f4f9f6',
          100: '#e8f3ed',
          200: '#d1e7db',
          300: '#aaccbd', // Muted mint green
          400: '#7db39a',
          500: '#5a9b7a',
          600: '#467d61',
          700: '#3a644f',
          800: '#315142',
          900: '#2a4338',
        }
      },
      fontFamily: {
        'sans': ['Inter', 'Nunito', 'system-ui', 'sans-serif'],
        'arabic': ['Noto Sans Arabic', 'Cairo', 'system-ui', 'sans-serif'],
      },
      direction: {
        'rtl': 'rtl',
        'ltr': 'ltr',
      }
    },
  },
  plugins: [],
} 