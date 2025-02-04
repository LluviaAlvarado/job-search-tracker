<template>
  <div class="flex flex-col gap-4">
    <Box v-for="interview in interviews" :key="interview.id" class="flex-col">
      <div class="flex justify-between items-center">
        <span class="font-bold">{{ interview.title }}</span>
        <div class="flex gap-4">
          <Button
            button-type="tertiary"
            icon="edit"
            @click="onEditInterview(interview.id)"
          />
          <Button
            button-type="danger"
            icon="delete"
            @click="onDeleteInterview(interview.id)"
          />
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
import axios from "axios"

defineProps({
  interviews: Array,
})
const emit = defineEmits(["edit"])

const onEditInterview = (id) => {
  emit("edit", id)
}

const onDeleteInterview = (id) => {
  axios
    .delete(`/jobInterview/${id}`)
    .then(() => {
      window.location.reload()
    })
    .catch((err) => {
      console.log(err)
    })
}
</script>
