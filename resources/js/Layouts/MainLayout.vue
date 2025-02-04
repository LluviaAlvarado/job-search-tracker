<template>
  <header
    class="border-b border-violet-400 dark:border-violet-800 bg-slate-100 dark:bg-slate-900 w-full"
  >
    <div class="container mx-auto">
      <nav class="flex p-4 items-center justify-between">
        <div
          class="text-xl text-indigo-700 dark:text-indigo-300 font-bold text-center"
        >
          <Link href="/">Job Search Tracker</Link>
        </div>
        <Button button-type="primary" icon="add" @click="goToCreate">
          New
        </Button>
      </nav>
    </div>
  </header>
  <main class="container mx-auto px-2 py-4">
    <div
      v-if="$attrs.flash.success && showFlash"
      class="mb-4 border border-emerald-600 bg-emerald-300 text-emerald-950 rounded-md shadow-sm p-2 flex justify-between"
    >
      {{ $attrs.flash.success }}
      <Button
        button-type="none"
        icon="cancel"
        @click="() => (showFlash = false)"
      />
    </div>
    <slot />
  </main>
</template>
<script setup>
import { Link } from "@inertiajs/vue3"
import { ref } from "vue"
import Button from "@/Components/UI/Button.vue"

const showFlash = ref(true)

onslotchange = () => {
  showFlash.value = true
}

const goToCreate = () => {
  window.location.href = "/jobApplication/create"
}
</script>
