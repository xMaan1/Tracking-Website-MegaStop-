import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Generate manifest.json in outDir
        manifest: true,
        // Make sure assets are compatible with older browsers
        target: 'es2018',
        // Reduce chunk size for better loading
        chunkSizeWarningLimit: 1000,
        // Ensure CSS gets properly extracted and minified
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                // Clean up large chunks
                manualChunks: (id) => {
                    if (id.includes('node_modules')) {
                        if (id.includes('chart.js')) {
                            return 'chart';
                        }
                        if (id.includes('alpinejs')) {
                            return 'alpine';
                        }
                        return 'vendor';
                    }
                }
            }
        },
        // Minify for production
        minify: 'terser',
        // Make paths relative for shared hosting
        assetsDir: 'assets',
        outDir: 'public/build',
        emptyOutDir: true
    },
    // Make sure we have proper HMR in development
    server: {
        hmr: {
            host: 'localhost'
        }
    }
});
