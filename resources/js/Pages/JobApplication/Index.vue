<template>
  <div class="flex flex-col gap-4">
    <Link
      v-for="jobApplication in jobApplications"
      :key="jobApplication.id"
      :href="`jobApplication/${jobApplication.id}`"
    >
      <Box class="md:flex-row flex-col">
        <div
          class="container flex-2 md:w-3/12 bg-slate-200 dark:bg-slate-900 rounded-md p-2"
        >
          <span class="font-bold text-md">
            {{ jobApplication.company_name }}
          </span>
          <br />
          <span class="text-sm">{{ jobApplication.role }}</span>
        </div>

        <Steps class="flex-1" :job-application="jobApplication" />
      </Box>
    </Link>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3"
import Box from "@/Components/UI/Box.vue"
import Steps from "@/Components/UI/Steps.vue"
defineProps({
  jobApplications: Array,
})
</script>
