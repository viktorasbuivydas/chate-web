<template>
    <template v-if="user.id === message.user.id">
        <div class="flex justify-end">
            <ChatMessageRow :message="message" type="mine"/>
        </div>
    </template>
    <template v-else-if="user.id !== message.user.id && message.mentioned_user_id !== user.id">
        <div class="flex justify-start">
            <ChatMessageRow :message="message" type="other"/>
        </div>
    </template>
    <template v-else-if="user.id !== message.user.id && message.mentioned_user_id">
        <div class="flex justify-start">
            <ChatMessageRow :message="message" type="to_me"/>
        </div>
    </template>
</template>

<script setup>
import ChatMessageRow from "@/Components/App/Chat/MessageRow.vue";
import {computed} from "vue";
import {usePage} from '@inertiajs/vue3'

const page = usePage()
const props = defineProps({
    message: {
        type: Object,
        required: true,
    },
});

const user = computed(() => page.props.auth.user)
</script>
