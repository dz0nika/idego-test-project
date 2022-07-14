<template>
  <div class="w-28">
    <Label v-show="showLabel" :value="label" />
    <Multiselect
      :canClear="false"
      v-model="modelValue"
      :options="options"
      @change="$emit('update:modelValue', $event)"
      noOptionsText="No options avaliable"
      noResultsText="No results avaliable"
    />
  </div>
</template>

<script setup>
import Label from '@/Components/Label'
import Multiselect from '@vueform/multiselect'

const props = defineProps({
  label: {
    type: String,
    default: () => {
      return 'Per Page'
    },
  },
  showLabel: {
    type: Boolean,
    default: false,
  },
  options: {
    type: Array,
    default: [10, 15, 20, 50],
  },
  modelValue: {
    type: [Number, String],
    required: true,
  },
})
</script>

<style></style>
