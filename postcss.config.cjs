//export default {
//plugins: {
//tailwindcss: {},
//autoprefixer: {},
//},
//};

// postcss.config.cjs
module.exports = {
    plugins: [
        require('@tailwindcss/postcss'),
        require('autoprefixer'),
    ],
};