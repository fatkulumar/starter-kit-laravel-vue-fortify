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
    <div
        class="
            h-16 border-b px-4 md:px-6 flex items-center justify-between
            bg-white border-gray-200 text-gray-700
            dark:bg-zinc-950 dark:border-zinc-800 dark:text-gray-400
        "
    >
        <!-- Left wrapper -->
        <div class="flex items-center gap-4">

            <!-- Sidebar Toggle Button -->
            <button
                @click="toggleSidebar"
                class="
                    p-2 -ml-2 rounded-lg transition-colors
                    text-gray-600 hover:text-black hover:bg-gray-200
                    dark:text-gray-400 dark:hover:text-white dark:hover:bg-zinc-800
                "
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        <!-- Breadcrumb -->
        <div
            class="
                flex items-center gap-2 text-sm whitespace-nowrap
                text-gray-600 dark:text-gray-400
            "
        >
            <!-- Home -->
            <Link
                href="/"
                class="
                    flex items-center gap-1
                    hover:text-black
                    dark:hover:text-white
                "
            >
                <Home class="w-4 h-4" />
                <span class="hidden sm:inline">Home</span>
            </Link>

            <!-- Dynamic breadcrumbs -->
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <span class="flex items-center">
                    <ChevronRight class="h-4 w-4" />
                </span>

                <Link
                    :href="item.href"
                    class="
                        text-gray-700 hover:text-black
                        dark:text-white dark:hover:text-gray-300
                    "
                >
                    {{ item.title }}
                </Link>
            </template>

        </div>
    </div>
</template>
