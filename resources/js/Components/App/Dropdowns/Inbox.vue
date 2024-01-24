<template>
  <DropdownMenu @update:open="openedDropdown">
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" href="/"
              class="rounded-full border-0 hover:outline bg-background hover:bg-muted hover:outline-input relative">
        <MessageSquare class="inline-block" size="1.3rem"/>
        <span v-if="count > 0"
              class="absolute top-0 right-0 -mt-1 -mr-1 text-xs text-white bg-red-500 rounded-full w-4 h-4 flex justify-center items-center">
          {{ count }}
        </span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-80" align="end">
      <DropdownMenuLabel class="font-normal flex">
        <div class="flex flex-col space-y-1">
          <p class="text-sm font-medium leading-none flex space-x-2">
            <div>Žinutės</div>
            <template v-if="unreadMessageCount > 0">
              <span class="text-xs text-white bg-red-500 rounded-full w-4 h-4 flex justify-center items-center">
                {{ unreadMessageCount }}
              </span>
            </template>
          </p>
        </div>
      </DropdownMenuLabel>
      <DropdownMenuSeparator/>
      <DropdownMenuGroup class="flex flex-col space-y-2 h-screen max-h-100 overflow-y-auto">
        <DropdownMenuItem class="flex space-x-2 justify-between cursor-pointer"
                          v-for="(conversation, index) in conversations?.data"
                          as="a" :href="route('app.conversations.index', conversation.uuid)"
        >
          <template v-if="isUnreadMessage(conversation)">
            <div class="flex space-x-2 text-white font-bold">
              <Avatar class="h-8 w-8">
                <AvatarImage src="/avatars/01.png" alt="@shadcn"/>
                <AvatarFallback>SC</AvatarFallback>
              </Avatar>
              <div class="flex flex-col">
                <div>{{ conversation.chat_with_members[0].name }}</div>
                <div class="text-xs text-white">
                  <span v-if="conversation.latest_message.user_id === user.id">
                  Jūs:
                  </span>
                  {{ conversation.latest_message.message }} * {{ conversation.latest_message.created_at_hours }}
                </div>
              </div>
            </div>
            <span class="text-xs text-white bg-blue-500 rounded-full w-2 h-2 flex justify-center items-center">
          </span>
          </template>
          <template v-else>
            <div class="flex space-x-2 text-white">
              <Avatar class="h-8 w-8">
                <AvatarImage src="/avatars/01.png" alt="@shadcn"/>
                <AvatarFallback>SC</AvatarFallback>
              </Avatar>
              <div class="flex flex-col">
                <div>{{ conversation.chat_with_members[0].name }}</div>
                <div class="text-xs text-muted-foreground">
              <span v-if="conversation.latest_message.user_id === user.id">
                Jūs:
              </span>
                  {{ conversation.latest_message.message }} * {{ conversation.latest_message.created_at_hours }}
                </div>
              </div>
            </div>
          </template>
        </DropdownMenuItem>
        <div class="absolute bottom-0 left-0 right-0 flex justify-center bg-background border-t border-input">
          <Button variant="ghost" class="w-full border border-input" as="a" :href="route('app.conversations.index')">
            Peržiūrėti visus
          </Button>
        </div>
      </DropdownMenuGroup>
      <DropdownMenuSeparator/>
    </DropdownMenuContent>
  </DropdownMenu>
</template>

<script setup lang="ts">
import {Button} from '@/shadcn/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/shadcn/ui/dropdown-menu'
import {MessageSquare} from "lucide-vue-next";
import {Avatar, AvatarFallback, AvatarImage} from "@/shadcn/ui/avatar";
import {computed, onMounted, ref} from "vue";
import {usePage, router} from "@inertiajs/vue3";

const props = defineProps({
  count: {
    type: Number,
    required: true,
  },
});

const conversations = ref({});
defineEmits(["update:open"]);

const user = computed(() => {
  return usePage().props.auth.user
});

const isUnreadMessage = (conversation) => {
  return conversation.latest_message.read_at === null && conversation.latest_message.user_id !== user.value.id;
}

const openedDropdown = (dropdownOpened) => {
  if (!dropdownOpened) {
    return;
  }

  fetch(route('app.conversations.index'),
      {
        headers: {
          'Accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(data => updateConversations(data))
      .catch(error => console.log(error));
}

const updateConversations = (data) => {
  conversations.value = data.conversations;
}

const unreadMessageCount = computed(() => {
  if (!conversations.value?.data) {
    return 0;
  }
  return conversations.value?.data?.filter(conversation => isUnreadMessage(conversation)).length;
})
</script>
