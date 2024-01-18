<template>
    <AppLayout>
        <div class="flex flex-col space-y-2">
            <div
                class="flex flex-col space-y-2 bg-backround border-1 border-input rounded-md p-4"
            >
                <h2 class="px-4">
                    Pokalbių kanalas
                    <span class="text-md"
                    ><Eye class="inline-block ml-2" size="1.3rem"/> ({{
                            activeUsers.length
                        }})</span
                    >
                </h2>

                <div
                    class="relative px-4 flex flex-col space-y-2 w-full overflow-y-auto h-[calc(100vh-250px)]"
                    id="chat"
                    ref="chat"
                    @scroll="handleScroll"
                >
                    <ChatMessage v-for="(message, index) in messages.data" :key="index" :message="message"/>
<!--                    make sure we add 5% offset to the center of the screen-->
                    <div class="fixed bottom-[120px] z-10 left-[45%]" v-if="isThereAnyNewMessage">
                        <Button
                            variant="primary"
                            @click="scrollDown"
                        >
                            <MoveDown class="inline-block mr-2" size="1.3rem"/>
                            Yra naujų žinučių
                        </Button>
                    </div>
                </div>
                <div class="flex flex-row grow justify-end items-end relative">
                    <form class="grow group" @submit.prevent="handleSubmit">
                        <Textarea
                            placeholder="Įveskite žinutę..."
                            v-model="form.message"
                            class="group-hover:bg-gray-800 border grow border-input p-2 pr-30 h-20"
                        />
                        <Button
                            class="absolute bottom-5 right-4"
                            variant="primary"
                            :disabled="isLoading"
                        >
                            <Loader v-if="isLoading"/>
                            Siųsti
                        </Button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Button} from "@/shadcn/ui/button";
import {Textarea} from "@/shadcn/ui/textarea";
import ChatMessage from "@/Components/App/Chat/Message.vue";
import {ref, onMounted} from "vue";
import {Loader, Eye, MoveDown} from "lucide-vue-next";
import useScroll from "@/Use/useScroll";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    messages: {
        type: Object,
        required: true,
    },
})

const fakeMessage = {
    name: "Vardenis",
    message:
        "Sveiki, norėčiau prisijungti prie uždaros bendruomenės.aaaaaaaaaaaaaaaaaa",
};

const isLoading = ref(false);

const form = useForm({
    message: "",
});
const channel = window.Echo.join("chat");
const activeUsers = ref([]);
const bottomChatPositionNumber = ref(0);
const isThereAnyNewMessage = ref(false);
const currentScrollPosition = ref(0);
const handleSubmit = () => {
    isLoading.value = true;
    form.post(route("app.chat.send-message"), {
        onSuccess: () => {
            isLoading.value = false;
            form.reset();
        },
    });
};

const chat = ref(null);
const {scrollToBottom} = useScroll();

onMounted(() => {
    scrollToBottom(chat.value);
    bottomChatPositionNumber.value = chat.value.scrollTop;
    channel
        .here((users) => {
            activeUsers.value = users;
        })
        .joining((user) => {
            activeUsers.value.push(user);
        })
        .leaving((user) => {
            activeUsers.value = activeUsers.value.filter(
                (u) => u.id !== user.id
            );
        });

    window.Echo.channel("chat")
        .listen(".message-sent", (event) => {
            props.messages.data.push(event.chat);
            if (currentScrollPosition.value < bottomChatPositionNumber.value - 30) {
                isThereAnyNewMessage.value = true;
            } else {
                // adding 100ms delay to make sure that the message is rendered before scrolling
                setTimeout(() => {
                    scrollToBottom(chat.value);
                }, 100);
            }

        });
});

const handleScroll = (event) => {
    currentScrollPosition.value = event.target.scrollTop;
};

const scrollDown = () => {
    scrollToBottom(chat.value);
    isThereAnyNewMessage.value = false;
};
</script>
