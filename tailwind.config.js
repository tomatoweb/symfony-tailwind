/** @type {import('tailwindcss').Config} */

import withMT from "@material-tailwind/html/utils/withMT";

module.exports = {
  content: [
    "./templates/**/*.{html,twig}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    // ...
  ],
}

