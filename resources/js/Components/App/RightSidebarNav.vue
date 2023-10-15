<template>
  <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1 w-full lg:w-[200px]">
    <template v-if="activeUsers.length > 0">
      <Button
          v-for="item in activeUsers"
          :key="item.name"
          as="a"
          variant="outline"
          :class="cn(
        'text-left justify-between space-x-2 group justify-between',
      )"
      >
        <span>{{ item.name }}</span>
        <div>
          Online
        </div>
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
