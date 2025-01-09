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
        <div
          class="bg-emerald-600 hover:bg-emerald-500 text-white font-medium p-2 rounded-full grow-0"
        >
          <Link href="/jobApplication/create">+ New</Link>
        </div>
      </nav>
    </div>
  </header>
  <main class="container mx-auto px-2 py-4">
    <div
      v-if="$attrs.flash.success"
      class="mb-4 border border-emerald-600 bg-emerald-300 text-emerald-950 rounded-md shadow-sm p-2"
    >
      {{ $attrs.flash.success }}
    </div>
    <slot />
  </main>
</template>
<script setup>
import { Link } from "@inertiajs/vue3"
</script>
