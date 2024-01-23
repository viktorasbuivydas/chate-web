<template>
  <AppWithoutRightSidebarLayout>
    <div class="flex flex-col space-y-2 w-full">
      <div
          class="flex flex-col space-y-2 bg-backround border-1 border-input rounded-md p-4"
      >

        <div class="grid grid-cols-3 gap-4">
          <div class="flex flex-col space-y-2 w-full">
            <h2 class="flex justify-between">
              Žinutės
              <DialogCreateConversation />
            </h2>
            <div v-for="(conversation, index) in conversations.data" :key="index" class="block w-full overflow-auto">
              <ConversationLink
                  :conversation="conversation"
                  :name="conversation.members[0]?.name"
                  :displayText="conversation.latest_message.message"
                  :time="conversation.latest_message.created_at_hours"
                  avatar=""
              />
            </div>
          </div>
          <div class="col-span-2 border-l pl-4 h-[calc(100vh-150px)] max-h-screen">
            <ChatMessage
                v-for="(message, index) in messages.data"
                :key="index"
                :message="message"
                :type="message.type"
            />
          </div>
        </div>
      </div>
    </div>
  </AppWithoutRightSidebarLayout>
</template>

<script setup>
import AppWithoutRightSidebarLayout from "@/Layouts/AppWithoutRightSidebarLayout.vue";
import ConversationLink from "@/Components/Buttons/CoversationLink.vue";
import ChatMessage from "@/Components/App/Chat/Message.vue";
import DialogCreateConversation from "@/Components/Dialogs/CreateConversation.vue";

const props = defineProps({
  conversations: {
    type: Object,
    required: true,
  },
  messages: {
    type: Object,
    required: true,
  },
})
</script>
