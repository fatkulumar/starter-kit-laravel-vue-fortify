<script setup lang="ts">
import { cn } from '@/lib/utils'
import Button from '../button/Button.vue';

const props = defineProps<{
    show: boolean
    title?: string
    class?: string
}>()

const emit = defineEmits(['close'])
</script>

<template>
    <div v-if="props.show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div :class="cn(
            'bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-md p-6 transition-all duration-200',
            props.class
        )">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    {{ props.title }}
                </h2>
                <Button variant="secondary" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300" @click="emit('close')">
                    ✕
                </Button>
            </div>
            <div>
                <slot />
            </div>
        </div>
    </div>
</template>
