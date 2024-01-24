<template>
  <div class="flex justify-end px-10 pt-4 space-x-4">
    <InboxDropdown :count="inboxCount" @update:open="openedInboxDropdown"/>
    <NotificationsDropdown/>
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
import InboxDropdown from "@/Components/App/Dropdowns/Inbox.vue";
import NotificationsDropdown from "@/Components/App/Dropdowns/Notifications.vue";
import {usePage} from "@inertiajs/vue3";

var channel = window.Echo.join('online');
const notifications = window.Echo.private('notifications.' + usePage().props.auth.user.uuid);

const activeUsers = ref([]);
const inboxCount = ref(0);

onMounted(() => {
  channel.here((users) => {
    activeUsers.value = users;
  });

  notifications.listen(".inbox-message-sent", (e) => {
    // inboxCount.value++;
    console.log(e)
    console.log('got event!!!')
  });
})
</script>
