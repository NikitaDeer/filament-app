import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography'
import colors from 'tailwindcss/colors' 

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.violet,
                success: colors.green,
                warning: colors.yellow,
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms, 
        typography, 
        ],
};
