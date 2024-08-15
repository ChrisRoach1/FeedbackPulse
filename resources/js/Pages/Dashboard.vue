<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Activity, ArrowUpRight, CreditCard, DollarSign, Users } from 'lucide-vue-next'
import { Button } from '@/Components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table'

</script>



<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <template #header>
            <h1>Dashboard</h1>
        </template>

        <div class="grid gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-4">
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium">
                        Total Revenue
                    </CardTitle>
                    <DollarSign class="h-4 w-4 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        $45,231.89
                    </div>
                    <p class="text-xs text-muted-foreground">
                        +20.1% from last month
                    </p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium">
                        Subscriptions
                    </CardTitle>
                    <Users class="h-4 w-4 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        +2350
                    </div>
                    <p class="text-xs text-muted-foreground">
                        +180.1% from last month
                    </p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium">
                        Sales
                    </CardTitle>
                    <CreditCard class="h-4 w-4 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        +12,234
                    </div>
                    <p class="text-xs text-muted-foreground">
                        +19% from last month
                    </p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium">
                        Active Now
                    </CardTitle>
                    <Activity class="h-4 w-4 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        +573
                    </div>
                    <p class="text-xs text-muted-foreground">
                        +201 since last hour
                    </p>
                </CardContent>
            </Card>
        </div>
        <div class="grid gap-4 md:gap-8 lg:grid-cols-2 xl:grid-cols-3">
            <Card class="xl:col-span-2">
                <CardHeader class="flex flex-row items-center">
                    <div class="grid gap-2">
                        <CardTitle>Tasks</CardTitle>
                        <CardDescription>
                            Tasks to crush.
                        </CardDescription>
                    </div>
                    <Button as-child size="sm" class="ml-auto gap-1">
                        <a href="#">
                            View All
                            <ArrowUpRight class="h-4 w-4" />
                        </a>
                    </Button>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Task</TableHead>
                                <TableHead class="hidden xl:table-column">
                                    Type
                                </TableHead>
                                <TableHead class="text-right">
                                    Crush it
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Liam Johnson
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        liam@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="text-right">
                                    $250.00
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
            <Card>
                <CardHeader>
                    <CardTitle>Recent Notes</CardTitle>
                </CardHeader>
                <CardContent class="grid gap-8">

                </CardContent>
            </Card>
        </div>

    </AuthenticatedLayout>
</template>
