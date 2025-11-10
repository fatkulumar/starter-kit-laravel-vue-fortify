<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Paginated, User, type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { LoaderIcon, Plus, Search, Trash } from 'lucide-vue-next'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import Modal from '@/components/ui/modal/Modal.vue'
import DataTable from '@/components/partials/DataTable.vue'
import FormField from '@/components/fragments/FormField.vue'
import { useUserStore } from '@/stores/admin/userStore'
import { storeToRefs } from 'pinia'
import { onMounted } from 'vue'
import Pagination from '@/components/partials/Pagination.vue'

const userStore = useUserStore();

const { rows, showModal, form } = storeToRefs(userStore)
const { openModal, closeModal, saveUser, deleteUser, handlePageChange, setSearchQuery, handlePhotoChange, removePhoto, isLoading } = userStore

onMounted(() => {
    userStore.fetchUsers()
})

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Users', href: '/dashboard/user' },
]

const columns = [
    { title: 'Nomor', field: 'no' },
    { title: 'Foto', field: 'photo_url' },
    { title: 'Name', field: 'name' },
    { title: 'Email', field: 'email' },
    { title: 'Role', field: 'role' },
]

const handleEdit = (row: User) => {
    openModal(row)
}

</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="isLoading" class="absolute inset-0 bg-white/60 flex items-center justify-center z-50">
            <LoaderIcon class="w-10 h-10 animate-spin text-blue-600" />
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="mb-4 flex justify-between items-center">
                <Button variant="default" size="sm" @click="openModal()">
                    <Plus />
                </Button>

                <div class="relative w-64">
                    <Search class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" />

                    <Input @input="setSearchQuery($event.target.value)" placeholder="Cari user..."
                        class="pl-10 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 w-full" />
                </div>
            </div>

            <DataTable :columns="columns" :rows="rows" @edit="handleEdit" @delete="deleteUser" />
            <Pagination v-if="userStore.pagination.links" :links="userStore.pagination.links" @page-change="handlePageChange" />
        </div>

        <Modal :show="showModal" title="Form User" @close="closeModal">
            <div class="space-y-4">
                <div v-if="form.photoPreview" class="relative w-28 h-28 group">
                    <img :src="form.photoPreview" class="object-cover w-full h-full rounded-lg shadow" />
                    <Trash @click="removePhoto()" class="absolute bottom-1 left-1/2 -translate-x-1/2 
               bg-white text-red-600 text-xs font-semibold px-1 
               rounded shadow hover:bg-red-50">
                        Hapus Foto
                    </Trash>
                </div>
                <FormField accept="image/jpeg,image/png" id="photo" type="file" label="Photo"
                    @change="(e: any) => handlePhotoChange(e.target.files?.[0] || null)" />
                <FormField id="name" label="Nama" v-model="form.name" />
                <FormField id="email" label="Email" v-model="form.email" />
                <FormField id="role" label="Role" v-model="form.role" />
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <Button variant="secondary" @click="closeModal">Batal</Button>
                <Button variant="default" @click="saveUser">Simpan</Button>
            </div>
        </Modal>
    </AppLayout>
</template>
