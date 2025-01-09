<template>
  <div class="grid grid-cols-4 gap-4 p-2 text-center">
    <div class="flex flex-col">
      Applied
      <span> {{ jobApplication.status !== 'New' ? 'Yes' : 'No' }}</span>
    </div>
    <div>
      Interviews
    </div>
    <div>
      Offer
    </div>
    <div>
      Accepted
    </div>
  </div>
</template>
<script setup>
defineProps({
  jobApplication: Object,
})
</script>r