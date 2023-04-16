<script setup lang="ts">
import BaseLayout from "./layout/BaseLayout.vue";
import StickyBanner from "./patterns/StickyBanner.vue";

</script>
<template>
  <BaseLayout>
    <template #header>
      <h1>Header</h1>
      <StickyBanner/>
    </template>
    <template #main>
    </template>
    <template #footer>
      <h1>Footer</h1>
    </template>
    <slot/>
  </BaseLayout>
</template>
<style lang="scss" scoped></style>