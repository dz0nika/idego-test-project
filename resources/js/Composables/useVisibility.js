import { ref } from 'vue'

/**
 * Visibility logic
 *
 * @param {Boolean} isVisible
 */
export default function useVisibility(isVisible) {
  const visible = ref(isVisible)

  const show = () => {
    visible.value = true
  }

  const hide = () => {
    visible.value = false
  }

  const toggle = () => {
    visible.value = !visible.value
  }

  return {
    visible,
    show,
    hide,
    toggle,
  }
}
