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
        fontFamily: {
            // sans: ['Roboto', 'sans-serif'],
            sans: ['Open Sans', 'sans-serif'],
            condensed: ['Roboto Condensed', 'sans-serif'],
            script: ['Bad Script', 'cursive'],
            // especial fonts
            fjalla: ['Fjalla One', 'sans-serif'],
            raleway: ['Raleway', 'sans-serif'],
            miriam: ['Miriam Libre', 'sans-serif'],
        },
        extend: {
            boxShadow: {
                bottom: '5px 20px 20px -20px rgba(146, 161, 176, 0.15)',
            },
            colors: {
                'text-color' : '#697477',
                'text-light-color' : '#a0a7ac',
                'text-lighter-color' : '#c8cdd0',
                'title-color' : '#2a3b47',
                'border-color' : '#eff3f5',

                'dt-text-color' : '#c8cdd0',
                'dt-text-light-color' : '#a0a7ac',
                'dt-text-lighter-color' : '#697477',
                'dt-title-color' : '#eff3f5',

                'dt-dark': '#212e36',
                'dt-darker': '#192229',
                'dt-darkest': '#121a21',
                'dt-dark-black': '#0E1318',
                'dt-dark-accent': '#1b2831',
                'dt-light-accent': '#2a3b47',
                'dt-border-color' : '#2a3b47',

                // cool gray
                'gray': {
                    '50' : '#F9FAFB',
                    '100' : '#F3F4F6',
                    '150' : '#eff3f5', // custom
                    '200' : '#E5E7EB',
                    '300' : '#D1D5DB',
                    '400' : '#9CA3AF',
                    '500' : '#6B7280',
                    '600' : '#4B5563',
                    '700' : '#374151',
                    '800' : '#1F2937',
                    '900' : '#111827',
                },
                'teal': {
                    '50'  : '#F0FDFA',
                    '100' : '#CCFBF1',
                    '200' : '#99F6E4',
                    '300' : '#5EEAD4',
                    '400' : '#2DD4BF',
                    '500' : '#14B8A6',
                    '600' : '#0D9488',
                    '700' : '#0F766E',
                    '800' : '#115E59',
                    '900' : '#134E4A',
                },
                'cyan': {
                    '50'  : '#ECFEFF',
                    '100' : '#CFFAFE',
                    '200' : '#A5F3FC',
                    '300' : '#67E8F9',
                    '400' : '#22D3EE',
                    '500' : '#06B6D4',
                    '600' : '#0891B2',
                    '700' : '#0E7490',
                    '800' : '#155E75',
                    '900' : '#164E63',
                },
                'sky': {
                    '50'   : '#F0F9FF',
                    '100'  : '#E0F2FE',
                    '200'  : '#BAE6FD',
                    '300'  : '#7DD3FC',
                    '400'  : '#38BDF8',
                    '500'  : '#0EA5E9',
                    '600'  : '#0284C7',
                    '700'  : '#0369A1',
                    '800'  : '#075985',
                    '900'  : '#0C4A6E',
                },
                'rose': {
                    '50': '#FFF1F2',
                    '100': '#FFE4E6',
                    '200': '#FECDD3',
                    '300': '#FDA4AF',
                    '400': '#FB7185',
                    '500': '#F43F5E',
                    '600': '#E11D48',
                    '700': '#BE123C',
                    '800': '#9F1239',
                    '900': '#881337',
                },
                'edgray': {
                    '100': '#fbfbfe',
                    '200': '#fcfcfc',
                    '300': '#eff3f5',
                    '400': '#c8cdd0',
                    '500': '#a0a7ac',
                    '600': '#697477',
                    '700': '#2a3b47',
                    '800': '#22303a',
                    '900': '#1a252d',
                },
                'edblue' : {
                    '100': '#e7f4fd',
                    '200': '#b7defa',
                    '300': '#88c8f7',
                    '400': '#58b3f3',
                    '500': '#1192ee',
                    '600': '#1083d5',
                    '700': '#0c66a6',
                    '800': '#094977',
                    '900': '#052c48',
                },
                'edyellow' : {
                    '100': '#fff8eb',
                    '200': '#ffeac7',
                    '300': '#ffdb9e',
                    '400': '#ffce7a',
                    '500': '#ffba42',
                    '600': '#e5a638',
                    '700': '#b4822d',
                    '800': '#7e5c20',
                    '900': '#4e3813',
                },
            },
            fontSize: {
                'xxxs': '.65rem',
                'xxs': '.75rem',
                'xs': '.8125rem',
                'sm': '.875rem',
                'normal': '0.9375rem',
                'base': '1rem',
            },
        },
    },
    // variants: {
    //     extend: {
    //       boxShadow: ['dark']
    //     },
    // },
    plugins: [
        require("tailwindcss-autofill"),
        require("tailwindcss-text-fill"),
        require("tailwindcss-shadow-fill"),
    ],
    variants: {
        extend: {
            boxShadow: ['dark'],
            borderColor: ["autofill", "dark"],
            shadowFill: ["autofill", "dark"], // Enable variants.
            textFill: ["autofill", "dark"], // Enable variants.
        },
    },
})