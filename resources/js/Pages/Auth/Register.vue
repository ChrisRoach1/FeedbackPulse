

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {Label} from "@/Components/ui/label";
import {Input} from "@/Components/ui/input";
import {Button} from "@/Components/ui/button";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/Components/ui/card";

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation');
    },
  });
};

</script>

<template>
  <GuestLayout>
    <Card class="mx-auto max-w-sm">
      <CardHeader>
        <CardTitle class="text-xl">
          Sign Up
        </CardTitle>
        <CardDescription>
          Enter your information to create an account
        </CardDescription>
      </CardHeader>
      <form @submit.prevent="submit">
        <CardContent>
          <div class="grid gap-4">
            <div class="grid grid-cols-1 gap-4">
              <Label for="name">Name</Label>

              <Input
                  id="name"
                  type="text"
                  v-model="form.name"
                  required
                  autofocus
                  autocomplete="name"
              />

              <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="grid gap-2">
              <Label for="email">Email</Label>

              <Input
                  id="email"
                  type="email"
                  v-model="form.email"
                  required
                  autocomplete="username"
              />

              <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="grid gap-2">
              <Label for="password">Password</Label>

              <Input
                  id="password"
                  type="password"
                  v-model="form.password"
                  required
                  autocomplete="new-password"
              />

              <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="grid gap-2">
              <Label for="password_confirmation">Confirm Password</Label>

              <Input
                  id="password_confirmation"
                  type="password"
                  v-model="form.password_confirmation"
                  required
                  autocomplete="new-password"
              />

              <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Create an account
            </Button>
          </div>
          <div class="mt-4 text-center text-sm">
            Already have an account?
            <a :href="route('login')" class="underline">
              Sign in
            </a>
          </div>
        </CardContent>
      </form>

    </Card>
  </GuestLayout>
</template>
