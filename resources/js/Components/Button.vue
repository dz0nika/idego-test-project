<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      bg-white
      border border-gray-300
      rounded-md
      font-semibold
      text-xs
      uppercase
      hover:bg-gray-50
      active:bg-gray-50
      focus:outline-none
      transition
      ease-in-out
      duration-150
    "
  >
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'button',
  },
})
</script>

<style></style>
