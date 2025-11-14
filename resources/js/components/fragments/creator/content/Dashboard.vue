<template>
    <div class="w-full">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4 md:mb-6">
            <div class="bg-zinc-900 border border-zinc-800 rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden">
                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden">
                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>
            <div
                class="bg-zinc-900 border border-zinc-800 rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden sm:col-span-2 lg:col-span-1">
                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>
        </div>

        <!-- Large Chart Area -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-lg p-4 md:p-6 h-64 md:h-96 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5"
                style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
            </div>
        </div>
    </div>
</template>