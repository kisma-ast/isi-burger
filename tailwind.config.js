import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#0f172a", // Bleu nuit futuriste
                secondary: "#14b8a6", // Turquoise néon
                accent: "#facc15", // Jaune lumineux
            },
            backgroundImage: {
                'glass': "linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05))",
            },
            backdropBlur: {
                xs: "2px",
            },
        },
    },

    plugins: [forms],
};
