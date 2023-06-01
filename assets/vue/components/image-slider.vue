<template>

  <div id="gallery" class="relative w-full mb-6" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
      <!-- Item 1 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://media.glamourmagazine.co.uk/photos/63b6e672543f9ea0cca5f090/2:3/w_1280,h_1920,c_limit/HAIRSTYLE%20IDEAS%20050123%20default-sq.jpg"
             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
             alt="">
      </div>
      <!-- Item 2 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
        <img src="https://media.glamourmagazine.co.uk/photos/63b6e672543f9ea0cca5f090/2:3/w_1280,h_1920,c_limit/HAIRSTYLE%20IDEAS%20050123%20default-sq.jpg"
             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
             alt="">
      </div>
      <!-- Item 3 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://media.glamourmagazine.co.uk/photos/63b6e672543f9ea0cca5f090/2:3/w_1280,h_1920,c_limit/HAIRSTYLE%20IDEAS%20050123%20default-sq.jpg"
             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
             alt="">
      </div>
      <!-- Item 4 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://media.glamourmagazine.co.uk/photos/63b6e672543f9ea0cca5f090/2:3/w_1280,h_1920,c_limit/HAIRSTYLE%20IDEAS%20050123%20default-sq.jpg"
             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
             alt="">
      </div>
      <!-- Item 5 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://media.glamourmagazine.co.uk/photos/63b6e672543f9ea0cca5f090/2:3/w_1280,h_1920,c_limit/HAIRSTYLE%20IDEAS%20050123%20default-sq.jpg"
             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
             alt="">
      </div>
    </div>
    <!-- Slider controls -->
    <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
  </div>

</template>
<script setup lang="ts">

import {onMounted} from "vue";

/*
const sleep = async (ms: number) => new Promise(resolve => setTimeout(resolve, ms));

await sleep(1000);
*/




</script>
<style lang="scss" scoped>
/*.fast-gradient {
  background: linear-gradient(
          to right,
          rgba(255, 255, 255, 0.1),
          rgba(255, 255, 255, 0.4)
  );
  background-size: 200% 200%;
  animation: gradient 2s ease-in-out infinite;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}*/
</style>
