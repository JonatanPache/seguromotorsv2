const { Container } = require('postcss');
const defaultTheme = require('tailwindcss/defaultTheme');
const colors=require("tailwindcss/colors");
/** @type {import('tailwindcss').Config} */
module.exports = {

    presets: [
        ...
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        fontFamily:{
            primary:"Open Sans",
            body:"Ubuntu"
        },
        container:{
            padding:{
                DEFAULT:"1rem",
                lg:"3rem"
            }
        },
        extend:{
            colors:{
                "light-primary":"#FFFFFF",
                "light-secondary":"#E9F1FA",
                "light-tail-100":"#F9B872",
                "light-tail-500":"#001233",
                "dark-primary":"#2C3639",
                "dark-secondary":"#3F4E4F",
                "dark-navy-500":"#A27B5C",
                "dark-navy-100":"#DCD7C9",
                blue:colors.blue,
                indigo:colors.indigo,
                green:colors.green,
                red:colors.red,
                paragraph:"#878e99",
                accent:{
                    DEFAULT:"#ac6b34",
                    hover:"#925a2b"
                }
            }
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
