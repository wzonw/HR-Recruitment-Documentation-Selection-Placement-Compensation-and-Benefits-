import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "inter": ['Inter', 'sans-serif'],
                "markazi": ['Markazi Text', 'sans'],
            },
            
            fontSize: {
                '3.5xl': ['32px', '32px'],
            },
            height: {
                '17': '70px',
                '18': '72px',

            },
            width:{
                '22': '92px',
                '38': '151px',
                '88': '345px',
                '90': '350px',
            },
            colors: {
                'gold': '#C9AE5D',
                'gold-100': '#AB830F',
                'gold-200': '#97740D',
                'yellow-550': '#e3b10b',
                'indigo-650': '#4F74BB',
                'blue-850': '#2D349A',
            },
        },
    },

    plugins: [forms, typography],
};
