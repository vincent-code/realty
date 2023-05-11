import { Carousel } from "../../node_modules/@fancyapps/ui/dist/carousel/carousel.esm.js";
import { Thumbs } from "../../node_modules/@fancyapps/ui/dist/carousel/carousel.thumbs.esm.js";

const container = document.getElementById("complex-carousel");
const options = {
    infinite: true,
    Thumbs: {
        type: "classic",
    },
};

new Carousel(container, options, { Thumbs });
