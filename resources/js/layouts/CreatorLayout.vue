<script setup lang="ts">
import Header from '@/components/fragments/creator/Header.vue';
import Sidebar from '@/components/fragments/creator/Sidebar.vue';
import { BreadcrumbItemType } from '@/types';
import { ref, provide, onMounted, onUnmounted } from 'vue';

const isProfileOpen = ref(false);
const isSidebarOpen = ref(true);

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
  if (!isSidebarOpen.value) {
    isProfileOpen.value = false;
  }
};

const closeProfileMenu = () => {
  isProfileOpen.value = false;
};

const handleClickOutside = (event: any) => {
  const profileMenu = document.getElementById('profile-menu');
  const profileButton = document.getElementById('profile-button');
  
  // Close profile menu if clicking outside
  if (profileMenu && !profileMenu.contains(event.target) &&
      profileButton && !profileButton.contains(event.target) &&
      isProfileOpen.value) {
    closeProfileMenu();
  }
};

// Provide state and functions to child components
provide('isSidebarOpen', isSidebarOpen);
provide('isProfileOpen', isProfileOpen);
provide('toggleSidebar', toggleSidebar);
provide('closeProfileMenu', closeProfileMenu);

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});


interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

</script>

<template>
  <div class="flex h-screen bg-black text-gray-200">
    <Sidebar />
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <Header :breadcrumbs="breadcrumbs"/>
      
      <!-- Dashboard Content -->
      <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <slot />
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Custom scrollbar for sidebar */
:deep(#sidebar::-webkit-scrollbar) {
  width: 6px;
}

:deep(#sidebar::-webkit-scrollbar-track) {
  background: transparent;
}

:deep(#sidebar::-webkit-scrollbar-thumb) {
  background: #3f3f46;
  border-radius: 3px;
}

:deep(#sidebar::-webkit-scrollbar-thumb:hover) {
  background: #52525b;
}
</style>