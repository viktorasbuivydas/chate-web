<template>
    <header class="flex flex-wrap justify-center items-center space-x-2 w-full">
        <Button v-for="item in sidebarNavItems" :key="item.title" :href="route(item.routeName)" as="a" variant="ghost"
            :title="item.title" :class="cn(
                'text-left justify-between space-y-2 group relative',
                checkCurrentRoute(item.routeName) && 'bg-muted hover:bg-muted',
            )">
            <component :is="item.icon" />

            <span v-if="item.count"
                class="group-hover:bg-red-600 right-0 bottom-5 absolute bg-red-500 px-1 rounded-full font-medium text-white text-xs">
                {{ item.count }}
            </span>
        </Button>
    </header>
</template>

<script setup lang="ts">
import { cn } from '@/shadcn/lib/utils'
import { Button } from '@/shadcn/ui/button'
import { Home, MessageCircle, Scroll, Inbox, TrendingUp, Bell, Settings } from 'lucide-vue-next'
import { ref, type Ref, computed } from 'vue';

const checkCurrentRoute = (routeName: string) => {
    return route().current(routeName)
}

interface Item {
    title: string,
    icon: any,
    routeName: string,
    count?: number,
}

const sidebarNavItems: Ref<Item[]> = ref([
    {
        title: 'Pradinis',
        icon: Home,
        routeName: 'app.index',
    },
    {
        title: 'Pokalbiai',
        icon: MessageCircle,
        routeName: 'app.chat.index',
    },
    {
        title: 'Inbox',
        icon: Inbox,
        routeName: 'app.inbox.index',
    },
    {
        title: 'Pranešimai',
        icon: Bell,
        routeName: 'app.notifications.index',
    },
    {
        title: 'Forumas',
        icon: Scroll,
        count: 3,
        routeName: 'app.forum.index',
    },
    {
        title: 'Statistika',
        icon: TrendingUp,
        routeName: 'app.statistics.index',
    },
    {
        title: 'Nustatymai',
        icon: Settings,
        routeName: 'app.settings.index',
    }
])
</script>
