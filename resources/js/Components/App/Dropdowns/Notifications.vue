<script setup lang="ts">
import { Button } from '@/shadcn/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/shadcn/ui/dropdown-menu'
import {Bell} from "lucide-vue-next";
import {Avatar, AvatarFallback, AvatarImage} from "@/shadcn/ui/avatar";
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" href="/"
              class="rounded-full border-0 hover:outline bg-background hover:bg-muted hover:outline-input relative">
        <Bell class="inline-block" size="1.3rem"/>
        <span class="absolute top-0 right-0 text-xs text-white bg-red-500 rounded-full w-5 h-5 flex justify-center items-center">
        1
      </span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-80" align="end">
      <DropdownMenuLabel class="font-normal flex">
        <div class="flex flex-col space-y-1">
          <p class="text-sm font-medium leading-none">
            Pranešimai (+1)
          </p>
        </div>
      </DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuGroup class="flex flex-col space-y-2 max-h-100 overflow-y-auto">
        <!--        new message-->
        <DropdownMenuItem class="flex justify-between">
          <div class="flex space-x-2 text-white font-bold">
            <Avatar class="h-8 w-8">
              <AvatarImage src="/avatars/01.png" alt="@shadcn" />
              <AvatarFallback>SC</AvatarFallback>
            </Avatar>
            <div class="flex flex-col">
              <div>test test test</div>
              <div class="text-xs text-white">You sent an attachement * 5h</div>
            </div>
          </div>
          <span class="text-xs text-white bg-blue-500 rounded-full w-2 h-2 flex justify-center items-center">
          </span>
        </DropdownMenuItem>

        <DropdownMenuItem class="flex space-x-2" v-for="index in 10">
          <Avatar class="h-8 w-8">
            <AvatarImage src="/avatars/01.png" alt="@shadcn" />
            <AvatarFallback>SC</AvatarFallback>
          </Avatar>
          <div class="flex flex-col">
            <div>test test test</div>
            <div class="text-xs text-muted-foreground">You sent an attachement * 5h</div>
          </div>
        </DropdownMenuItem>
      </DropdownMenuGroup>
      <DropdownMenuSeparator />
    </DropdownMenuContent>
  </DropdownMenu>
</template>
