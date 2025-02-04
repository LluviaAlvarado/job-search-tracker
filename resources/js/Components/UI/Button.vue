<template>
  <button
    :type="action"
    :class="{
      'rounded-full p-3 my-4': buttonType !== 'none',
      'bg-emerald-400 dark:bg-emerald-600': buttonType === 'primary',
      'bg-violet-400 dark:bg-violet-600': buttonType === 'secondary',
      'bg-indigo-300 dark:bg-indigo-500': buttonType === 'tertiary',
      'bg-rose-300 dark:bg-rose-500': buttonType === 'danger',
    }"
  >
    <span class="flex gap-2">
      <slot />
      <CheckIcon v-if="icon === 'accept'" class="size-6" />
      <PlusIcon v-if="icon === 'add'" class="size-6" />
      <PencilSquareIcon v-if="icon === 'edit'" class="size-6" />
      <TrashIcon v-if="icon === 'delete'" class="size-6" />
      <XMarkIcon v-if="icon === 'cancel'" class="size-6" />
      <ArrowDownTrayIcon v-if="icon === 'download'" class="size-6" />
    </span>
  </button>
</template>
<script setup>
import {
  CheckIcon,
  PlusIcon,
  PencilSquareIcon,
  TrashIcon,
  XMarkIcon,
  ArrowDownTrayIcon,
} from "@heroicons/vue/24/outline"

defineProps({
  action: String,
  buttonType: {
    type: String,
    default: "primary",
  },
  icon: String,
})
</script>
