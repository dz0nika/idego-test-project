<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white shadow rounded">
      <Dropdown
        v-show="!searchOnly"
        align="left"
        width="80"
        contentClasses="mt-2 px-4 py-6 w-full bg-white rounded"
        :autoClose="false"
      >
        <template #trigger>
          <div class="flex items-center h-full px-4 rounded-l border-r">
            <span class="text-gray-700 hidden md:inline">
                Filter
            </span>
            <Icon name="cheveron-down" class="h-4 w-4 fill-gray-700" />
          </div>
        </template>
        <template #content>
          <slot />
        </template>
      </Dropdown>
      <input
        class="
          relative
          w-full
          px-2
          border border-gray-300
          rounded-r
          focus:border-blue-300
          focus:outline-none
          focus:ring
          focus:ring-blue-200
          focus:ring-opacity-50
        "
        :class="{ 'rounded-l': searchOnly }"
        autocomplete="off"
        type="text"
        name="search"
        :placeholder="searchPlaceholder"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
      />
    </div>
    <button
      class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-gray-700"
      type="button"
      @click="$emit('reset')"
    >
      Reset
    </button>
  </div>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown'
import Icon from '@/Components/Icon'

const props = defineProps({
  modelValue: String,
  searchOnly: {
    type: Boolean,
    default: false,
  },
  searchPlaceholder: {
    type: String,
    default: () => {
      return 'Search'
    },
  },
})
</script>
