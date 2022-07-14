<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap p-2">
      <template v-for="(link, key) in visibleLinks" :key="key">
        <div
          v-if="link.url === null"
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-500 border rounded"
          v-html="link.label"
        />
        <Link
          v-else
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            border
            rounded
            hover:bg-white
            focus:border-blue-600 focus:text-blue-600
          "
          :class="{ 'bg-blue-100 text-blue-600 border-blue-600': link.active }"
          :href="link.url"
          v-html="link.label"
          preserve-scroll
        />
      </template>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
  links: Array,
})

const visibleLinks = computed(() => {
  if (props.links.length <= 7) {
    return props.links
  }

  let activeLink = props.links.find((link) => link.active)

  let activeLinkIndex = props.links.indexOf(activeLink)

  let fakeLink = {
    url: null,
    active: false,
    label: '...',
  }

  if (
    activeLinkIndex == 0 ||
    activeLinkIndex == 1 ||
    activeLinkIndex == props.links.length - 1 ||
    activeLinkIndex == props.links.length - 2
  ) {
    return [
      props.links[0],
      props.links[1],
      fakeLink,
      props.links[props.links.length - 2],
      props.links[props.links.length - 1],
    ]
  }

  return [
    props.links[0],
    props.links[1],
    fakeLink,
    props.links[activeLinkIndex],
    fakeLink,
    props.links[props.links.length - 2],
    props.links[props.links.length - 1],
  ]
})
</script>
