<template>
  <div class="flex flex-col gap-1">
    <label :for="inputName">{{ label }}</label>

    <input
      v-if="inputType === 'text' || inputType === 'number'"
      v-model="model"
      :type="inputType"
      :name="inputName"
    />
    <textarea
      v-if="inputType === 'textarea'"
      v-model="model"
      cols="80"
      rows="10"
      :name="inputName"
    />
    <input
      v-if="inputType === 'file'"
      type="file"
      :name="inputName"
      class="file:border-0 file:p-2 file:rounded-full file:bg-emerald-300 file:hover:bg-emerald-200 dark:file:bg-emerald-400 dark:file:hover:bg-emerald-300"
      @input="onUpdate"
    />
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

const onUpdate = ($event) => {
  if (this.inputType === "file") {
    model.value = $event.target.files[0]
  }
}
</script>
