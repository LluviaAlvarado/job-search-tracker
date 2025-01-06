<template>
  <form @submit.prevent="submit">
    <div>
      <div>
        <label for="company_name">Company Name</label>
        <input v-model="form.company_name" type="text" name="company_name" />
        <div v-if="form.errors.company_name" class="errorMsg"> {{ form.errors.company_name }}</div>
      </div>
      <div>
        <label for="role">Role</label>
        <input v-model="form.role" type="text" name="role" />
        <div v-if="form.errors.role" class="errorMsg"> {{ form.errors.role }}</div>
      </div>
      <div>
        <label for="job_description">Job Description</label>
        <br />
        <textarea v-model="form.job_description" cols="80" rows="10" name="job_description" />
        <div v-if="form.errors.job_description" class="errorMsg"> {{ form.errors.job_description }}</div>
      </div>
      <div>
        <label for="job_requirements">Job Requirements</label>
        <br />
        <textarea v-model="form.job_requirements" cols="80" rows="10" name="job_requirements" />
        <div v-if="form.errors.job_requirements" class="errorMsg"> {{ form.errors.job_requirements }}</div>
      </div>
      <div>
        <label for="anual_salary">Anual Salary</label>
        <input v-model="form.anual_salary" type="number" name="anual_salary" />
        <div v-if="form.errors.anual_salary" class="errorMsg"> {{ form.errors.anual_salary }}</div>
      </div>
      <div>
        <label for="cv">CV</label>
        <input type="file" name="cv" @input="form.cv = $event.target.files[0]" />
        <div v-if="form.errors.cv" class="errorMsg"> {{ form.errors.cv }}</div>
      </div>

      <div>
        <button type="submit">Create</button>
      </div>
    </div>
  </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3"
const form = useForm({
  company_name: "",
  role: "",
  job_description: "",
  job_requirements: "",
  anual_salary: 0,
  cv: "",
})

const submit = () => form.post("/jobApplication")
</script>
<style scoped>
  label {
    margin-right: 2em;
  }
  div {
    padding: 2px;
  }
  .errorMsg {
    color: red;
  }
</style>