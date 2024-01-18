<template>
  <div class="flex justify-end px-10 pt-4">
    <UserNavigation/>
  </div>
  <div class="hidden space-y-6 px-4 pt-10 md:flex relative">
    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 lg:space-y-0 grow h-[calc(100%-200px)]">
      <div class="flex flex-col w-full">
        <SidebarNav />
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
import {computed, onMounted, onUnmounted, ref} from "vue";
import RightSidebarNav from "@/Components/App/RightSidebarNav.vue";

var channel = window.Echo.join('online');
const activeUsers = ref([]);

onMounted(() => {
  channel.here((users) => {
    activeUsers.value = users;
  });
})

</script>
