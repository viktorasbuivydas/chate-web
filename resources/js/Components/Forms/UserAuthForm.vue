<template>
    <div :class="cn('grid gap-6', $attrs.class ?? '')">
        <form @submit.prevent="onSubmit">
            <div class="grid gap-2">
                <div class="grid gap-1">
                    <Label class="sr-only" for="email">
                        El. pašto adresas
                    </Label>
                    <Input
                        id="email"
                        placeholder="name@example.com"
                        type="email"
                        auto-capitalize="none"
                        auto-complete="email"
                        auto-correct="off"
                        :disabled="isLoading"
                    />
                </div>
                <div class="grid gap-1">
                    <Label class="sr-only" for="phone"> Tikslas </Label>
                    <Textarea
                        id="reason"
                        placeholder="Kodėl norite prisijungti?"
                        :disabled="isLoading"
                        auto-capitalize="none"
                        auto-correct="off"
                    />
                </div>
                <Button :disabled="isLoading" variant="primary">
                    <Loader
                        v-if="isLoading"
                        class="mr-2 h-4 w-4 animate-spin"
                    />
                    Gauti registracijos kodą
                </Button>
            </div>
        </form>
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t" />
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-background px-2 text-muted-foreground">
                    Arba tęskite su
                </span>
            </div>
        </div>
        <form @submit.prevent="googleAuth" class="flex w-full">
            <Button
                variant="outline"
                type="submit"
                :disabled="isLoading"
                class="grow"
            >
                <Loader v-if="isLoading" class="mr-2 h-4 w-4 animate-spin" />
                <Mail v-else class="mr-2 h-4 w-4" />
                Google
            </Button>
        </form>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Loader, Mail } from "lucide-vue-next";

import { cn } from "@/shadcn/lib/utils";
import { Button } from "@/shadcn/ui/button";
import { Input } from "@/shadcn/ui/input";
import { Label } from "@/shadcn/ui/label";
import { Textarea } from "@/shadcn/ui/textarea";

const isLoading = ref(false);

async function onSubmit() {
    isLoading.value = true;

    setTimeout(() => {
        isLoading.value = false;
    }, 3000);
}

async function googleAuth() {
    isLoading.value = true;

    setTimeout(() => {
        isLoading.value = false;
        window.location.href = "auth/google/redirect";
    }, 3000);
}
</script>
