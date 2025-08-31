// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        // ถ้าใช้ Filament theme:
        'resources/css/filament/admin/theme.css',
      ],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',
    manifest: true,
    emptyOutDir: true,
  },
  // ถ้ารำคาญ error overlay ระหว่าง dev (ไม่จำเป็น)
  // server: { hmr: { overlay: false } },
})