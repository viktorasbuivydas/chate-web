<template>
  <nav class="flex flex-col space-y-2 lg:flex-col lg:space-x-0 lg:space-y-1 w-full">
    <template v-if="activeUsers.length > 0">
      <Button
          v-for="item in activeUsers"
          :key="item.name"
          as="a"
          variant="outline"
          :class="cn(
        'items-center justify-start text-left space-x-2 group',
      )"
      >
        <span
            class="p-1 text-xs font-medium bg-green-500 group-hover:bg-green-600 text-white px-1 rounded-full">
        </span>
        <span>{{ item.name }}

        </span>

      </Button>
    </template>
    <template v-else>
      <div class="text-muted-foreground">
        Kraunama...
      </div>
    </template>
  </nav>
</template>

<script setup lang="ts">
import {cn} from '@/shadcn/lib/utils'
import {Button} from '@/shadcn/ui/button'

defineProps({
  activeUsers: {
    type: Array,
    required: true
  }
})
</script>
