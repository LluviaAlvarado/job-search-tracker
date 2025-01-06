<template>
  <div>Job Search Tracker</div>
  <Link href="/show">View Application</Link>
  {{ props.message }}
</template>
<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  message: { type: String, default: 'UwU' },
})
</script>
