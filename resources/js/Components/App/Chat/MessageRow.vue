<template>
  <TooltipProvider>
    <Tooltip>
      <TooltipTrigger>
        <div class="flex flex-col" :id="'message-'+ message.id ">
          <div class="flex space-x-2 items-center">
            <div class="flex space-x-2 items-end">
              <div v-if="type !== 'mine'">
                <Avatar class="h-8 w-8">
                  <AvatarImage src="/avatars/01.png" alt="@shadcn"/>
                  <AvatarFallback>SC</AvatarFallback>
                </Avatar>
              </div>

              <div class="flex space-x-2 items-center">
                <div :class="{'order-last ml-2': type !== 'mine'}">
                  <Button
                      variant="ghost"
                      class="rounded-full p-1 border-0 hover:outline bg-background hover:bg-muted hover:outline-input relative"
                      :id="'message-'+ message.id +'-dropdown'"
                  >
                    <MoreVertical size="1.3rem" class="cursor-pointer" @click="showMenu = !showMenu"/>
                  </Button>
                </div>
                <div
                    class="p-2 max-w-100 rounded-md block break-words"
                    :class="
                type === 'mine'
                    ? 'bg-blue-500'
                    : type === 'other'
                    ? 'bg-purple-500'
                    : type === 'to_me'
                    ? 'bg-yellow-500'
                    : ''
            "
                >
                  <div>{{ message.message }}</div>
                </div>
              </div>
            </div>
          </div>
          <!--      <div class="flex justify-end text-sm text-muted-foreground">{{ message.created_at }}</div>-->
        </div>
      </TooltipTrigger>
      <TooltipContent>
        <p>{{ message.created_at }}</p>
      </TooltipContent>
    </Tooltip>
  </TooltipProvider>


</template>

<script setup>
import {File, MoreVertical} from "lucide-vue-next";
import {Avatar, AvatarFallback, AvatarImage} from "@/shadcn/ui/avatar";
import Button from "@/shadcn/ui/button/Button.vue";
import {Tooltip, TooltipContent, TooltipProvider, TooltipTrigger} from "@/shadcn/ui/tooltip";

const props = defineProps({
    message: {
        type: Object,
        required: true,
    },
    type: {
        type: String,
        default: "mine",
    },
});
</script>
