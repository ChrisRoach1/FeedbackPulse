<script setup lang="ts">
import { Bell, CircleUser, Home, LineChart, Menu, Package, Package2, Search, ShoppingCart, Users } from 'lucide-vue-next'

import { Badge } from '@/Components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuGroup, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu'
import { Link } from '@inertiajs/vue3';
import { Input } from '@/Components/ui/input'
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet'
import {Button} from "@/Components/ui/button";
</script>

<template>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                    <a href="/" class="flex items-center gap-2 font-semibold">
                        <Package2 class="h-6 w-6" />
                        <span class="">Task.dev</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
                        <a :href="route('dashboard')" class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary" :class="{'bg-muted text-primary': route().current('dashboard')}">
                            <Home class="h-4 w-4" />
                            Dashboard
                        </a>
                        <a :href="route('example')" class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary" :class="{'bg-muted text-primary': route().current('example')}" >
                            <LineChart class="h-4 w-4" />
                            Analytics
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <header class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
                <Sheet>
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <Menu class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <a href="#" class="flex items-center gap-2 text-lg font-semibold">
                                <span class="sr-only">Task.dev</span>
                            </a>
                            <a :href="route('dashboard')" class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground" :class="{'bg-muted': route().current('dashboard')}">
                                <Home class="h-5 w-5" />
                                Dashboard
                            </a>
                            <a :href="route('example')" class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground" :class="{'bg-muted': route().current('example')}">
                                <LineChart class="h-5 w-5" />
                                Analytics
                            </a>
                        </nav>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1">

                </div>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="ghost">
                            {{ $page.props.auth.user.name }}
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuGroup>
                            <DropdownMenuItem>
                                <Link :href="route('profile.edit')">
                                    My Profile </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem>
                                <Link :href="route('logout')" method="post">Logout </Link>
                            </DropdownMenuItem>
                        </DropdownMenuGroup>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <div class="flex items-center" v-if="$slots.header">
                    <h1 class="text-lg font-semibold md:text-2xl">
                        <slot name="header" />
                    </h1>
                </div>
                <slot />
<!--                <div class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm">-->
<!--                    <div class="flex flex-col items-center gap-1 text-center">-->
<!--                        <h3 class="text-2xl font-bold tracking-tight">-->
<!--                            You have no products-->
<!--                        </h3>-->
<!--                        <p class="text-sm text-muted-foreground">-->
<!--                            You can start selling as soon as you add a product.-->
<!--                        </p>-->
<!--                        <Button class="mt-4">-->
<!--                            Add Product-->
<!--                        </Button>-->
<!--                    </div>-->
<!--                </div>-->
            </main>
        </div>
    </div>
</template>




<!--<script setup lang="ts">-->
<!--import { ref } from 'vue';-->
<!--import ApplicationLogo from '@/Components/ApplicationLogo.vue';-->
<!--import NavLink from '@/Components/NavLink.vue';-->
<!--import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';-->
<!--import { Link } from '@inertiajs/vue3';-->
<!--import {DropdownMenu, DropdownMenuContent,DropdownMenuItem,DropdownMenuTrigger,DropdownMenuGroup} from "@/Components/ui/dropdown-menu";-->
<!--import {Button} from "@/Components/ui/button";-->

<!--const showingNavigationDropdown = ref(false);-->
<!--</script>-->

<!--<template>-->
<!--    <div>-->
<!--        <div class="min-h-screen bg-gray-100">-->
<!--            <nav class="bg-white border-b border-gray-100">-->
<!--                &lt;!&ndash; Primary Navigation Menu &ndash;&gt;-->
<!--                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->
<!--                    <div class="flex justify-between h-16">-->
<!--                        <div class="flex">-->
<!--                            &lt;!&ndash; Logo &ndash;&gt;-->
<!--                            <div class="shrink-0 flex items-center">-->
<!--                                <Link :href="route('dashboard')">-->
<!--                                    <ApplicationLogo-->
<!--                                        class="block h-9 w-auto fill-current text-gray-800"-->
<!--                                    />-->
<!--                                </Link>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Navigation Links &ndash;&gt;-->
<!--                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">-->
<!--                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                                    Dashboard-->
<!--                                </NavLink>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="hidden sm:flex sm:items-center sm:ms-6">-->
<!--                            &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
<!--                            <div class="ms-3 relative">-->
<!--                                <DropdownMenu>-->
<!--                                    <DropdownMenuTrigger as-child>-->
<!--                                        <Button variant="ghost">-->
<!--                                            {{ $page.props.auth.user.name }}-->
<!--                                        </Button>-->
<!--                                    </DropdownMenuTrigger>-->
<!--                                    <DropdownMenuContent>-->
<!--                                        <DropdownMenuGroup>-->
<!--                                            <DropdownMenuItem>-->
<!--                                                <Link :href="route('profile.edit')">-->
<!--                                                    My Profile </Link>-->
<!--                                            </DropdownMenuItem>-->
<!--                                            <DropdownMenuItem>-->
<!--                                                <Link :href="route('logout')">-->
<!--                                                    Logout </Link>-->
<!--                                            </DropdownMenuItem>-->
<!--                                        </DropdownMenuGroup>-->
<!--                                    </DropdownMenuContent>-->
<!--                                </DropdownMenu>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; Hamburger &ndash;&gt;-->
<!--                        <div class="-me-2 flex items-center sm:hidden">-->
<!--                            <button-->
<!--                                @click="showingNavigationDropdown = !showingNavigationDropdown"-->
<!--                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"-->
<!--                            >-->
<!--                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: showingNavigationDropdown,-->
<!--                                            'inline-flex': !showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M4 6h16M4 12h16M4 18h16"-->
<!--                                    />-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: !showingNavigationDropdown,-->
<!--                                            'inline-flex': showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M6 18L18 6M6 6l12 12"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Responsive Navigation Menu &ndash;&gt;-->
<!--                <div-->
<!--                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"-->
<!--                    class="sm:hidden"-->
<!--                >-->
<!--                    <div class="pt-2 pb-3 space-y-1">-->
<!--                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                            Dashboard-->
<!--                        </ResponsiveNavLink>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Responsive Settings Options &ndash;&gt;-->
<!--                    <div class="pt-4 pb-1 border-t border-gray-200">-->
<!--                        <div class="px-4">-->
<!--                            <div class="font-medium text-base text-gray-800">-->
<!--                                {{ $page.props.auth.user.name }}-->
<!--                            </div>-->
<!--                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>-->
<!--                        </div>-->

<!--                        <div class="mt-3 space-y-1">-->
<!--                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>-->
<!--                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">-->
<!--                                Log Out-->
<!--                            </ResponsiveNavLink>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </nav>-->


<!--            &lt;!&ndash; Page Content &ndash;&gt;-->
<!--            <main>-->
<!--                <slot />-->
<!--            </main>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
