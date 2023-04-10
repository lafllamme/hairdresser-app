<script setup lang="ts">
import BaseLayout from "./layout/BaseLayout.vue";
import StickyBanner from "./patterns/StickyBanner.vue";
import ModeSwitcher from "./patterns/ModeSwitcher.vue";

</script>
<template>
  <BaseLayout>
    <template #header>
      <h1>Header</h1>
      <StickyBanner />
    </template>
    <template #main>
      <h1>Main</h1>
    </template>
    <template #footer>
      <h1>Footer</h1>
    </template>
    <slot />
  </BaseLayout>
</template>
<style lang="scss" scoped></style>