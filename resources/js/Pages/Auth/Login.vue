<template>
    <div
        class="relative hidden h-[800px] flex-col items-center justify-center md:grid lg:max-w-none lg:px-0">
        <a
            href="/examples/authentication"
            :class="cn(
        buttonVariants({ variant: 'ghost' }),
        'absolute right-4 top-4 md:right-8 md:top-8',
      )"
        >
            Registruotis
        </a>
        <div class="lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <div class="flex flex-col space-y-2 text-center">
                    <h1 class="text-2xl font-semibold tracking-tight">
                       Prisijungti
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Suveskite savo duomenis norėdami prisijungti.
                    </p>
                </div>
                <UserLoginForm/>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import UserLoginForm from '@/Components/Forms/UserLoginForm.vue'
import {cn} from '@/shadcn/lib/utils'
import {buttonVariants} from '@/shadcn/ui/button'
</script>
