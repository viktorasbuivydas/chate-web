<template>
    <div class="flex justify-end px-10 pt-4">
        <UserNavigation />
    </div>
    <div class="hidden space-y-6 p-10 pb-16 md:block">
<!--        headline-->
<!--        <div class="space-y-0.5">-->
<!--            <h2 class="text-2xl font-bold tracking-tight">-->
<!--                Nustatymai-->
<!--            </h2>-->
<!--            <p class="text-muted-foreground">-->
<!--                Valdykite savo paskyrą-->
<!--            </p>-->
<!--        </div>-->
<!--        <Separator class="my-6" />-->
        <div class="flex flex-col space-y-8 lg:flex-row lg:space-x-12 lg:space-y-0">
            <aside class="-mx-4 lg:w-1/5">
                <SidebarNav />
            </aside>
            <div class="flex-1 lg:max-w-2xl">
                <div class="space-y-6">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import SidebarNav from '@/Components/App/SidebarNav.vue'
import { Separator } from '@/shadcn/ui/separator'
import UserNavigation from "@/Components/App/Dropdowns/UserNavigation.vue";
</script>
