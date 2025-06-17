import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'icon-sm': '1rem',  // 16px
                'icon-base': '1.25rem', // 20px
                'icon-lg': '1.5rem', // 24px
            },
            spacing: {
                'icon-container-sm': '32px',
                'icon-container-base': '36px',
                'icon-container-lg': '44px',
            }
        },
    },

    plugins: [forms],
};
