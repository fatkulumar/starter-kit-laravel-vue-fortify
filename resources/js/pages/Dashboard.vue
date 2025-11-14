<script setup lang="ts">
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import ContentDashboardCreator from '@/components/fragments/creator/content/Dashboard.vue'
import CreatorLayout from '@/layouts/CreatorLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ContentDashboardAdmin from '@/components/fragments/admin/content/Dashboard.vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <AppLayout v-if="$page.props.auth.user.role == 'admin'" :breadcrumbs="breadcrumbs">
        <ContentDashboardAdmin />
    </AppLayout>
    <CreatorLayout v-if="$page.props.auth.user.role == 'creator'" :breadcrumbs="breadcrumbs">
        <ContentDashboardCreator />
    </CreatorLayout>
    <CreatorLayout v-if="$page.props.auth.user.role == 'member'" :breadcrumbs="breadcrumbs">
        <ContentDashboardCreator />
    </CreatorLayout>
</template>
