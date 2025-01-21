<template>
  <div class="flex justify-evenly text-center">
    <div class="flex flex-col items-center gap-2">
      Applied
      <span
        v-if="jobApplication.status !== 'New'"
        class="bg-emerald-400 dark:bg-emerald-600 rounded-full w-max p-1"
      >
        <CheckIcon class="size-6" />
      </span>
      <span
        v-else
        class="bg-slate-400 dark:bg-slate-600 rounded-full w-max p-1"
      >
        <EllipsisHorizontalIcon class="size-6" />
      </span>
    </div>

    <div class="flex flex-col items-center gap-2">
      Interviews
      <span
        v-if="
          ['Offered', 'Accepted', 'Rejected'].includes(jobApplication.status)
        "
        class="bg-emerald-400 dark:bg-emerald-600 rounded-full w-max p-1"
      >
        <CheckIcon class="size-6" />
      </span>
      <span
        v-else-if="jobApplication.status === 'Interviews'"
        class="bg-amber-400 dark:bg-amber-600 rounded-full w-max p-1"
      >
        <ChatBubbleLeftRightIcon class="size-6" />
      </span>
      <span
        v-else
        class="bg-slate-400 dark:bg-slate-600 rounded-full w-max p-1"
      >
        <EllipsisHorizontalIcon class="size-6" />
      </span>
    </div>

    <div class="flex flex-col items-center gap-2">
      Offer
      <span
        v-if="jobApplication.offered"
        class="bg-emerald-400 dark:bg-emerald-600 rounded-full w-max p-1"
      >
        <CheckIcon class="size-6" />
      </span>
      <span
        v-else-if="
          !jobApplication.offered && jobApplication.status === 'Rejected'
        "
        class="bg-rose-400 dark:bg-rose-600 rounded-full w-max p-1"
      >
        <XMarkIcon class="size-6" />
      </span>
      <span
        v-else
        class="bg-slate-400 dark:bg-slate-600 rounded-full w-max p-1"
      >
        <EllipsisHorizontalIcon class="size-6" />
      </span>
    </div>

    <div class="flex flex-col items-center gap-2">
      Accepted
      <span
        v-if="jobApplication.status === 'Accepted'"
        class="bg-emerald-400 dark:bg-emerald-600 rounded-full w-max p-1"
      >
        <CheckIcon class="size-6" />
      </span>
      <span
        v-else-if="jobApplication.status === 'Rejected'"
        class="bg-rose-400 dark:bg-rose-600 rounded-full w-max p-1"
      >
        <XMarkIcon class="size-6" />
      </span>
      <span
        v-else
        class="bg-slate-400 dark:bg-slate-600 rounded-full w-max p-1"
      >
        <EllipsisHorizontalIcon class="size-6" />
      </span>
    </div>
  </div>
</template>
<script setup>
import {
  CheckIcon,
  EllipsisHorizontalIcon,
  ChatBubbleLeftRightIcon,
  XMarkIcon,
} from "@heroicons/vue/24/outline"
defineProps({
  jobApplication: Object,
})
</script>
r
