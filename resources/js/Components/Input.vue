<template>
  <div :class="$attrs.class">
    <Label v-if="label" :value="label" :for="id" class="mb-1" />
    <div
      class="
        group
        w-full
        flex flex-wrap flex-row
        justify-between
        items-stretch
        space-x-1
        border border-gray-300
        rounded-md
        shadow-sm
        bg-white
        focus-within:border-blue-300
        focus-within:ring
        focus-within:ring-blue-200
        focus-within:ring-opacity-50
      "
      :class="{ 'border-red-600 ring ring-red-200 ring-opacity-50': error }"
    >
      <slot name="prepend"></slot>
      <input
        class="
          border-transparent
          rounded-md
          px-2
          py-2
          flex-grow
          focus:border-transparent focus:outline-none focus:ring-0
        "
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :type="type"
        :id="id"
        v-bind="filteredAttrs"
      />
      <slot name="append"></slot>
    </div>

    <InputError v-if="error" :message="error" />
  </div>
</template>

<script setup>
import Label from '@/Components/Label'
import InputError from '@/Components/InputError'
import uniqueId from 'lodash/uniqueId'
import { ref, computed, useAttrs } from 'vue'

const props = defineProps({
  id: {
    type: String,
    default() {
      return `text_input_${uniqueId()}`
    },
  },
  type: {
    type: String,
    default: 'text',
  },
  modelValue: [String, Number],
  label: String,
  error: String,
})

const attrs = useAttrs()

const input = ref(null)

function focus() {
  input.value.focus()
}

const filteredAttrs = computed(() => {
  const filteredAttrs = { ...attrs }
  delete filteredAttrs.class
  return filteredAttrs
})
</script>
