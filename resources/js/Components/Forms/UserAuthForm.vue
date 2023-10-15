<template>
    <div :class="cn('grid gap-6', $attrs.class ?? '')">
        <form @submit="onSubmit">
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
                    <Label class="sr-only" for="phone">
                        Telefono numeris
                    </Label>
                    <Input
                        id="phone"
                        placeholder="3706000000"
                        maxlength="12"
                        type="number"
                        auto-capitalize="none"
                        auto-complete="phone"
                        auto-correct="off"
                        :disabled="isLoading"
                    />
                </div>
                <Button :disabled="isLoading">
                    <Loader v-if="isLoading" class="mr-2 h-4 w-4 animate-spin"/>
                    Gauti registracijos kodą
                </Button>
            </div>
        </form>
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t"/>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
        <span class="bg-background px-2 text-muted-foreground">
          Arba tęskite su
        </span>
            </div>
        </div>
        <Button variant="outline" type="button" :disabled="isLoading">
            <Loader v-if="isLoading" class="mr-2 h-4 w-4 animate-spin"/>
            <Github v-else class="mr-2 h-4 w-4"/>
            GitHub
        </Button>
    </div>
</template>

<script setup lang="ts">
import {ref} from 'vue'
import {Loader, Github} from 'lucide-vue-next';

import {cn} from '@/shadcn/lib/utils'
import {Button} from '@/shadcn/ui/button'
import {Input} from '@/shadcn/ui/input'
import {Label} from '@/shadcn/ui/label'

const isLoading = ref(false)

async function onSubmit(event: Event) {
    event.preventDefault()
    isLoading.value = true

    setTimeout(() => {
        isLoading.value = false
    }, 3000)
}
</script>
