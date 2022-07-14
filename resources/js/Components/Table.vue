<template>
  <div class="bg-white rounded-md shadow">
    <slot name="toolbar"> </slot>
    <table class="border-collapse w-full">
      <thead>
        <tr class="font-bold text-left">
          <slot name="header">
            <th
              v-for="(header, index) in tableHeaders"
              :key="index"
              class="px-6 pt-6 pb-4 font-bold hidden lg:table-cell"
            >
              <slot :name="`header.${header.value}`" :header="header">
                <span>{{ header.text }}</span>
              </slot>
            </th>
          </slot>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(item, index) in items"
          :key="index"
          :class="{ 'even:bg-gray-100': striped }"
          class="
            hover:bg-gray-200
            focus-within:bg-gray-200
            flex
            lg:table-row
            flex-row
            lg:flex-row
            flex-wrap
            lg:flex-no-wrap
            mb-10
            lg:mb-0
          "
        >
          <slot name="item" :item="item">
            <td
              v-for="(header, index) in tableHeaders"
              :key="index"
              class="
                w-full
                lg:w-auto
                border-t
                lg:table-cell
                relative
                lg:static
                last:border-b
                lg:border-b-0
              "
              :class="['hidden md:block']"
            >
              <span class="lg:hidden absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase">{{
                header.text
              }}</span>
              <slot :name="`item.${header.value}`" :item="item">
                <span class="px-6 py-4 flex items-center justify-center lg:justify-start">{{
                  item[header.value]
                }}</span>
              </slot>
            </td>
          </slot>
        </tr>
        <tr v-if="items.length === 0">
          <td class="border-t px-6 py-4 text-center" :colspan="tableHeaders.length">
            {{ noResultsText }}
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination v-if="pagination && paginationLinks" :links="paginationLinks" />
    <slot name="footer"> </slot>
  </div>
</template>

<script setup>
import Pagination from '@/Components/Pagination'
import { computed } from 'vue'

const props = defineProps({
  headers: {
    type: Array,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
  pagination: {
    type: Boolean,
    default: false,
  },
  paginationLinks: {
    type: Array,
    required: false,
  },
  noResultsText: {
    type: String,
    default: () => {
      return 'No results avaliable'
    },
  },
  disabledHeaders: {
    type: Array,
    default: [],
  },
  striped: {
    type: Boolean,
    default: true,
  },
  hiddenOnMobile: {
    type: Array,
    default: [],
  },
})

const tableHeaders = computed(() => {
  return props.headers.filter((header) => {
    return !props.disabledHeaders.includes(header.value)
  })
})
</script>

<style></style>
