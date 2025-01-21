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

const form = useForm({
  title: "",
  contact_info: "",
  description: "",
  scheduled_time: null,
})

const emit = defineEmits(["close"])

const onSave = () => {
  form.post("jobInterview")
  emit("close")
}

const onCancel = () => {
  emit("close")
}
</script>
