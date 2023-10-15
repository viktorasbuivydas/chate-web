<template>
    <div :class="cn('grid gap-6', $attrs.class ?? '')">
        <form @submit.prevent="submit">
            <div class="grid gap-2">
                <div class="grid gap-1">
                    <Label class="sr-only" for="email">
                        El. pašto adresas
                    </Label>
                    <Input
                        id="email"
                        placeholder="El. pašto adresas"
                        type="email"
                        v-model="form.email"
                        auto-capitalize="none"
                        auto-complete="email"
                        auto-correct="off"
                        :disabled="isLoading"
                    />
                </div>
                <div class="grid gap-1">
                    <Label class="sr-only" for="password">
                        Slaptažodis
                    </Label>
                    <Input
                        id="password"
                        placeholder="Slaptažodis"
                        type="password"
                        v-model="form.password"
                        :disabled="isLoading"
                    />
                </div>
                <Button :disabled="isLoading">
                    <Loader v-if="isLoading" class="mr-2 h-4 w-4 animate-spin"/>
                    Prisijungti
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
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    isLoading.value = true

    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            isLoading.value = false
        },
        onError: () => {
            isLoading.value = false

        }
    });
};

const isLoading = ref(false)
</script>
