<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
    <FlashMessages />
    <div>
      <img :src="$page.props.logo" class="mx-8 h-40 w-auto" alt="logo" />
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>
  </div>
</template>

<script setup>
import FlashMessages from '@/Components/FlashMessages'
</script>
