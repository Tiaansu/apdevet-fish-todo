/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./*.{html,js,php}'],
    theme: {
        extend: {
            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
                brand: {
                    50: '#f0f8ff',
                    100: '#e0effe',
                    200: '#bbe0fc',
                    300: '#7fc7fa',
                    400: '#3bacf5',
                    500: '#1191e6',
                    600: '#0579d0',
                    700: '#055a9f',
                    800: '#094d83',
                    900: '#0d426d',
                    950: '#092948',
                },
            },
        },
    },
    prefix: 'tw-',
    plugins: [],
    corePlugins: {
        preflight: false,
    },
};
