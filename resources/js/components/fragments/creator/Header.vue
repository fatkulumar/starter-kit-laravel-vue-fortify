<script setup lang="ts">
import { inject, type Ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { BreadcrumbItemType } from '@/types';
import { ChevronRight, Home } from 'lucide-vue-next';

// Inject dari parent
const toggleSidebar = inject<() => void>('toggleSidebar');

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

</script>

<template>
    <div class="h-16 border-b border-zinc-800 flex items-center justify-between items-center px-4 md:px-6">
        <div class="flex items-center gap-4">

            <!-- Sidebar Toggle Button -->
            <button @click="toggleSidebar"
                class="text-gray-400 hover:text-white p-2 -ml-2 hover:bg-zinc-800 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-400 whitespace-nowrap">
            <!-- Home -->
            <Link href="/" class="hover:text-white flex items-center gap-1">
            <Home class="w-4 h-4" />
            <span class="hidden sm:inline">Home</span>
            </Link>

            <!-- dynamic breadcrumbs -->
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <span>
                    <ChevronRight class="h-4 w-4" />
                </span>

                <Link :href="item.href" class="text-white hover:text-gray-300">
                {{ item.title }}
                </Link>
            </template>

        </div>
    </div>
</template>