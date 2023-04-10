<script setup lang="ts">
import { withDefaults } from "vue";
import Testing from "./patterns/Testing.vue";

interface Props {
  name: string;
}
const props = withDefaults(defineProps<Props>(), {
  name: "World",
});
</script>

<template>
  <div>Hello {{ name }}!</div>
</template>

