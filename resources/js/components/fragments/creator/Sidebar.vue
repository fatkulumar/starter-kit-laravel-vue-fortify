<script setup lang="ts">
import { inject, type Ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { ChevronDown, LayoutGrid, LogOut, Settings } from 'lucide-vue-next';

// Inject dari parent
const isSidebarOpen = inject<Ref<boolean>>('isSidebarOpen');
const isProfileOpen = inject<Ref<boolean>>('isProfileOpen');
const closeProfileMenu = inject<() => void>('closeProfileMenu');
</script>

<template>
  <div 
    id="sidebar"
    :class="[
      'bg-zinc-950 border-r border-zinc-800 flex flex-col transition-all duration-300 ease-in-out',
      isSidebarOpen ? 'w-60' : 'w-16'
    ]"
  >
    <!-- Logo -->
    <div class="p-4 border-b border-zinc-800 flex items-center gap-3 min-h-[73px]">
      <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0">
        <!-- logo -->
        <svg class="w-5 h-5 text-black" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
        </svg>
      </div>
      <transition
        enter-active-class="transition-opacity duration-200"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <span v-show="isSidebarOpen" class="text-white font-semibold text-sm whitespace-nowrap">Laravel Starter Kit</span>
      </transition>
      <transition
        enter-active-class="transition-opacity duration-200"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <button v-show="isSidebarOpen" class="ml-auto text-gray-400 hover:text-white">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
        </button>
      </transition>
    </div>

    <!-- Navigation - Menu Utama -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden">
      <div class="p-4">
        <transition
          enter-active-class="transition-opacity duration-200"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="transition-opacity duration-150"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <p v-show="isSidebarOpen" class="text-xs text-gray-500 mb-2 px-3">Platform</p>
        </transition>
        <nav class="space-y-1">
          <Link 
            href="/dashboard" 
            :class="[
              'flex items-center gap-3 rounded-lg bg-zinc-800 text-white group relative',
              isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
            ]"
            :title="!isSidebarOpen ? 'Dashboard' : ''"
          >
            <LayoutGrid />
            <transition
              enter-active-class="transition-opacity duration-200"
              enter-from-class="opacity-0"
              enter-to-class="opacity-100"
              leave-active-class="transition-opacity duration-150"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <span v-show="isSidebarOpen">Dashboard</span>
            </transition>
            <!-- Tooltip for collapsed state -->
            <div v-if="!isSidebarOpen" class="absolute left-full ml-2 px-2 py-1 bg-zinc-800 text-white text-sm rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
              Dashboard
            </div>
          </Link>
          <Link 
            href="/users" 
            :class="[
              'flex items-center gap-3 rounded-lg text-gray-400 hover:text-white hover:bg-zinc-800 group relative',
              isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
            ]"
            :title="!isSidebarOpen ? 'Users' : ''"
          >
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <transition
              enter-active-class="transition-opacity duration-200"
              enter-from-class="opacity-0"
              enter-to-class="opacity-100"
              leave-active-class="transition-opacity duration-150"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <span v-show="isSidebarOpen">Users</span>
            </transition>
            <!-- Tooltip for collapsed state -->
            <div v-if="!isSidebarOpen" class="absolute left-full ml-2 px-2 py-1 bg-zinc-800 text-white text-sm rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
              Users
            </div>
          </Link>
        </nav>
      </div>
    </div>

    <!-- Footer Links -->
    <div class="border-t border-zinc-800 bg-zinc-950">
      <div class="p-4">
        <nav class="space-y-1">
          <a 
            href="https://github.com" 
            target="_blank"
            :class="[
              'flex items-center gap-3 rounded-lg text-gray-400 hover:text-white hover:bg-zinc-800 group relative',
              isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
            ]"
            :title="!isSidebarOpen ? 'Github Repo' : ''"
          >
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
            </svg>
            <transition
              enter-active-class="transition-opacity duration-200"
              enter-from-class="opacity-0"
              enter-to-class="opacity-100"
              leave-active-class="transition-opacity duration-150"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <span v-show="isSidebarOpen">Github Repo</span>
            </transition>
            <!-- Tooltip for collapsed state -->
            <div v-if="!isSidebarOpen" class="absolute left-full ml-2 px-2 py-1 bg-zinc-800 text-white text-sm rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
              Github Repo
            </div>
          </a>
          <a 
            href="https://laravel.com/docs" 
            target="_blank"
            :class="[
              'flex items-center gap-3 rounded-lg text-gray-400 hover:text-white hover:bg-zinc-800 group relative',
              isSidebarOpen ? 'px-3 py-2' : 'px-3 py-2 justify-center'
            ]"
            :title="!isSidebarOpen ? 'Documentation' : ''"
          >
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <transition
              enter-active-class="transition-opacity duration-200"
              enter-from-class="opacity-0"
              enter-to-class="opacity-100"
              leave-active-class="transition-opacity duration-150"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <span v-show="isSidebarOpen">Documentation</span>
            </transition>
            <!-- Tooltip for collapsed state -->
            <div v-if="!isSidebarOpen" class="absolute left-full ml-2 px-2 py-1 bg-zinc-800 text-white text-sm rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
              Documentation
            </div>
          </a>
        </nav>
      </div>
    </div>

    <!-- Profile Menu -->
    <div class="border-t border-zinc-800 relative bg-zinc-950">
      <button 
        v-if="isSidebarOpen"
        id="profile-button"
        @click.stop="isProfileOpen = !isProfileOpen"
        class="w-full p-4 flex items-center gap-3 hover:bg-zinc-800 transition-colors"
      >
        <div class="w-8 h-8 rounded-full bg-zinc-700 flex items-center justify-center text-sm font-medium flex-shrink-0">
          C
        </div>
        <div class="flex-1 text-left min-w-0">
          <p class="text-sm font-medium text-white truncate">{{ $page.props.auth.user.name }}</p>
        </div>
        <ChevronDown 
          class="w-4 h-4 text-gray-400 transition-transform flex-shrink-0"
          :class="{ 'rotate-180': isProfileOpen }"
        >
        </ChevronDown>
      </button>

      <!-- Collapsed Profile Button -->
      <button 
        v-else
        id="profile-button"
        @click.stop="isProfileOpen = !isProfileOpen"
        class="w-full p-4 flex justify-center hover:bg-zinc-800 transition-colors"
      >
        <div class="w-8 h-8 rounded-full bg-zinc-700 flex items-center justify-center text-sm font-medium">
          C
        </div>
      </button>

      <!-- Dropdown Menu for Expanded Sidebar -->
      <transition
        enter-active-class="transition ease-out duration-100"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95"
      >
        <div 
          v-if="isProfileOpen && isSidebarOpen"
          id="profile-menu"
          class="absolute bottom-full left-0 right-0 mb-2 mx-4 bg-zinc-900 border border-zinc-800 rounded-lg shadow-lg overflow-hidden"
        >
          <div class="p-2 border-b border-zinc-800">
            <div class="px-3 py-2">
              <p class="text-sm font-medium text-white">{{ $page.props.auth.user.name }}</p>
              <p class="text-xs text-gray-400 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>
          <div class="p-2">
            <Link 
              href="/settings" 
              @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-zinc-800"
            >
              <Settings class="h-4 w-4" />
              <span class="text-sm">Settings</span>
            </Link>
            <Link 
              href="/logout" 
              method="post" 
              as="button"
              @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-zinc-800"
            >
              <LogOut class="h-4 w-4" />
              <span class="text-sm">Log out</span>
            </Link>
          </div>
        </div>
      </transition>

      <!-- Dropdown Menu for Collapsed Sidebar -->
      <transition
        enter-active-class="transition ease-out duration-100"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95"
      >
        <div 
          v-if="isProfileOpen && !isSidebarOpen"
          id="profile-menu"
          class="absolute z-50 bottom-0 left-full ml-2 w-56 bg-zinc-900 border border-zinc-800 rounded-lg shadow-lg overflow-hidden"
        >
          <div class="p-2 border-b border-zinc-800">
            <div class="px-3 py-2">
              <p class="text-sm font-medium text-white">Creator</p>
              <p class="text-xs text-gray-400 truncate">creator@gmail.com</p>
            </div>
          </div>
          <div class="p-2">
            <Link 
              href="/settings" 
              @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-zinc-800"
            >
              <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span class="text-sm">Settings</span>
            </Link>
            <Link 
              href="/logout" 
              method="post" 
              as="button"
              @click="closeProfileMenu"
              class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-zinc-800"
            >
              <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              <span class="text-sm">Log out</span>
            </Link>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>