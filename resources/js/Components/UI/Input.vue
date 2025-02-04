<template>
  <div class="flex flex-col gap-1">
    <label :for="inputName">{{ label }}</label>

    <input
      v-if="inputType === 'text' || inputType === 'number'"
      v-model="model"
      :type="inputType"
      :name="inputName"
      class="bg-slate-100 dark:bg-slate-800 rounded-md"
    />
    <textarea
      v-if="inputType === 'textarea'"
      v-model="model"
      cols="80"
      rows="10"
      :name="inputName"
      class="bg-slate-100 dark:bg-slate-800 rounded-md"
    />
    <div v-if="inputType === 'file'" class="flex flex-col gap-4">
      <span class="mt-2 text-sm">Selected file: {{ file }}</span>
      <input
        type="file"
        :name="inputName"
        class="file:border-0 file:p-2 file:rounded-full file:bg-violet-400 file:hover:bg-violet-300 dark:file:bg-violet-600 dark:file:hover:bg-violet-500 dark:file:text-slate-50"
        @input="onSelectFile"
      />
    </div>
    <div v-if="inputType === 'datetime'" class="flex gap-2">
      <input
        type="date"
        :name="inputName"
        class="bg-slate-100 dark:bg-slate-800 rounded-md"
        :value="date"
        @input="onSetDate"
      />
      <input
        type="time"
        :name="inputName"
        class="bg-slate-100 dark:bg-slate-800 rounded-md"
        :value="time"
        @input="onSetTime"
      />
    </div>

    <span v-if="error" class="text-red-500 text-sm">
      {{ error }}
    </span>
  </div>
</template>
<script setup>
import { onMounted, ref } from "vue"

const model = defineModel()

const date = ref("00-00-00")
const time = ref("00:00")
const file = ref("")

const props = defineProps({
  label: String,
  inputName: String,
  inputType: String,
  error: String,
})

onMounted(() => {
  if (model.value) {
    if (props.inputType === "datetime") {
      ;[date.value, time.value] = model.value.split(" ")
    }
    if (props.inputType === "file") {
      file.value = model.value
    }
  }
})

const onSelectFile = ($event) => {
  model.value = $event.target.files[0]
  file.value = model.value.name
}

const onSetDate = ($event) => {
  date.value = $event.target.value
  model.value = date.value + " " + time.value
}

const onSetTime = ($event) => {
  time.value = $event.target.value
  model.value = date.value + " " + time.value
}
</script>
