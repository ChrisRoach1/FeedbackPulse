<script setup lang="ts">

import {Button} from "@/Components/ui/button";

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/Components/ui/tabs';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Example Dashboard" />

    <AuthenticatedLayout>

        <template #header>
            <h1>Test</h1>
        </template>

    </AuthenticatedLayout>

</template>
