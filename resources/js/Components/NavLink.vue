<template>
  <Link
    class="
      block
      pl-3
      pr-4
      py-2
      border-l-4 border-transparent
      text-base
      font-semibold
      text-blue-700
      hover:bg-blue-50 hover:text-blue-600 hover:border-blue-600
    "
    :class="{ 'bg-blue-100 md:bg-blue-100 text-blue-600 border-blue-600': active }"
  >
    <slot />
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  active: Boolean,
})
</script>
<style></style>
