<template>
  <Box class="flex-col">
    <Input
      v-model="form.title"
      input-name="title"
      label="Title"
      input-type="text"
      :error="form.errors.title"
      @input-updated="($event) => (form.title = $event)"
    />
    <Input
      v-model="form.contact_info"
      input-name="contact_info"
      label="Contact Info"
      input-type="text"
      :error="form.errors.contact_info"
      @input-updated="($event) => (form.contact_info = $event)"
    />
    <Input
      v-model="form.description"
      input-name="description"
      label="Description"
      input-type="textarea"
      :error="form.errors.description"
      @input-updated="($event) => (form.description = $event)"
    />
    <Input
      v-model="form.scheduled_time"
      input-name="scheduled_time"
      label="Scheduled for"
      input-type="datetime"
      :error="form.errors.scheduled_time"
      @input-updated="($event) => (form.scheduled_time = $event)"
    />
    <div class="flex gap-4 justify-center">
      <Button button-type="secondary" icon="accept" @click="onSave" />
      <Button button-type="tertiary" icon="cancel" @click="onCancel" />
    </div>
  </Box>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue"
import Input from "@/Components/UI/Input.vue"
import Button from "../UI/Button.vue"
import { useForm } from "@inertiajs/vue3"

const props = defineProps({
  jobApplicationId: Number,
  interview: Object,
})

const form = useForm({
  job_application_id: props.jobApplicationId,
  title: props.interview ? props.interview.title : "",
  contact_info: props.interview ? props.interview.contact_info : "",
  description: props.interview ? props.interview.description : "",
  scheduled_time: props.interview ? props.interview.scheduled_time : "",
})

const emit = defineEmits(["close"])

const onSave = () => {
  if (props.interview) {
    form.put(`/jobInterview/${props.interview.id}`, {
      onSuccess: () => {
        emit("close")
      },
    })
  } else {
    form.post("/jobInterview", {
      onSuccess: () => {
        emit("close")
      },
    })
  }
}

const onCancel = () => {
  emit("close")
}
</script>
