import ChatMessage from '@/Components/App/Chat/Message.vue';
<template>
    <template v-if="type === 'mine'">
        <div class="grow flex justify-end">
            <ChatMessageRow :message="message" type="mine" />
        </div>
    </template>
    <template v-else-if="type === 'other'">
        <div class="grow flex justify-start">
            <ChatMessageRow :message="message" type="other" />
        </div>
    </template>
    <template v-else-if="type === 'to_me'">
        <div class="grow flex justify-start">
            <ChatMessageRow :message="message" type="to_me" />
        </div>
    </template>
</template>

<script setup>
import ChatMessageRow from "@/Components/App/Chat/MessageRow.vue";

const props = defineProps({
    type: {
        type: String,
        default: ["mine", "other", "to_me"],
    },
    message: {
        type: Object,
        required: true,
    },
});
</script>
