const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Http/Livewire/**/*.php',
        './app/Filament/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.blue,
                secondary: colors.gray,
                accent: colors.teal,
                neutral: colors.gray,
                info: colors.sky,
                success: colors.green,
                warning: colors.yellow,
                danger: colors.red,
                // Светлая тема
                'base-100': '#FFFFFF',
                'base-content': '#1F2937',
                // Темная тема
                'dark-base-100': '#111827',
                'dark-base-content': '#D1D5DB',
            },
            fontWeight: {
                'extralight': 200,
                'light': 300,
                'normal': 400,
                'medium': 500,
                'semibold': 600,
                'bold': 700,
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};