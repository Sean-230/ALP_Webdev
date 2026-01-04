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
        // Force generate common Flux classes
        'flex', 'inline-flex', 'grid', 'block', 'inline-block', 'hidden',
        'min-h-screen', 'min-h-svh', 'h-full', 'w-full', 'max-w-sm', 'max-w-md',
        'bg-white', 'bg-zinc-50', 'bg-zinc-100', 'bg-zinc-800', 'bg-zinc-900',
        'text-zinc-500', 'text-zinc-600', 'text-zinc-700', 'text-zinc-800', 'text-zinc-900',
        'text-white', 'text-sm', 'text-base', 'text-lg', 'text-xl', 'text-2xl',
        'rounded', 'rounded-md', 'rounded-lg', 'rounded-full',
        'border', 'border-zinc-200', 'border-zinc-300', 'border-white/10',
        'shadow', 'shadow-sm', 'shadow-md', 'shadow-lg', 'shadow-xl',
        'p-2', 'p-3', 'p-4', 'p-6', 'px-3', 'px-4', 'py-2', 'py-3',
        'm-0', 'mt-2', 'mt-3', 'mb-2', 'mb-3', 'gap-2', 'gap-3', 'gap-6',
        'items-center', 'justify-center', 'justify-between', 'flex-col',
        'space-y-2', 'space-y-3', 'space-y-6',
        'hover:bg-zinc-100', 'focus:ring-2', 'focus:outline-none',
        'dark:bg-zinc-800', 'dark:bg-zinc-900', 'dark:text-white', 'dark:text-zinc-300',
        'dark:border-white/10', 'dark:bg-white/10', 'antialiased',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
