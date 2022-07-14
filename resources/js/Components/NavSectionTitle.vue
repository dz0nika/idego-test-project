<template>
  <div
    class="ml-3 mr-4 py-2 text-sm uppercase text-blue-400 border-b border-blue-200 text-center"
  >
    {{ title }}
  </div>
</template>

<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
})
</script>

<style></style>
