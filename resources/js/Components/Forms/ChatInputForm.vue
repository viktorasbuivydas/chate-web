<template>
  <div class="flex items-center justify-center">
    <TooltipProvider>
      <Tooltip>
        <TooltipTrigger>
          <Button
              variant="ghost"
              disabled
              @click="scrollToBottom(wrapperRef)"
          >
            <Smile class="inline-block" size="1rem"/>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Add emoji</p>
        </TooltipContent>
      </Tooltip>
    </TooltipProvider>
    <TooltipProvider>
      <Tooltip>
        <TooltipTrigger>
          <Button
              variant="ghost"
              disabled
              @click="scrollToBottom(wrapperRef)"
          >
            <File class="inline-block" size="1rem"/>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Upload file</p>
        </TooltipContent>
      </Tooltip>
    </TooltipProvider>

  </div>
  <form class="grow group" @submit.prevent="handleFormSubmit">
    <Input
        @update:model-value="updateModelValue"
        v-model="newModelValue"
        placeholder="Įveskite žinutę..."
        class="group-hover:bg-gray-800 border grow border-input p-2 pr-30 h-[50px] relative"
    />

    <Button
        class="absolute bottom-1 right-2"
        variant="primary"
        :disabled="isLoading"
    >
      <Loader v-if="isLoading"/>
      <div class="flex items-center justify-center">
        <template v-if="newModelValue === '' && !isLoading">
          <ThumbsUp class="inline-block" size="1.3rem"/>
        </template>
        <template v-else>
          Siųsti
        </template>
      </div>
    </Button>
  </form>
</template>
<script setup lang="ts">
import Input from "@/shadcn/ui/input/Input.vue";
import {Button} from "@/shadcn/ui/button";
import Loader from "@/Components/Loader.vue";
import {File, Smile, ThumbsUp} from "lucide-vue-next";
import useScroll from "@/Use/useScroll";
import {computed} from "vue";
import {Tooltip, TooltipTrigger, TooltipContent, TooltipProvider} from "@/shadcn/ui/tooltip";

const {scrollToBottom} = useScroll()

const props = defineProps({
  isLoading: {
    type: Boolean,
    required: true,
  },
  modelValue: {
    type: String,
    required: true,
  },
  wrapperRef: {
    type: Object,
    required: true,
  },
})
const emit = defineEmits(["updateModelValue", "handleSubmitForm", "update:model-value"])

const handleFormSubmit = async () => {
  emit('handleSubmitForm')
  // clear input value
  updateModelValue('')
}

const updateModelValue = (value) => {
  emit('updateModelValue', value)
}

const newModelValue = computed(() => {
  return props.modelValue
})
</script>
