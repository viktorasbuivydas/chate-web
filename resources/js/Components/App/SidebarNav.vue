<template>
  <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">
    <Button
        v-for="item in sidebarNavItems"
        :key="item.title"
        as="a"
        :href="route(item.routeName)"
        variant="ghost"
        :class="cn(
        'w-full text-left justify-between space-x-2 group',
        checkCurrentRoute(item.routeName) && 'bg-muted hover:bg-muted',
      )"
    >
      <span>{{ item.title }}</span>
      <span v-if="item.count" class="text-xs font-medium bg-muted group-hover:bg-background text-white p-2 rounded-lg">
        {{ item.count }} / {{ item.total }}
        </span>
    </Button>
  </nav>
</template>

<script setup lang="ts">
import {cn} from '@/shadcn/lib/utils'
import {Button} from '@/shadcn/ui/button'

const checkCurrentRoute = (routeName: string) => {
  return route().current(routeName)
}

interface Item {
  title: string
  href: string
}

const sidebarNavItems: Item[] = [
  {
    title: 'Pradinis',
    routeName: 'app.index',
  },
  {
    title: 'Pokalbiai',
    routeName: 'app.chat.index',
  },
  {
    title: 'Forumas',
    count: 3,
    total: 10,
    routeName: 'app.forum.index',
  }
]
</script>
