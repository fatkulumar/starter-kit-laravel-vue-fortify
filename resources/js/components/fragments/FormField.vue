<script setup lang="ts">
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'

const props = defineProps<{
  id: string
  label: string
  type?: string
  modelValue?: string | number
  placeholder?: string
  accept?: string
}>()

const emits = defineEmits<{
  (e: 'update:modelValue', value: string | number): void
}>()
</script>

<template>
  <div class="flex flex-col gap-1">
    <Label :for="id" class="text-sm font-medium text-gray-700 dark:text-gray-200">
      {{ label }}
    </Label>
    <Input
      :id="id"
      :type="type || 'text'"
      :placeholder="placeholder"
      :model-value="modelValue"
      @update:model-value="emits('update:modelValue', $event)"
      class="w-full"
      :accept="accept"
    />
  </div>
</template>
