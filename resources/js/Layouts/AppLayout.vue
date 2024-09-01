<template>
  <div class="flex flex-col space-y-2 pt-4 container">
    <MainMenu />
    <div class="flex flex-col space-y-2">

      <slot />
    </div>
    <template>
      <div v-if="!hideBottomBar">
        <div class="flex flex-col space-y-2 pt-4 border-t border-t-border max-w-10 text-center">
          <div class="flex justify-center items-center space-x-1">
            <Radio />
            <div>Naršo: {{ online }}</div>
          </div>
          <div class="flex justify-center items-center space-x-1">
            <LogOut />
            <Link href="/logout"> Atsijungti</Link>
          </div>

        </div>
        <footer class="flex flex-col space-y-2 pt-4 text-center text-muted-foreground text-xs">
          <div>Projektas: Chate.lt {{ new Date().getFullYear() }}</div>
          <div class="flex justify-center items-center">
            <a href="https://github.com/viktorasbuivydas/chate-web" target="_blank">
              <Github />
            </a>
          </div>
        </footer>
      </div>
    </template>
  </div>
</template>

<script setup lang="ts">
import MainMenu from "@/Components/App/Menu/MainMenu.vue";
import { onMounted, ref, computed } from "vue";
import { usePage } from '@inertiajs/vue3';
import { Github, Radio, LogOut } from "lucide-vue-next";
import { Link } from '@inertiajs/vue3';

defineProps({
  hideBottomBar: {
    type: Boolean,
    default: false,
  },
});

const online = computed(() => {
  return usePage().props.online;
})

</script>
