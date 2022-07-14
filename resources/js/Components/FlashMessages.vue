<template>
  <div class="fixed top-10 right-10 z-50">
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-if="$page.props.flash.success && successVisible"
        class="
          flex
          items-center
          w-full
          max-w-xs
          p-4
          mb-4
          text-gray-500
          bg-green-100
          rounded-lg
          shadow
        "
        role="alert"
      >
        <div class="ml-3 text-sm font-normal mr-3 text-green-700">
          {{ $page.props.flash.success }}
        </div>
        <button
          @click="hideSuccess()"
          type="button"
          class="
            ml-auto
            -mx-1.5
            -my-1.5
            bg-white
            text-gray-400
            hover:text-gray-900
            rounded-lg
            focus:ring-2 focus:ring-gray-300
            p-1.5
            hover:bg-gray-100
            inline-flex
            h-8
            w-8
            dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700
          "
          data-collapse-toggle="toast-success"
          aria-label="Close"
        >
          <Icon name="x" class="fill-green-700 w-5 h-5" />
        </button>
      </div>
    </transition>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-if="$page.props.flash.error && errorVisible"
        class="
          flex
          items-center
          w-full
          max-w-xs
          p-4
          mb-4
          text-gray-500
          bg-red-100
          rounded-lg
          shadow
        "
        role="alert"
      >
        <div class="ml-3 text-sm font-normal mr-3 text-red-700">
          {{ $page.props.flash.error }}
        </div>
        <button
          @click="hideError()"
          type="button"
          class="
            ml-auto
            -mx-1.5
            -my-1.5
            bg-white
            text-gray-400
            hover:text-gray-900
            rounded-lg
            focus:ring-2 focus:ring-gray-300
            p-1.5
            hover:bg-gray-100
            inline-flex
            h-8
            w-8
            dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700
          "
          data-collapse-toggle="toast-success"
          aria-label="Close"
        >
          <Icon name="x" class="fill-red-700 w-5 h-5" />
        </button>
      </div>
    </transition>
  </div>
</template>

<script setup>
import Icon from '@/Components/Icon'
import useVisibility from '@/Composables/useVisibility'
import { onMounted, onUnmounted } from 'vue'

const { visible: successVisible, show: showSuccess, hide: hideSuccess } = useVisibility(false)
const { visible: errorVisible, show: showError, hide: hideError } = useVisibility(false)

let flashMessagesListener = (event) => {
  if (event.detail?.page?.props?.flash?.success) {
    showSuccess()
  }

  if (event.detail?.page?.props?.flash?.error) {
    showError()
  }
}

onMounted(() => {
  document.addEventListener('inertia:success', flashMessagesListener)
})

onUnmounted(() => {
  document.removeEventListener('inertia:success', flashMessagesListener)
})
</script>

<style></style>
