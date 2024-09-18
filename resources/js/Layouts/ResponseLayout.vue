<script setup lang="ts">

</script>

<template>
  <div class="min-h-screen w-screen lg:pl-60 lg:pr-60 lg:pt-20 md:pl-10 md:pr-10 md:pt-5 sm:justify-center items-center pt-6 sm:pt-0">
    <div class="flex flex-col">
      <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
        <div class="flex items-center" v-if="$slots.header">
          <h1 class="text-lg font-semibold md:text-2xl">
            <slot name="header" />
          </h1>
        </div>
        <slot />
      </main>
    </div>
  </div>
</template>
