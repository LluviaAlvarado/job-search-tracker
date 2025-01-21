<template>
  <div class="flex flex-col gap-4">
    <Box class="flex-col">
      <div class="flex justify-between">
        <div class="flex flex-col gap-2">
          <span class="text-sm">Company</span>
          <span class="font-bold">{{ jobApplication.company_name }}</span>
          <span class="text-sm">Role</span>
          <span>
            {{ jobApplication.role }}
          </span>
        </div>

        <div class="flex flex-col">
          Status
          <select
            id=""
            v-model="currentStatus"
            name="Status"
            class="rounded-lg dark:bg-slate-900 dark:text-slate-200"
            @change="onStatusChange"
          >
            <option
              v-for="status in possibleStatus"
              :key="status"
              :value="status"
            >
              {{ status }}
            </option>
          </select>
          <div class="flex justify-center gap-4">
            <Button
              button-type="tertiary"
              class="w-12 self-end"
              icon="edit"
              @click="goToEdit"
            />
            <Button
              button-type="danger"
              class="w-12 self-end"
              icon="delete"
              @click="onDelete"
            />
          </div>
        </div>
      </div>

      <Box class="flex-col">
        <span class="text-sm">Job Description</span>
        <span>{{ jobApplication.job_description }}</span>
      </Box>
      <Box class="flex-col">
        <span class="text-sm">Job Requirements</span>
        <span>{{ jobApplication.job_requirements }}</span>
      </Box>
    </Box>
    <Box class="flex-col">
      <div class="flex justify-between items-center">
        <span>Interviews</span>
        <Button icon="add" @click="() => (showInterviewForm = true)">
          Add
        </Button>
      </div>
      <InterviewForm
        v-if="showInterviewForm"
        @close="() => (showInterviewForm = false)"
      />
      <InterviewList :interviews="jobApplication.job_interviews" />
      <span />
    </Box>
  </div>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue"
import Button from "@/Components/UI/Button.vue"
import InterviewList from "@/Components/Interview/InterviewList.vue"
import InterviewForm from "@/Components/Interview/InterviewForm.vue"
import { ref } from "vue"
import axios from "axios"
const props = defineProps({
  jobApplication: Object,
})
const currentStatus = ref(props.jobApplication.status)
const showInterviewForm = ref(false)
let possibleStatus = []

const onStatusChange = (e) => {
  setPossibleStatus(e.target.value)
  currentStatus.value = e.target.value
  axios.put(`/jobApplication/${props.jobApplication.id}/status`, {
    status: e.target.value,
  })
}

const goToEdit = () => {
  window.location.href = `/jobApplication/${props.jobApplication.id}/edit`
}

const onDelete = () => {
  // todo
}

const setPossibleStatus = (status) => {
  possibleStatus = [status]
  if (status === "New") {
    possibleStatus.push("Applied")
  } else if (status === "Applied") {
    possibleStatus.push("Interviews", "Offered", "Rejected")
  } else if (status === "Interviews") {
    possibleStatus.push("Offered", "Rejected")
  } else if (status === "Offered") {
    possibleStatus.push("Accepted", "Rejected")
  } else {
    possibleStatus.push("New")
  }
}
setPossibleStatus(props.jobApplication.status)
</script>
