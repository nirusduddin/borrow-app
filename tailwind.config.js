// tailwind.config.js
import preset from './vendor/filament/filament/tailwind.config.preset.js'
// บางโปรเจกต์ใช้ path นี้:
// import preset from './vendor/filament/support/tailwind.config.preset.js'

export default {
  presets: [preset],
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.ts',
    './app/Filament/**/*.php',
    './vendor/filament/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Kanit', 'system-ui', 'ui-sans-serif', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans Thai', 'sans-serif'],
      },
    },
  },
  plugins: [],
}