<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {ref} from "vue";
import {TrashIcon, ClipboardIcon} from "@radix-icons/vue";

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

const showMenu = ref<boolean>(false);

</script>

<template>
  <Head title="Welcome" />

  <section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="mx-auto max-w-7xl">

      <nav class="relative z-50 h-24 select-none">
        <div class="relative flex flex-wrap items-center justify-between h-24 mx-auto overflow-hidden font-medium border-b border-gray-200 md:overflow-visible lg:justify-center sm:px-4 md:px-2 lg:px-0">
          <div class="flex items-center justify-start w-1/4 h-full pr-4">
            <a href="#_" class="flex items-center py-4 space-x-2 font-extrabold text-gray-900 md:py-0">
              <span>Pulseback</span>
            </a>
          </div>
          <div class="p-4 text-sm md:items-center md:w-3/4 lg:text-base md:flex">
            <div class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg md:bg-transparent md:overflow-visible md:rounded-none md:relative md:flex md:flex-row">
              <div class="flex flex-col items-start justify-center w-full space-x-6 text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
              </div>
              <div class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/3 md:flex-row md:py-0">
                <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                  <Link
                      v-if="$page.props.auth.user"
                      :href="route('dashboard')"
                      class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                  >
                    Dashboard
                  </Link>

                  <template v-else>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                      Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                      Register
                    </Link>
                  </template>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Main Hero Content -->
      <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
          <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Questionnaires done the right way</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">From simple to build questionnaires to immediate access to responses, Pulseback is the tool for you.</p>
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
              Get started
              <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <a :href="$page.props.auth.user ? route('dashboard') : route('register')"  class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
              Get Started
            </a>
          </div>
          <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <ClipboardIcon class="w-96 h-96" />
          </div>
        </div>
      </section>

      <!-- End Main Hero Content -->



    </div>
  </section>


</template>
