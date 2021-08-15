module.exports = (isProd) => ({
    purge: {
        enabled: isProd,
        content: [
            "./app/**/*.php",
            "./resources/**/*.html",
            "./resources/**/*.php",
        ],
        options: {
            defaultExtractor: (content) =>
            content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    darkMode: 'class', // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                'dark-900'    : 'rgba(12,13,18,1)',
                'dark-800'    : 'rgba(18,20,28,1)',
                'dark-700'    : 'rgba(23,25,35,1)',
                'dark-600'    : 'rgba(37,42,55,1)',
                'red-base'    : '#ff2d20',
                'dark-normal' : 'rgba(181,181,189,1)',
                'dark-light'  : 'rgba(231,232,242,1)',
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
})