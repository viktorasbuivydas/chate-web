<template>
  <div :class="cn('grid gap-6', $attrs.class ?? '')">
    <div class="relative">
      <div class="absolute inset-0 flex items-center">
        <span class="w-full border-t"/>
      </div>
      <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-background px-2 text-muted-foreground">
                    Jau turite paskyrą?
                </span>
      </div>
    </div>
    <Button
        variant="outline"
        as="a"
        href="/auth/google/redirect"
        type="submit"
        @click="isLoading = true"
        :disabled="isLoading"
        class="grow"
    >
      <Loader v-if="isLoading" class="mr-2 h-4 w-4 animate-spin"/>
      <Mail v-else class="mr-2 h-4 w-4"/>
      Jungtis naudojant GMAIL
    </Button>
  </div>
</template>

<script setup lang="ts">
import {ref} from "vue";
import {Mail} from "lucide-vue-next";
import Loader from "@/Components/Loader.vue";

import {cn} from "@/shadcn/lib/utils";
import {Button} from "@/shadcn/ui/button";
import {Input} from "@/shadcn/ui/input";
import {Label} from "@/shadcn/ui/label";
import {Textarea} from "@/shadcn/ui/textarea";

const isLoading = ref(false);

async function onSubmit() {
  isLoading.value = true;

  setTimeout(() => {
    isLoading.value = false;
  }, 3000);
}
</script>
