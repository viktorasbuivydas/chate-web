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
              <DialogCreateConversation/>
            </h2>
            <div class="block w-full overflow-auto">
              <ConversationLink
                  v-for="(conversation, index) in conversations.data" :key="index"
                  :conversation="conversation"
                  :name="conversation.chat_with_members[0]?.name"
                  :displayText="conversation.latest_message?.message"
                  :time="conversation.latest_message?.created_at_hours"
                  avatar=""
              />
            </div>
          </div>
          <div class="col-span-2 border-l pl-4 h-screen max-h-[calc(100vh-150px)] flex flex-col space-y-2 relative"
               ref="wrapper">
            <div class="flex justify-center" v-if="isLoading">
              <Loader/>
              Kraunasi...
            </div>
            <div ref="landmark"></div>
            <div v-if="!isLoading && items.length >= 20" class="flex justify-center text-muted-foreground">Pasieketė pokalbių kanalo
              pabaigą
            </div>
            <ChatMessage
                v-for="(message, index) in messages.data"
                :key="index"
                :message="message"
                :type="message.type"
            />
            <div class="flex flex-row items-center grow space-x-2 absolute bottom-0 w-full">
              <ChatInputForm wrapper-ref="wrapper" :model-value="form.message" :is-loading="isLoading"
                             @handle-submit-form="handleSubmitForm" @update-model-value="updateModelValue"/>
            </div>
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
import {useForm, usePage} from "@inertiajs/vue3";
import ChatInputForm from "@/Components/Forms/ChatInputForm.vue";
import {defineProps, ref} from "vue";
import useInfiniteScrolling from "@/Use/useInfiniteScrolling";
import Loader from "@/Components/Loader.vue";
import useScroll from "@/Use/useScroll.js";

const landmark = ref(null);
const wrapper = ref(null);

const props = defineProps({
  conversations: {
    type: Object,
    required: true,
  },
  conversation: {
    type: Object,
    default: () => usePage().props.conversations[0],
  },
  messages: {
    type: Object,
    required: true,
  },
})

const {items, isLoading} = useInfiniteScrolling('messages', landmark)
const {scrollToBottom} = useScroll()

const form = useForm({
  message: '',
})

const updateModelValue = (value) => {
  form.message = value;
};

const handleSubmitForm = () => {
  isLoading.value = true;

  if (form.message === "") {
    form.message = "👍"
  }

  form.post(route('app.conversations.messages.store', props.conversation), {
    onSuccess: () => {
      isLoading.value = false;
      form.reset();
      scrollToBottom(wrapper.value)
    },
  });
}
</script>
