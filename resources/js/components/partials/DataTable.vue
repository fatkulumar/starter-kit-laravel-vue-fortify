<script setup lang="ts">
import { Pencil, Trash } from 'lucide-vue-next';
import { defineEmits } from 'vue';

const emit = defineEmits(['edit', 'delete']);

defineProps<{
  columns: { title: string; field: string }[];
  rows: any[];
}>();

const confirmDelete = (row: any) => {
  if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
    emit('delete', row);
  }
};
</script>

<template>
  <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
      <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
          <th v-for="col in columns" :key="col.field"
            class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
            {{ col.title }}
          </th>
          <th
            class="px-6 py-3 text-right text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>

      <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-200 dark:divide-gray-700">
        <tr v-for="row in rows" :key="row.id" class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
          <td v-for="col in columns" :key="col.field"
            class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200 text-sm">
            <!-- Jika kolom adalah foto -->
            <template v-if="col.field === 'photo_url'">
              <img v-if="row.photo_url" :src="row.photo_url" alt="Foto"
                class="w-10 h-10 rounded-full object-cover border" />
              <span v-else class="text-gray-400 italic">Tidak ada foto</span>
            </template>

            <!-- Default render -->
            <template v-else>
              {{ row[col.field] }}
            </template>
          </td>

          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end gap-2">
              <Pencil @click="emit('edit', row)"
                class="w-4 h-4 cursor-pointer text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" />
              <Trash @click="confirmDelete(row)"
                class="w-4 h-4 cursor-pointer text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
