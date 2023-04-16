/*
 * Welcome to your app's main TS file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import 'flowbite';

import {createApp} from "vue";
import App from "./vue/App.vue";
import ModeSwitcher from "./vue/patterns/ModeSwitcher.vue";
import ImageSlider from "./vue/components/image-slider.vue";
import StickyBanner from "./vue/patterns/StickyBanner.vue";
import ServiceInfo from "./vue/components/service-info.vue";

const app = createApp({});

app.component('App', App);
app.component('ModeSwitcher', ModeSwitcher);
app.component('ImageSlider', ImageSlider);
app.component('StickyBanner', StickyBanner);
app.component('ServiceInfo', ServiceInfo);

app.mount('#app');
