<template>
  <div>
    <button @click="toggleTheme" type="button"
            class="text-gray-500 dark:bg-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
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

<style lang="scss" scoped>
/*.peer:checked ~ .peer-checked\:after\:border-white::after {
  background-image: url("data:image/svg+xml,%3Csvg id='theme-toggle-light-icon' class='w-5 h-5' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z' fill-rule='evenodd' clip-rule='evenodd'%3E%3C/path%3E%3C/svg%3E");
}

.after\:content-\[\'\'\]::after {
  background-image: url("data:image/svg+xml,%3Csvg id='theme-toggle-dark-icon' class='w-5 h-5' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z'%3E%3C/path%3E%3C/svg%3E");
}*/
</style>