<template>
  <Button variant="ghost" class="flex space-x-2 justify-start p-2 w-full">
    <Avatar class="h-10 w-10">
      <AvatarImage :src="avatar" alt="@shadcn"/>
      <AvatarFallback>{{ twoLetterName }}</AvatarFallback>
    </Avatar>
    <div class="flex flex-col text-left">
      <div>{{ name }}</div>
      <div class="text-xs text-muted-foreground">{{ trimmedText }} * {{ time }}</div>
    </div>
  </Button>
</template>
<script setup lang="ts">
import {Button} from "@/shadcn/ui/button";
import {Avatar, AvatarFallback, AvatarImage} from "@/shadcn/ui/avatar";
import {computed} from "vue";

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  displayText: {
    type: String,
    required: true,
  },
  time: {
    type: String,
    required: true,
  },
  avatar: {
    type: String,
    required: true,
  },
})

const twoLetterName = computed(() => {
  return props.name.split(' ').map((word) => word[0]).join('')
})

const trimmedText = computed(() => {
  return props.displayText.length > 10 ? props.displayText.substring(0, 10) + '...' : props.displayText
})
</script>
