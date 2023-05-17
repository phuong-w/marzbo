/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    prefix: 'tw-',
    theme: {
        extend: {},
    },
    important: true,
    corePlugins: {
        preflight: false,
    },
    plugins: []
}

