<template>
    <div class="flex flex-col space-y-2" :id="'message-'+ message.id ">
      {{ message.id }}
        <div>{{ message.user.name }}:</div>

        <div
            class="p-2 max-w-100 rounded-md"
            :class="
                type === 'mine'
                    ? 'bg-blue-500'
                    : type === 'other'
                    ? 'bg-purple-500'
                    : type === 'to_me'
                    ? 'bg-yellow-500'
                    : ''
            "
        >
            <div>{{ message.message }}</div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    message: {
        type: Object,
        required: true,
    },
    type: {
        type: String,
        default: "mine",
    },
});
</script>
