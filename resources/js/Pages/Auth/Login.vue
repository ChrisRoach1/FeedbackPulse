
<script setup lang="ts">
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {Label} from "@/Components/ui/label";
import {Input} from "@/Components/ui/input";
import {Checkbox} from "@/Components/ui/checkbox";
import {Button} from "@/Components/ui/button";

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password');
    },
  });
};

</script>

<template>
  <GuestLayout>
    <Card class="mx-auto max-w-sm">
      <CardHeader>
        <CardTitle class="text-2xl">
          Login
        </CardTitle>
        <CardDescription>
          Enter your email below to login to your account
        </CardDescription>
      </CardHeader>
      <form @submit.prevent="submit">
        <CardContent>
          <div class="grid gap-4">
            <div class="grid gap-2">
              <Label for="email">Email</Label>

              <Input
                  id="email"
                  type="email"
                  v-model="form.email"
                  required
                  autofocus
                  autocomplete="username"
              />

              <InputError class="mt-2" :message="form.errors.email" />

            </div>
            <div class="grid gap-2">
              <div class="flex items-center">
                <Label for="password">Password</Label>
                <a v-if="canResetPassword"
                   :href="route('password.request')" class="ml-auto inline-block text-sm underline">
                  Forgot your password?
                </a>
              </div>
              <Input
                  id="password"
                  type="password"
                  class="mt-1 block w-full"
                  v-model="form.password"
                  required
                  autocomplete="current-password"
              />

              <InputError class="mt-2" :message="form.errors.password" />

            </div>
            <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Login
            </Button>
            <div class="block mt-4">
              <Label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
              </Label>
            </div>
          </div>
          <div class="mt-4 text-center text-sm">
            Don't have an account?
            <a :href="route('register')" class="underline">
              Sign up
            </a>
          </div>
        </CardContent>
      </form>
    </Card>
  </GuestLayout>

</template>
