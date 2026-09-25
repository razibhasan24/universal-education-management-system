import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
<<<<<<< HEAD
    darkMode: 'class',  // ⭐ এই লাইনটি যোগ করুন
=======
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
<<<<<<< HEAD
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Hind Siliguri', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                }
            }
        },
    },
=======

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    plugins: [forms],
};
