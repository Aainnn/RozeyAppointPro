import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        extend: {
            colors: {
                primary: {
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    DEFAULT: '#7c3aed',
                    600: '#6d28d9',
                    700: '#5b21b6',
                    800: '#4c1d95',
                    900: '#3a1570',
                },
                accent: {
                    DEFAULT: '#ec4899',
                    600: '#db2777',
                },
                neutral: {
                    DEFAULT: '#6b7280',
                    700: '#374151',
                },
                success: '#16a34a',
                danger: '#ef4444',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                lg: '0.75rem',
            },
            boxShadow: {
                md: '0 4px 14px rgba(31,41,55,0.08)',
            },
        },
    },

    plugins: [forms],
};
