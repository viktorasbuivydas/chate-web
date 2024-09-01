<template>
  <AppLayout :hideBottomBar="true">
    <div class="flex flex-col space-y-2">
      <div class="flex flex-col space-y-2 border-1 border-input bg-backround p-4 rounded-md">
        <h2 class="px-4">
          Pokalbių kanalas
          <span class="text-md">
            <Eye class="inline-block ml-2" size="1.3rem" /> ({{
              activeUsers.length
            }})
          </span>
        </h2>
        <div class="relative flex flex-row justify-end items-end mt-4 grow">
          <form class="group grow" @submit.prevent="handleSubmit">
            <Input placeholder="Įveskite žinutę..." v-model="form.message"
              class="group-hover:bg-gray-800 border-input p-2 pr-30 border h-20 grow" />
            <Button class="right-4 bottom-5 absolute" variant="primary" :disabled="isLoading">
              <Loader v-if="isLoading" />
              <template v-if="!isOnCooldown">
                Siųsti
              </template>
              <template v-else>
                Kitą žinutę galėsite siųsti po: {{ coolDownTimerDisplay }} s.
              </template>
            </Button>
          </form>
        </div>
        <div class="relative flex flex-col space-y-2 px-4 w-full" id="chat" ref="chat" @scroll="handleScroll">
          <ChatMessage v-for="(message, index) in items" :key="index" :message="message" />
          <!--                    make sure we add 5% offset to the center of the screen-->
          <div class="bottom-[120px] left-[45%] z-10 fixed" v-if="isThereAnyNewMessage">
            <Button variant="primary" @click="scrollDown">
              <MoveDown class="inline-block mr-2" size="1.3rem" />
              Yra naujų žinučių
            </Button>
          </div>
          <div class="flex justify-center" v-if="isLoading">
            <Loader /> Kraunasi...
          </div>
          <div ref="landmark" v-if="canLoadMoreItems"></div>
          <div v-else-if="!isLoading" class="flex justify-center text-muted-foreground">Pasieketė pokalbių kanalo
            pabaigą</div>
        </div>

      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Button } from "@/shadcn/ui/button";
import { Input } from "@/shadcn/ui/input";
import ChatMessage from "@/Components/App/Chat/Message.vue";
import { ref, onMounted, computed } from "vue";
import { Eye, MoveDown } from "lucide-vue-next";
import Loader from "@/Components/Loader.vue";
import { useForm } from "@inertiajs/vue3";
import useInfiniteScrolling from "@/Use/useInfiniteScrolling.js";

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
const isOnCooldown = ref(false);
const cooldownTimer = ref(0);

const { items, canLoadMoreItems, isLoading } = useInfiniteScrolling('messages', landmark)

const handleSubmit = () => {
  cooldownTimer.value = 5;
  isLoading.value = true;
  form.post(route("app.chat.send-message"), {
    onSuccess: () => {
      form.reset();
    },
    onFinish: () => {
      isOnCooldown.value = true;
      // add 3 sec delay
      setTimeout(() => {
        isLoading.value = false;
        isOnCooldown.value = false;
      }, 5000);

      let timer = setInterval(() => {
        cooldownTimer.value--;
        if (cooldownTimer.value === 0) {
          clearInterval(timer);
        }
      }, 1000);
    },
  });
};

const coolDownTimerDisplay = computed(() => {
  return cooldownTimer.value > 0 ? cooldownTimer.value : "";
});

onMounted(() => {
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
      //add new message to the top of the list
      items.value.unshift(event.chat);
    });
});

</script>
