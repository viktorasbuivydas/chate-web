<template>
  <div class="flex justify-end px-10 pt-4 space-x-4">
    <Button variant="ghost" href="/"
            class="rounded-full border-0 hover:outline bg-background hover:bg-muted hover:outline-input relative">
      <MessageSquare class="inline-block" size="1.3rem"/>
      <span class="absolute top-0 right-0 text-xs text-white bg-red-500 rounded-full w-5 h-5 flex justify-center items-center">
        1
      </span>
    </Button>
    <Button variant="ghost" href="/"
            class="rounded-full border-0 hover:outline bg-background hover:bg-muted hover:outline-input relative">
      <Bell class="inline-block" size="1.3rem"/>
      <span class="absolute top-0 right-0 text-xs text-white bg-red-500 rounded-full w-5 h-5 flex justify-center items-center">
        1
      </span>
    </Button>
    <UserNavigation/>
  </div>
  <div class="hidden space-y-6 px-4 pt-10 md:flex relative">
    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 lg:space-y-0 grow h-[calc(100%-200px)]">
      <div class="flex flex-col w-full">
        <SidebarNav/>
      </div>
      <div class="col-span-9">
        <slot/>
      </div>
      <div class="col-span-2 w-full">
        <RightSidebarNav :active-users="activeUsers"/>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import SidebarNav from '@/Components/App/SidebarNav.vue'
import UserNavigation from "@/Components/App/Dropdowns/UserNavigation.vue";
import {onMounted, ref} from "vue";
import RightSidebarNav from "@/Components/App/RightSidebarNav.vue";
import Button from "@/shadcn/ui/button/Button.vue";
import {MessageSquare, Bell} from 'lucide-vue-next';

var channel = window.Echo.join('online');
const activeUsers = ref([]);

onMounted(() => {
  channel.here((users) => {
    activeUsers.value = users;
  });
})

</script>
