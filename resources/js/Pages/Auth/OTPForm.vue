<template>
  <form @submit.prevent="submit">
    <div>
      <Input
        label="New Password"
        id="password"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password"
        :error="form.errors.password"
        required
        autofocus
        autocomplete="off"
      />
    </div>

    <div class="mt-4">
      <Input
        label="Confirm Password"
        id="password_confirmation"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password_confirmation"
        :error="form.errors.password_confirmation"
        required
        autocomplete="off"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <Button
        type="submit"
        class="ml-4 bg-blue-600 hover:bg-blue-500 text-white"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save Password
      </Button>
    </div>
  </form>
</template>

<script>
import GuestLayout from '@/Layouts/Guest'
import Button from '@/Components/Button'
import Input from '@/Components/Input'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  inheritAttrs: false,
  layout: GuestLayout,
  components: {
    Button,
    Input
  },

  props: {
    auth: Object,
    errors: Object
  },
  setup() {
    const form = useForm({
      password: '',
      password_confirmation: '',
      remember: false,
    })

    function submit() {
      form.post(route('set-password'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
      })
    }

    return {
      form,
      submit,
    }
  },
}
</script>
