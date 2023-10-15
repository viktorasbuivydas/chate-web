<template>
    <div>
        <h3 class="text-lg font-medium">
            Profile
        </h3>
        <p class="text-sm text-muted-foreground">
            This is how others will see you on the site.
        </p>
    </div>
    <Separator />
    <form class="space-y-8">
        <FormField v-slot="{ componentField }" name="username">
            <FormItem>
                <FormLabel>Username</FormLabel>
                <FormControl>
                    <Input type="text" placeholder="shadcn" v-bind="componentField" />
                </FormControl>
                <FormDescription>
                    This is your public display name. It can be your real name or a pseudonym. You can only change this once every 30 days.
                </FormDescription>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="email">
            <FormItem>
                <FormLabel>Email</FormLabel>

                <Select v-bind="componentField">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Select an email" />
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem v-for="email in verifiedEmails" :key="email" :value="email">
                                {{ email }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormDescription>
                    You can manage verified email addresses in your email settings.
                </FormDescription>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="bio">
            <FormItem>
                <FormLabel>Bio</FormLabel>
                <FormControl>
                    <Textarea placeholder="Tell us a little bit about yourself" v-bind="componentField" />
                </FormControl>
                <FormDescription>
                    You can <span>@mention</span> other users and organizations to link to them.
                </FormDescription>
                <FormMessage />
            </FormItem>
        </FormField>

        <div class="flex gap-2 justify-start">
            <Button type="submit">
                Update profile
            </Button>

            <Button
                type="button"
                variant="outline"
                @click="resetForm"
            >
                Reset form
            </Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { cn } from '@/shadcn/lib/utils'

import { Input } from '@/shadcn/ui/input'
import { Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/shadcn/ui/form'
import { Separator } from '@/shadcn/ui/separator'
import { Textarea } from '@/shadcn/ui/textarea'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/shadcn/ui/select'
import { Button } from '@/shadcn/ui/button'

const verifiedEmails = ref(['m@example.com', 'm@google.com', 'm@support.com'])

</script>
