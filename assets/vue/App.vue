<script setup lang="ts">
import BaseLayout from "./layout/BaseLayout.vue";
import StickyBanner from "./patterns/StickyBanner.vue";
import ImageSlider from "./components/image-slider.vue";
import BottomMenu from "./components/bottom-menu.vue";
import NavigationBar from "./components/navigation-bar.vue";
import MasonryGallery from "./components/masonry-gallery.vue";
</script>
<template>
  <BaseLayout>
    <template #header>
      <StickyBanner />
      <NavigationBar />
    </template>
    <template #main>
      <Suspense>
        <ImageSlider />
        <template #fallback>
          <ImagePlaceholder />
        </template>
      </Suspense>
      <MasonryGallery />
    </template>
    <template #footer>
      <BottomMenu />
    </template>
    <slot/>
  </BaseLayout>
</template>
<style lang="scss" scoped></style>