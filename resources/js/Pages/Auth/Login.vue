<template>
  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>

  <form @submit.prevent="submit">
    <div>
      <Input
        label="Email"
        id="email"
        type="email"
        class="mt-1 block w-full"
        v-model="form.email"
        :error="form.errors.email"
        required
        autofocus
        autocomplete="off"
      />
    </div>

    <div class="mt-4">
      <Input
        label="Password"
        id="password"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password"
        :error="form.errors.password"
        required
        autocomplete="current-password"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <Button
        type="submit"
        class="ml-4 bg-blue-600 hover:bg-blue-500 text-white"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Sign In
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
    Input,
  },

  props: {
    auth: Object,
    canResetPassword: Boolean,
    errors: Object,
    status: String,
  },

  setup() {
    const form = useForm({
      email: '',
      password: '',
      remember: false,
    })

    function submit() {
      form.post(route('login'), {
        onFinish: () => form.reset('password'),
      })
    }

    return {
      form,
      submit,
    }
  },
}
</script>
