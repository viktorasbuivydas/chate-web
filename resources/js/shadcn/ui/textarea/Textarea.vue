<script setup lang="ts">
import { useVModel } from "@vueuse/core";
import { cn } from "@/shadcn/";

const props = defineProps<{
    defaultValue?: string | number;
    modelValue?: string | number;
}>();

const emits = defineEmits<{
    (e: "update:modelValue", payload: string | number): void;
}>();

const modelValue = useVModel(props, "modelValue", emits, {
    passive: true,
    defaultValue: props.defaultValue,
});
</script>

<template>
    <textarea v-model="modelValue" :class="cn(
        'flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',
        $attrs.class ?? ''
    )
        " />
</template>
