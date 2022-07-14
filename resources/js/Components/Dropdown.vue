<template>
  <div class="relative">
    <button type="button" @click="toggle()" class="h-full w-full">
      <slot name="trigger" />
    </button>

    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-show="isOpen"
        class="absolute z-50 mt-2 rounded-md shadow-lg"
        :class="[widthClass, alignmentClasses]"
        style="display: none"
        ref="dropdownContent"
        @click="autoClose ? close() : null"
      >
        <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, computed, ref } from 'vue'
import useVisibility from '@/Composables/useVisibility'
import { onClickOutside } from '@vueuse/core'

const props = defineProps({
  align: {
    default: 'right',
  },
  width: {
    default: '48',
  },
  contentClasses: {
    default: () => ['py-1', 'bg-white'],
  },
  autoClose: {
    type: Boolean,
    default: true,
  },
})

const { visible: isOpen, show: open, hide: close, toggle } = useVisibility(false)

const dropdownContent = ref(null)

onClickOutside(dropdownContent, () => close())

const closeOnEscape = (e) => {
  if (isOpen && e.keyCode === 27) {
    close()
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

const widthClass = computed(() => {
  return 'w-' + props.width
})

const alignmentClasses = computed(() => {
  if (props.align === 'left') {
    return 'origin-top-left left-0'
  } else if (props.align === 'right') {
    return 'origin-top-right right-0'
  } else {
    return 'origin-top'
  }
})
</script>
