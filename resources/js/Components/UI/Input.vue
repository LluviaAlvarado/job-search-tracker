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
    <input
      v-if="inputType === 'file'"
      type="file"
      :name="inputName"
      class="file:border-0 file:p-2 file:rounded-full file:bg-violet-400 file:hover:bg-violet-300 dark:file:bg-violet-600 dark:file:hover:bg-violet-500 dark:file:text-slate-50"
      @input="onSelectFile"
    />
    <div v-if="inputType === 'datetime'" class="flex gap-2">
      <input
        type="date"
        :name="inputName"
        class="bg-slate-100 dark:bg-slate-800 rounded-md"
        @input="onSetDate"
      />
      <input
        type="time"
        :name="inputName"
        class="bg-slate-100 dark:bg-slate-800 rounded-md"
        @input="onSetTime"
      />
    </div>

    <span v-if="error" class="text-red-500 text-sm">
      {{ error }}
    </span>
  </div>
</template>
<script setup>
const model = defineModel()

defineProps({
  label: String,
  inputName: String,
  inputType: String,
  error: String,
})

const onSelectFile = ($event) => {
  model.value = $event.target.files[0]
}

const onSetDate = ($event) => {
  console.log($event.target.value)
}

const onSetTime = ($event) => {
  console.log($event.target.value)
}
</script>
