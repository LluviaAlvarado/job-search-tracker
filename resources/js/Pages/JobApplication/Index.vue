<template>
  <Box v-for="jobApplication in jobApplications" :key="jobApplication.id">
    <Link :href="`jobApplication/${ jobApplication.id }`">
      {{ jobApplication.company_name }}
    </Link>
    <Link :href="`jobApplication/${ jobApplication.id }/edit`">
      Edit
    </Link>
    <Link :href="`jobApplication/${ jobApplication.id }`" method="DELETE">
      Delete
    </Link>
  </Box>
</template>
<script setup>
import { Link } from "@inertiajs/vue3"
import Box from "@/Components/UI/Box.vue"
defineProps({
  jobApplications: Array,
})
</script>
