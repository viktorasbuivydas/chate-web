<template>
    <nav class="flex space-x-2 flex-col lg:space-x-0 lg:space-y-1 w-full justify-center items-center">
        <Button
            v-for="item in sidebarNavItems"
            :key="item.title"
            :href="route(item.routeName)"
            as="a"
            variant="ghost"
            :title="item.title"
            :class="cn(
        'text-left justify-between space-y-2 group relative',
        checkCurrentRoute(item.routeName) && 'bg-muted hover:bg-muted',
      )"
        >
            <component :is="item.icon" />

            <span v-if="item.count"
                  class="absolute right-0 bottom-5 text-xs font-medium bg-red-500 group-hover:bg-red-600 text-white px-1 rounded-full">
            {{ item.count }}
            </span>
        </Button>
    </nav>
</template>

<script setup lang="ts">
import {cn} from '@/shadcn/lib/utils'
import {Button} from '@/shadcn/ui/button'
import {Home, MessageCircle, Scroll} from 'lucide-vue-next'

const checkCurrentRoute = (routeName: string) => {
    return route().current(routeName)
}

interface Item {
    title: string,
    icon: any,
    routeName: string,
    count?: number,
}

const sidebarNavItems: Item[] = [
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
        title: 'Forumas',
        icon: Scroll,
        count: 3,
        routeName: 'app.forum.index',
    }
]
</script>
