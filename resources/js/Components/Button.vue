<template>
  <button
    :type="action"
    class="rounded-full p-3 my-4"
    :class="{
      'bg-violet-400': buttonType === 'primary',
      'bg-indigo-300': buttonType === 'secondary',
    }"
  >
    <slot />
  </button>
</template>
<script setup>
defineProps({
  action: String,
  buttonType: {
    type: String,
    default: "primary",
  },
})
</script>
