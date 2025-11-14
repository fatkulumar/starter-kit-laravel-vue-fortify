<template>
    <div class="w-full">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4 md:mb-6">

            <!-- Card -->
            <div
                class="rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden
                       bg-white border border-zinc-200
                       dark:bg-zinc-900 dark:border-zinc-800">

                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>

            <!-- Card -->
            <div
                class="rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden
                       bg-white border border-zinc-200
                       dark:bg-zinc-900 dark:border-zinc-800">

                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>

            <!-- Card -->
            <div
                class="rounded-lg p-4 md:p-6 h-40 md:h-48 relative overflow-hidden sm:col-span-2 lg:col-span-1
                       bg-white border border-zinc-200
                       dark:bg-zinc-900 dark:border-zinc-800">

                <div class="absolute inset-0 opacity-5"
                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
                </div>
            </div>
        </div>

        <!-- Large Chart Area -->
        <div
            class="rounded-lg p-4 md:p-6 h-64 md:h-96 relative overflow-hidden
                   bg-white border border-zinc-200
                   dark:bg-zinc-900 dark:border-zinc-800">

            <div class="absolute inset-0 opacity-5"
                style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 11px)">
            </div>
        </div>
    </div>
</template>
