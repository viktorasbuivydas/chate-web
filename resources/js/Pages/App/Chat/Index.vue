<template>
    <AppLayout>
        <div class="flex flex-col h-screen space-y-2">
            <div
                class="flex flex-col space-y-2 bg-backround border-1 border-input rounded-md p-4"
            >
                <h2 class="px-4">Pokalbių kanalas</h2>

                <div
                    class="px-4 flex flex-col space-y-2 w-full overflow-y-auto h-[calc(100vh-250px)]"
                    id="chat"
                    ref="chat"
                >
                    <ChatMessage type="other" :message="fakeMessage" />
                    <ChatMessage type="mine" :message="fakeMessage" />
                    <ChatMessage type="mine" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
                    <ChatMessage type="to_me" :message="fakeMessage" />
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
                            <Loader v-if="isLoading" />
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
import { Button } from "@/shadcn/ui/button";
import { Textarea } from "@/shadcn/ui/textarea";
import ChatMessage from "@/Components/App/Chat/Message.vue";
import { ref, onMounted } from "vue";
import { Loader } from "lucide-vue-next";
import useScroll from "@/Use/useScroll";
import { useForm } from "@inertiajs/vue3";

const fakeMessage = {
    name: "Vardenis",
    message:
        "Sveiki, norėčiau prisijungti prie uždaros bendruomenės.aaaaaaaaaaaaaaaaaa",
};

const isLoading = ref(false);

const form = useForm({
    message: "",
});

const handleSubmit = () => {
    isLoading.value = true;
    setTimeout(() => {
        isLoading.value = false;
    }, 1000);
};

const chat = ref(null);
const { scrollToBottom } = useScroll();

onMounted(() => {
    scrollToBottom(chat.value);
});
</script>
