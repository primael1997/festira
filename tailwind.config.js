import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#fdf3f4',
                    100: '#fbe0e3',
                    200: '#f7c5cb',
                    300: '#f09aa4',
                    400: '#e66575',
                    500: '#db3d50',
                    600: '#d12234',
                    700: '#b01a2a',
                    800: '#921926',
                    900: '#7a1a25',
                    950: '#43090f',
                },
                blush: {
                    50: '#fdf5f5',
                    100: '#fbe9e9',
                    200: '#f7d5d5',
                    300: '#f0bcbc',
                    400: '#e79a9a',
                },
                ink: '#323131',
            },
        },
    },

    plugins: [forms],
};
