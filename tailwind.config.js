/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./*.php",
        "./components/**/*.php",
        "./admin/**/*.php",
        "./assets/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                paper: "var(--bg-primary)",
                accent: {
                    blue: "var(--color-accent-blue)",
                    pink: "var(--color-accent-pink)",
                    yellow: "var(--color-accent-yellow)",
                },
                ink: "var(--color-text-dark)",
            },
            boxShadow: {
                "brutal-sm": "var(--shadow-solid-sm)",
                "brutal-md": "var(--shadow-solid-md)",
                "brutal-lg": "var(--shadow-solid-lg)",
            },
            fontFamily: {
                marker: ['"Permanent Marker"', "cursive"],
                mono: ['"Space Mono"', "monospace"],
                handwriting: ['"Caveat"', "cursive"],
                sans: ['"Inter"', "sans-serif"],
            },
        },
    },
    plugins: [],
}