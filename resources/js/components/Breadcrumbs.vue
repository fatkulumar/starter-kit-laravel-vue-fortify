<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';
import { Link } from '@inertiajs/vue3';
import { Home } from 'lucide-vue-next';
import ArrowRightBreadcrumb from './partials/ArrowRightBreadcrumb.vue';

interface BreadcrumbItemType {
    title: string;
    href?: string;
}

defineProps<{
    breadcrumbs: BreadcrumbItemType[];
}>();
</script>

<template>
    <Breadcrumb>
        <BreadcrumbList class="flex items-center gap-1">
            <!-- Home -->
            <BreadcrumbItem>
                <BreadcrumbLink as-child>
                    <Link href="/dashboard" class="flex items-center gap-1">
                    <Home class="w-4 h-4" />
                    Home
                    </Link>
                </BreadcrumbLink>
            </BreadcrumbItem>

            <!-- Separator setelah Home -->
            <BreadcrumbSeparator>
                <ArrowRightBreadcrumb class="w-4 h-4" />
            </BreadcrumbSeparator>

            <!-- Breadcrumb dinamis -->
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <BreadcrumbItem>
                    <template v-if="index === breadcrumbs.length - 1">
                        <BreadcrumbPage>{{ item.title }}</BreadcrumbPage>
                    </template>
                    <template v-else>
                        <BreadcrumbLink as-child>
                            <Link :href="item.href ?? '#'">{{ item.title }}</Link>
                        </BreadcrumbLink>
                    </template>
                </BreadcrumbItem>

                <!-- Separator kecuali item terakhir -->
                <BreadcrumbSeparator v-if="index !== breadcrumbs.length - 1">
                    <ArrowRightBreadcrumb class="w-4 h-4" />
                </BreadcrumbSeparator>
            </template>
        </BreadcrumbList>
    </Breadcrumb>
</template>
