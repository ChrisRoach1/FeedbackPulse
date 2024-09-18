<script setup lang="ts">
import { Home, Menu, Package2 } from 'lucide-vue-next'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuGroup, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu'
import { Link } from '@inertiajs/vue3';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet'
import {Button} from "@/Components/ui/button";
</script>

<template>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                    <a href="/" class="flex items-center gap-2 font-semibold">
                        <span class="">Pulseback</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
                        <a :href="route('dashboard')" class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary" :class="{'bg-muted text-primary': route().current('dashboard')}">
                            <Home class="h-4 w-4" />
                            Dashboard
                        </a>
                      <a :href="route('allQuestionnaires')" class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary" :class="{'bg-muted text-primary': route().current('allQuestionnaires')}">
                        <Home class="h-4 w-4" />
                        All Questionnaires
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
                                <span class="sr-only">Pulseback</span>
                            </a>
                            <a :href="route('dashboard')" class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground" :class="{'bg-muted': route().current('dashboard')}">
                                <Home class="h-5 w-5" />
                                Dashboard
                            </a>
                          <a :href="route('allQuestionnaires')" class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground" :class="{'bg-muted': route().current('allQuestionnaires')}">
                            <Home class="h-5 w-5" />
                            All Questionnaires
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
            </main>
        </div>
    </div>
</template>


