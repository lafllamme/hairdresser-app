<template>
  <div>
    <button @click="toggleTheme" type="button"
            class="text-gray-500 dark:bg-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">

      <component :is="themeIcon"/>
    </button>
  </div>
</template>
<script setup lang="ts">
import {computed, ref} from "vue";
import LightmodeIcon from "./icons/svgs/lightmode-icon.vue";
import DarkmodeIcon from "./icons/svgs/darkmode-icon.vue";

const toggleDarkMode = ref<boolean>(false);
const toggleLightMode = ref<boolean>(false);

const themeIcon = computed(() => {
  if (toggleDarkMode.value) {
    return DarkmodeIcon;
  } else if (toggleLightMode.value) {
    return LightmodeIcon;
  }
});

//change the icons inside the buttons based on previous settings
if (localStorage.getItem('color-theme') === 'dark'
    || !localStorage.getItem('color-theme')
    && window.matchMedia('(prefers-color-scheme: dark').matches) {
  toggleDarkMode.value = true;
} else {
  toggleLightMode.value = true;
}

const toggleModes = () => {
  toggleDarkMode.value = !toggleDarkMode.value;
  toggleLightMode.value = !toggleLightMode.value;
}

/**
 * This script changes the icon inside the button based on previous preferences and
 * also handles the click events by setting the dark mode preference using local storage and
 * also adding or removing the dark class from the main <html> tag.
 * @returns void
 */
const toggleTheme = () => {
  //check if in local storage previously
  if (localStorage.getItem('color-theme')) {
    //if set, check for light or dark mode and set props
    if (localStorage.getItem('color-theme') === 'light') {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
      toggleModes();
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
      toggleModes();
    }
  }

  //if not set previously
  else {
    if (document.documentElement.classList.contains('dark')) {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    } else {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    }
  }
  console.log(toggleLightMode.value, 'light mode');
  console.log(toggleDarkMode.value, 'dark mode');
}
</script>