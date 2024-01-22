<template>
  <AppLayout>
    <div class="flex flex-col space-y-2">
      <div
          class="flex flex-col space-y-2 bg-backround border-1 border-input rounded-md p-4"
      >

        <div class="grid grid-cols-3 gap-4">
          <div class="flex flex-col space-y-2 w-full max-w-[300px]">
            <h2>
              Žinutės
            </h2>
            <div v-for="(conversation, index) in conversations.data" :key="index" class="block w-full overflow-auto">
              <ConversationLink
                  :name="conversation.members[0].name"
                  :displayText="conversation.latest_message.message"
                  :time="conversation.latest_message.created_at_hours"
                  avatar=""
              />
            </div>
          </div>
          <div class="col-span-2 border-l pl-4 h-[calc(100vh-150px)] max-h-screen">
            mainmainmainmain
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Button} from "@/shadcn/ui/button";
import {Avatar, AvatarFallback, AvatarImage} from "@/shadcn/ui/avatar";
import ConversationLink from "@/Components/Buttons/CoversationLink.vue";

const props = defineProps({
  conversations: {
    type: Object,
    required: true,
  },
})
</script>
