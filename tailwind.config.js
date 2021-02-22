module.exports = {
    purge: [
        './resources/js/app.js',
        './resources/views/**/*.blade.php',
    ],
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
