<script setup lang="ts">
import MyComponent from "./MyComponent.vue";
import { ref } from "vue";

interface Naming extends Promise<any>{
  title?: string;
}
const name = ref<string>("")
const fetchName: Naming = fetch("https://jsonplaceholder.typicode.com/todos/1")
    .then((response) => response.json())
    .then((json) => {
      console.log(json);
      name.value = json.title
      return json
    })


</script>

<template>
  <div>
    <h1 class="text-3xl font-bold underline">My Vue App</h1>
    <my-component :name="name" />
  </div>
</template>


