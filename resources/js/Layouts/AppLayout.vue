<template>
  <div class="flex justify-end px-10 pt-4">
    <UserNavigation/>
  </div>
  <div class="hidden space-y-6 p-10 pb-16 md:flex relative">
    <!--        headline-->
    <!--        <div class="space-y-0.5">-->
    <!--            <h2 class="text-2xl font-bold tracking-tight">-->
    <!--                Nustatymai-->
    <!--            </h2>-->
    <!--            <p class="text-muted-foreground">-->
    <!--                Valdykite savo paskyrą-->
    <!--            </p>-->
    <!--        </div>-->
    <!--        <Separator class="my-6" />-->
    <div class="flex flex-col md:flex-row space-y-8 lg:flex-row lg:space-x-12 lg:space-y-0 grow h-[1000px]">
      <SidebarNav />
      <div class="flex flex-col pl-[200px] pr-[250px] grow">
          <slot/>
      </div>
      <RightSidebarNav :active-users="activeUsers"/>
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
