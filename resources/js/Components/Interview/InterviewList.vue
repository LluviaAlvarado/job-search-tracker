<template>
  <div class="flex flex-col gap-4">
    <Box v-for="interview in interviews" :key="interview.id" class="flex-col">
      <div class="flex justify-between items-center">
        <span class="font-bold">{{ interview.title }}</span>
        <div class="flex gap-4">
          <Button button-type="tertiary" icon="edit" />
          <Button button-type="danger" icon="delete" />
        </div>
      </div>
      <span>
        Scheduled for:
        <strong>{{ interview.scheduled_time }}</strong>
      </span>
      <span class="text-sm">Notes</span>
      <div>{{ interview.description }}</div>
    </Box>
  </div>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue"
import Button from "@/Components/UI/Button.vue"

defineProps({
  interviews: Array,
})
</script>
