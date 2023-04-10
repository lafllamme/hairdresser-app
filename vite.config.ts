import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import vue from "@vitejs/plugin-vue";
/* if you're using React */
// import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        /* react(), // if you're using React */
        symfonyPlugin(),
        vue(), // write this
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        }
    },
    build: {
        rollupOptions: {
            input: {
                app: "./assets/app.ts",
                /* you can also provide css files to prevent FOUC */
                styles: "./assets/styles/app.css"
            },
        }
    },
});
