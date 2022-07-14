<template>
  <AuthenticatedLayout>
    <h1 class="mb-8 font-bold text-3xl">Users</h1>
    <Table
      :items="users.data"
      :headers="tableHeaders"
      :pagination="true"
      :paginationLinks="users.links"
      :hiddenOnMobile="null"
    >
      <template #toolbar>
        <div
          class="
            p-4
            flex flex-col
            space-y-2
            sm:space-y-0 sm:flex-row
            justify-between
            items-baseline
            sm:items-center
          "
        >
          <SearchFilter
            v-model="form.search"
            :searchOnly="true"
            class="w-full max-w-md mr-4"
            @reset="reset()"
          >
          </SearchFilter>
          <PerPageSelect v-model="form.per_page" />
        </div>
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import Table from '@/Components/Table'
import SearchFilter from '@/Components/SearchFilter'
import PerPageSelect from '@/Components/PerPageSelect'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import { watch, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  users: Object,
  filters: Object,
})

const tableHeaders = [
  {
    text: 'Name',
    value: 'name',
  },
  {
    text: 'Email',
    value: 'email',
  },
  {
    text: 'Created At',
    value: 'created_at',
  }
]

const form = ref({
  search: props.filters.search,
  per_page: props.filters.per_page ?? 15,
})

const reset = () => {
  form.value = mapValues(form.value, (value, key) => {
    if (key == 'per_page') {
      return value
    }
    return null
  })
}

watch(
  () => form,
  throttle(function () {
    let query = pickBy(form.value)
    Inertia.get(this.route('users'), Object.keys(query).length ? query : { remember: 'forget' }, {
      preserveState: true,
      preserveScroll: true,
    })
  }, 150),
  { deep: true },
)
</script>

<style></style>
