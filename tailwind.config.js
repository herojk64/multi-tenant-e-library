/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'primary': '#03001C',
                'secondary': '#301E67',
                'light': '#5B8FB9',
                'light-1': '#B6EADA',
                'black':'#000',
                'white': '#ffffff',
                'red':'#d53d3d',
                'success':'#92e68b',
                'warning':'#d6be45',
            },
            fontFamily: {
                libre: ['"IBM Plex Serif"'],
                sans:['"IBM Plex Sans Thai Looped"']
            },
            fontSize: {
                sm: '0.8rem',
                base: '1.25rem',
                xl: '1.50rem',
                '2xl': '1.563rem',
                '3xl': '1.953rem',
                '4xl': '2.441rem',
                '5xl': '3.052rem',
            }
        },
    },
    plugins: [
        function({ addUtilities }) {
            addUtilities({
                '.custom-checkbox': {
                    'position': 'relative',
                    'cursor': 'pointer',
                    'appearance': 'none',
                    'outline': 'none',
                },
                '.custom-checkbox:checked': {
                    'background-color': '#your-light-color', // replace with your color
                },
                '.custom-checkbox:checked::after': {
                    'content': '""',
                    'position': 'absolute',
                    'top': '50%',
                    'left': '50%',
                    'transform': 'translate(-50%, -50%)',
                    'width': '0.5rem',
                    'height': '0.5rem',
                    'background-color': '#ffffff',
                    'border-radius': '50%', // use this for a radio button
                },
            });
        },
    ],
}
