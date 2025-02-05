<template>
  <form @submit.prevent="submit">
    <div class="flex flex-col gap-2">
      <span
        class="text-center font-bold text-lg text-emerald-800 dark:text-emerald-400"
      >
        Edit Job Application
      </span>
      <Input
        v-model="form.company_name"
        input-name="company_name"
        label="Company Name"
        input-type="text"
        :error="form.errors.company_name"
        @input-updated="($event) => (form.company_name = $event)"
      />
      <Input
        v-model="form.role"
        input-name="role"
        label="Role"
        input-type="text"
        :error="form.errors.role"
        @input-updated="($event) => (form.role = $event)"
      />
      <Input
        v-model="form.job_description"
        input-name="job_description"
        label="Job Description"
        input-type="textarea"
        :error="form.errors.job_description"
        @input-updated="($event) => (form.job_description = $event)"
      />
      <Input
        v-model="form.job_requirements"
        input-name="job_requirements"
        label="Job Requirements"
        input-type="textarea"
        :error="form.errors.job_requirements"
        @input-updated="($event) => (form.job_requirements = $event)"
      />
      <Input
        v-model="form.annual_salary"
        input-name="annual_salary"
        label="Annual Salary"
        input-type="number"
        :error="form.errors.annual_salary"
        @input-updated="($event) => (form.annual_salary = $event)"
      />
      <Input
        v-model="form.cv"
        input-name="cv"
        label="CV"
        input-type="file"
        :error="form.errors.cv"
        @input-updated="($event) => (form.cv = $event)"
      />
      <Button action="submit" class="self-center px-4" icon="accept">
        Save
      </Button>
    </div>
  </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3"
import Input from "@/Components/UI/Input.vue"
import Button from "@/Components/UI/Button.vue"

const props = defineProps({
  jobApplication: Object,
})
const form = useForm({
  company_name: props.jobApplication.company_name,
  role: props.jobApplication.role,
  job_description: props.jobApplication.job_description,
  job_requirements: props.jobApplication.job_requirements,
  annual_salary: props.jobApplication.annual_salary,
  cv: props.jobApplication.cv,
})

const submit = () => form.put(`/jobApplication/${props.jobApplication.id}`)
</script>
