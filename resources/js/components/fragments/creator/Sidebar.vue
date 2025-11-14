<script setup lang="ts">
import { inject, type Ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { ChevronDown, LayoutGrid, LogOut, Settings, User } from 'lucide-vue-next';
import AppearanceTabs from '@/components/partials/ApperaanceTabs.vue';
import { getInitials } from '@/composables/useInitials';

const isSidebarOpen = inject<Ref<boolean>>('isSidebarOpen');
const isProfileOpen = inject<Ref<boolean>>('isProfileOpen');
const closeProfileMenu = inject<() => void>('closeProfileMenu');

const menus = [
  {
    title: "Dashboard",
    href: "/dashboard",
    icon: LayoutGrid,
    activeClass: "bg-zinc-100 text-gray-900 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700",
    inactiveClass: "text-gray-600 hover:text-gray-900 hover:bg-zinc-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-zinc-800",
  },
  {
    title: "Users",
    href: "/users",
    icon: User,
    activeClass: "text-gray-600 hover:text-gray-900 hover:bg-zinc-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-zinc-800",
    inactiveClass: "text-gray-600 hover:text-gray-900 hover:bg-zinc-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-zinc-800",
  },
];

</script>

<template>
  <div id="sidebar" :class="[
    'border-r flex flex-col transition-all duration-300 ease-in-out',
    'bg-white border-zinc-200 text-gray-700',             // LIGHT
    'dark:bg-zinc-950 dark:border-zinc-800 dark:text-gray-200', // DARK
    isSidebarOpen ? 'w-60' : 'w-16'
  ]">
    <!-- Logo -->
    <div
      class="p-4 border-b bg-white border-zinc-200 dark:bg-zinc-950 dark:border-zinc-800 flex items-center gap-3 min-h-[73px]">
      <div class="w-8 h-8 bg-zinc-800 dark:bg-white rounded-lg flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5 text-white dark:text-black" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
        </svg>
      </div>

      <transition enter-active-class="transition-opacity duration-200" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition-opacity duration-150" leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <span v-show="isSidebarOpen" class="font-semibold text-sm whitespace-nowrap">
          Laravel Starter Kit
        </span>
      </transition>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden">
      <div class="p-4">
        <transition enter-active-class="transition-opacity duration-200">
          <p v-show="isSidebarOpen" class="text-xs text-gray-500 dark:text-gray-400 mb-2 px-3">
            Platform
          </p>
        </transition>

        <nav class="space-y-1">
          <template v-for="menu in menus" :key="menu.title">

            <Link :href="menu.href" :class="[
              'flex items-center gap-3 rounded-lg group relative',
              menu.activeClass,
              isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
            ]" :title="!isSidebarOpen ? menu.title : ''">

            <!-- Icon -->
            <component :is="menu.icon" class="w-4 h-4 flex-shrink-0" />

            <!-- Text (show when sidebar open) -->
            <transition>
              <div v-show="isSidebarOpen">
                <span>{{ menu.title }}</span>
              </div>
            </transition>

            <!-- Tooltip when sidebar collapsed -->
            <div v-if="!isSidebarOpen" class="absolute left-full ml-2 px-2 py-1 rounded text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50
               bg-zinc-800 text-white dark:bg-zinc-700 dark:text-gray-200">
              {{ menu.title }}
            </div>

            </Link>

          </template>
        </nav>

      </div>
    </div>

    <!-- Footer Links -->
    <div class="border-t bg-white border-zinc-200 dark:bg-zinc-950 dark:border-zinc-800">
      <div class="p-4">
        <nav class="space-y-1">

          <a href="https://github.com" target="_blank" :class="[
            'flex items-center gap-3 rounded-lg group relative',
            'text-gray-600 hover:text-gray-900 hover:bg-zinc-200',
            'dark:text-gray-400 dark:hover:text-white dark:hover:bg-zinc-800',
            isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
          ]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>

            <transition><span v-show="isSidebarOpen">Github Repo</span></transition>

            <div v-if="!isSidebarOpen"
              class="absolute left-full ml-2 px-2 py-1 rounded bg-zinc-800 text-white dark:bg-zinc-700 dark:text-gray-200 
                     text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
              Github Repo
            </div>
          </a>

        </nav>
      </div>
    </div>

    <!-- Profile Menu -->
    <div class="border-t bg-white border-zinc-200 dark:bg-zinc-950 dark:border-zinc-800 relative">
      <button v-if="isSidebarOpen" @click.stop="isProfileOpen = !isProfileOpen"
        class="w-full p-4 flex items-center gap-3 hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors">
        <div
          class="w-8 h-8 rounded-full bg-zinc-300 dark:bg-zinc-700 flex items-center justify-center text-sm font-medium">
          C
        </div>

        <div class="flex-1 text-left min-w-0">
          <p class="text-sm font-medium">{{ $page.props.auth.user.name }}</p>
        </div>

        <ChevronDown class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform flex-shrink-0"
          :class="{ 'rotate-180': isProfileOpen }" />
      </button>

      <!-- Collapsed -->
      <button v-else @click.stop="isProfileOpen = !isProfileOpen"
        class="w-full p-4 flex justify-center hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors">
        <div
          class="w-8 h-8 rounded-full bg-zinc-300 dark:bg-zinc-700 flex items-center justify-center text-sm font-medium">
          {{ getInitials($page.props.auth.user.name) }}
        </div>
      </button>

      <!-- Dropdown -->
      <transition>
        <div v-if="isProfileOpen && isSidebarOpen" class="absolute bottom-full left-0 right-0 mb-2 mx-4 rounded-lg shadow-lg overflow-hidden
                 bg-white border border-zinc-200 dark:bg-zinc-900 dark:border-zinc-800">
          <div class="p-2 border-b border-zinc-200 dark:border-zinc-800">
            <div class="px-3 py-2">
              <p class="text-sm font-medium">{{ $page.props.auth.user.name }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>

          <div class="p-2">
            <Link href="/settings" @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-800">
            <Settings class="h-4 w-4" />
            <span class="text-sm">Settings</span>
            </Link>
            <Link href="/logout" method="post" as="button" @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-zinc-800">
            <LogOut class="h-4 w-4" />
            <span class="text-sm">Log out</span>
            </Link>
          </div>

        </div>
      </transition>
    </div>

    <AppearanceTabs class="mt-2" />
  </div>
</template>
