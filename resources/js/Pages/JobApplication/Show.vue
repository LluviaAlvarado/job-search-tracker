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
            value="currentStatus"
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

      <div>
        <span>Latest Update: {{ latestUpdate }}</span>
      </div>

      <Box class="flex-col">
        <span class="text-sm">Job Description</span>
        <span>{{ jobApplication.job_description }}</span>
      </Box>
      <Box class="flex-col">
        <span class="text-sm">Job Requirements</span>
        <span>{{ jobApplication.job_requirements }}</span>
      </Box>
      <div class="flex p-2 gap-4">
        <span>CV:</span>
        <Button
          icon="download"
          button-type="none"
          class="text-indigo-800 dark:text-indigo-400"
          @click="downloadCV"
        >
          {{ jobApplication.cv }}
        </Button>
      </div>
    </Box>
    <Box
      v-if="
        jobApplication.status !== 'New' && jobApplication.status !== 'Applied'
      "
      class="flex-col"
    >
      <div class="flex justify-between items-center">
        <span>Interviews</span>
        <Button icon="add" @click="() => (showInterviewForm = true)">
          Add
        </Button>
      </div>
      <InterviewForm
        v-if="showInterviewForm"
        :job-application-id="jobApplication.id"
        :interview="interview"
        @close="() => (showInterviewForm = false)"
      />
      <InterviewList
        :interviews="jobApplication.job_interviews"
        @edit="(id) => startEditInterview(id)"
      />
      <span />
    </Box>
  </div>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue"
import Button from "@/Components/UI/Button.vue"
import InterviewList from "@/Components/Interview/InterviewList.vue"
import InterviewForm from "@/Components/Interview/InterviewForm.vue"
import { onMounted, ref } from "vue"
import axios from "axios"
import { saveAs } from "file-saver"
const props = defineProps({
  jobApplication: Object,
})
const currentStatus = ref(props.jobApplication.status)
const interview = ref(null)
const showInterviewForm = ref(false)
const latestUpdate = ref("")
let possibleStatus = []

onMounted(() => {
  currentStatus.value = props.jobApplication.status
  if (
    props.jobApplication.status === "Applied" ||
    (props.jobApplication.status === "Interviews" &&
      !props.jobApplication.job_interviews)
  ) {
    latestUpdate.value = `Applied on ${props.jobApplication.application_date}`
  } else if (
    props.jobApplication.status === "Interviews" &&
    props.jobApplication.job_interviews.length
  ) {
    latestUpdate.value = `Interview on ${props.jobApplication.job_interviews[0].scheduled_time}`
  } else if (props.jobApplication.status === "Offered") {
    latestUpdate.value = `Offered on ${props.jobApplication.offer_date}`
  } else if (props.jobApplication.status === "Accepted") {
    latestUpdate.value = `Accepted on ${props.jobApplication.decision_date}`
  } else if (props.jobApplication.status === "Rejected") {
    latestUpdate.value = `Rejected on ${props.jobApplication.decision_date}`
  } else {
    latestUpdate.value = `Created on ${
      props.jobApplication.created_at.split("T")[0]
    }`
  }
})

const onStatusChange = (e) => {
  setPossibleStatus(e.target.value)
  currentStatus.value = e.target.value
  axios.put(`/jobApplication/${props.jobApplication.id}/status`, {
    status: e.target.value,
  })
}

const downloadCV = () => {
  axios({
    url: `/jobApplication/${props.jobApplication.id}/cv`,
    method: "GET",
    responseType: "blob",
  })
    .then((response) => {
      const blob = new Blob([response.data], {
        type: response.headers["content-type"],
      })
      const fileName = props.jobApplication.cv
      saveAs(blob, fileName)
    })
    .catch((error) => {
      console.error("Error downloading the CV:", error)
    })
}

const goToEdit = () => {
  window.location.href = `/jobApplication/${props.jobApplication.id}/edit`
}

const startEditInterview = (id) => {
  interview.value = props.jobApplication.job_interviews.find((i) => i.id === id)
  showInterviewForm.value = true
}

const onDelete = () => {
  axios
    .delete(`/jobApplication/${props.jobApplication.id}`)
    .then(() => {
      window.location.href = "/jobApplication"
    })
    .catch((err) => {
      console.log(err)
    })
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
