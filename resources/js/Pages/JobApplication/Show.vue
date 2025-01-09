<template>
  <div>
    {{ jobApplication.company_name }}
    {{ jobApplication.role }}
  </div>
</template>
<script setup>
defineProps({
  jobApplication: Object,
})
</script>