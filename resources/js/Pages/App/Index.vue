<template>
  <AppLayout>
    <img src="https://chat.us.lt/img/logo-kaledinis.png" alt="logo" width="300" class="mx-auto">
    <div
      class="group mx-auto w-100 flex flex-col justify-center items-center border border-border text-foreground hover:bg-muted p-2 rounded-md">
      <b class="">Topic:</b>
      <div>Work in progress! ;)</div>
      <div>( <a href="" class="text-blue-500 group-hover:text-blue-300 font-semibold">Merkurijus</a> )</div>
      <div>(<span class="text-xs">Parašė: 2024m. Sausio 05d. - 18val. 15min.</span>)</div>
    </div>
    <div>
      newest project updates/posts
    </div>
    <div>
      newest chat mentions
    </div>
    <div>
      newest tutorials
    </div>
    <div>
      newest scripts
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
