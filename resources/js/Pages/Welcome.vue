<script setup lang="ts">
import Button from '@/Components/ui/button/Button.vue';
import Card from '@/Components/ui/card/Card.vue';
import { Head, Link } from '@inertiajs/vue3';
import { RocketIcon, ClipboardIcon, CheckCircledIcon, BarChartIcon } from "@radix-icons/vue";

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

</script>

<template>
  <Head title="Welcome" />

  <section class="w-full min-h-screen antialiased bg-background">
    <!-- Enhanced Navigation -->
    <nav class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
      <div class="container flex h-16 items-center justify-between px-4">
        <div class="flex items-center space-x-2">
          <RocketIcon class="h-6 w-6 text-primary" />
          <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-primary to-purple-500 bg-clip-text text-transparent">
            Pulseback
          </span>
        </div>
        <div class="flex items-center space-x-4">
          <nav v-if="canLogin" class="flex items-center space-x-2">
            <Link
              v-if="$page.props.auth.user"
              :href="route('dashboard')"
            >
              <Button variant="ghost">
                Dashboard
              </Button>
            </Link>

            <template v-else>
              <Link :href="route('login')">
                <Button variant="ghost">
                  Log in
                </Button>
              </Link>

              <Link
                v-if="canRegister"
                :href="route('register')"
              >
                <Button>
                  Get Started
                  <RocketIcon class="ml-2 h-4 w-4" />
                </Button>
              </Link>
            </template>
          </nav>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="container py-12 lg:py-24">
      <div class="grid items-center gap-6 lg:grid-cols-2 lg:gap-12">
        <div class="space-y-4">
          <div class="inline-block rounded-lg bg-muted px-3 py-1 text-sm font-medium">
            🚀 Free Forever • No Credit Card Required
          </div>
          <h1 class="text-4xl font-extrabold tracking-tight lg:text-5xl">
            Create Engaging Questionnaires
            <span class="bg-gradient-to-r from-primary to-purple-500 bg-clip-text text-transparent">
              in Minutes
            </span>
          </h1>
          <p class="text-xl text-muted-foreground">
            From customer feedback to academic research - build beautiful, mobile-friendly surveys that get results.
          </p>

          <div class="flex gap-4 pt-6">
            <Link :href="$page.props.auth.user ? route('dashboard') : route('register')">
              <Button class="h-12 px-8 text-lg gap-2">
                <RocketIcon class="h-5 w-5" />
                Start Creating Free
              </Button>
            </Link>
          </div>
        </div>

        <div class="flex justify-center">
          <Card class="relative overflow-hidden bg-gradient-to-br from-primary/10 to-purple-500/10 p-8">
            <div class="relative z-10 space-y-4">
              <ClipboardIcon class="h-48 w-48 mx-auto text-primary" />
              <div class="text-center text-muted-foreground">
                "Pulseback transformed how we collect student feedback!"
              </div>
            </div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(99,102,241,0.1)_0%,transparent_70%)]" />
          </Card>
        </div>
      </div>
    </section>

  </section>
</template>
