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
                    <div class="grow group">
                        <Textarea
                            placeholder="Įveskite žinutę..."
                            class="group-hover:bg-gray-800 border grow border-input p-2 pr-30 h-20"
                        />
                        <Button
                            class="absolute bottom-4 right-4"
                            variant="primary"
                        >
                            Siųsti
                        </Button>
                    </div>
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

const fakeMessage = {
    name: "Vardenis",
    message:
        "Sveiki, norėčiau prisijungti prie uždaros bendruomenės.aaaaaaaaaaaaaaaaaa",
};
</script>
