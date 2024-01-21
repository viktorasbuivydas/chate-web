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
          <div class="flex justify-center" v-if="isLoading">
            <Loader/>
            Kraunasi...
          </div>
          <div ref="landmark"></div>
          <div v-if="!isLoading && items.length >= 20" class="flex justify-center text-muted-foreground">Pasieketė pokalbių kanalo
            pabaigą
          </div>
          <ChatMessage v-for="(message, index) in items" :key="index" :message="message"/>
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
                        <Input
                            placeholder="Įveskite žinutę..."
                            v-model="form.message"
                            class="group-hover:bg-gray-800 border grow border-input p-2 pr-30 h-20"
                        />
            <Button
                class="absolute bottom-5 right-4"
                variant="primary"
                :disabled="isLoading || form.message === ''"
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
import ChatMessage from "@/Components/App/Chat/Message.vue";
import {ref, onMounted, computed, onUnmounted} from "vue";
import {Eye, MoveDown} from "lucide-vue-next";
import Loader from "@/Components/Loader.vue";
import useScroll from "@/Use/useScroll";
import {useForm, usePage} from "@inertiajs/vue3";
import useInfiniteScrolling from "@/Use/useInfiniteScrolling";
import Input from "@/shadcn/ui/input/Input.vue";

const props = defineProps({
  messages: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  message: "",
});

const channel = window.Echo.join("chat");
const activeUsers = ref([]);
const bottomChatPositionNumber = ref(0);
const isThereAnyNewMessage = ref(false);
const chat = ref(null);
const landmark = ref(null);
const {scrollToBottom, scrolledSpecifiedAmount, isInScrollActionDeadzone} = useScroll();
const {items, canLoadMoreItems, isLoading} = useInfiniteScrolling('messages', landmark)

const handleSubmit = () => {
  if (form.message === "") {
    return;
  }

  isLoading.value = true;

  form.post(route("app.chat.send-message"), {
    onSuccess: () => {
      isLoading.value = false;
      form.reset();
      scrollToBottom(chat.value)
    },
  });
};

onMounted(() => {
  scrollToBottom(chat.value);
  bottomChatPositionNumber.value = chat.value.scrollHeight;

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

        if (event.chat.user_id !== user.value.id) {
          if (isInScrollActionDeadzone(chat.value, 100)) {
            // adding 100ms delay to make sure that the message is rendered before scrolling
            setTimeout(() => {
              scrollToBottom(chat.value);
            }, 100);
          } else {
            isThereAnyNewMessage.value = true;
          }
        }

        items.value.push(event.chat);
      });
});

onUnmounted(() => {
  window.Echo.channel("chat").leave();
});

const handleScroll = (event) => {
  scrolledSpecifiedAmount(event.target, 100, () => {
    isThereAnyNewMessage.value = false;
  });

};

const scrollDown = () => {
  scrollToBottom(chat.value);
  isThereAnyNewMessage.value = false;
};

const user = computed(() => {
  return usePage().props.auth.user
})
</script>
