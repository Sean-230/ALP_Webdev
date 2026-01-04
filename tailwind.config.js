import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/livewire/flux/stubs/**/*.blade.php',
        './vendor/livewire/flux-pro/stubs/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    safelist: [
        {
            pattern: /^(bg|text|border|rounded|shadow|flex|grid|p|m|w|h|min|max|gap|space|items|justify|self|overflow|cursor|transition|duration|ease|opacity|z|top|bottom|left|right|inset|absolute|relative|fixed|sticky|block|inline|hidden|sr|hover|focus|active|disabled|data)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
