<template>
  <DialogRoot>
    <DialogTrigger>
      <Button variant="primary">
        <Pen class="inline-block" size="1.3rem"/>
      </Button>
    </DialogTrigger>
    <DialogPortal>
      <DialogOverlay class="bg-background/60 data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
      <DialogContent
          class="data-[state=open]:animate-contentShow border border-input fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-background p-[25px] focus:outline-none z-[100]"
      >
        <DialogTitle class="m-0 text-[17px] font-semibold">
          Rašyti žinutę
        </DialogTitle>
        <CreateConversationForm/>
        <div class="mt-[25px] flex justify-end">
          <DialogClose as-child>
            <Button variant="primary" class="mr-[10px]">Save changes</Button>
          </DialogClose>
        </div>
        <DialogClose
        >
          <Button variant="ghost" class="absolute top-[10px] right-[10px]">
            <X size="1.3rem" />
          </Button>
        </DialogClose>
      </DialogContent>
    </DialogPortal>
  </DialogRoot>
</template>

<script setup lang="ts">
import {
  DialogClose,
  DialogContent,
  DialogOverlay,
  DialogPortal,
  DialogRoot,
  DialogTitle,
  DialogTrigger,
} from 'radix-vue'
import Button from "@/shadcn/ui/button/Button.vue";
import {Pen, X} from "lucide-vue-next";
import CreateConversationForm from "@/Components/Forms/CreateConversationForm.vue";
</script>
