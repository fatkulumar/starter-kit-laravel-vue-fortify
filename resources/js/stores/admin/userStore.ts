import { defineStore } from 'pinia'
import type { User, Paginated } from '@/types'
import axios from '@/lib/axios'

export const useUserStore = defineStore('user', {
    state: () => ({
        users: [] as User[],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
            links: []
        },
        showModal: false,
        form: {
            id: '' as string,
            name: '' as string,
            email: '' as string,
            role: '' as string,
            photo: null as File | null,
            photoPreview: '' as string,
            password: 'fatkulumar'
        },
        searchQuery: '',
        isLoading: false,
    }),

    actions: {
        async fetchUsers(page = 1, force = false) {
            try {
                // 🧠 Jika data sudah ada di state dan tidak ada search aktif, lewati fetch
                if (!force && this.users.length > 0 && this.pagination.current_page === page && !this.searchQuery) {
                    return
                }

                this.isLoading = true

                const res = await axios.get(`/api/dashboard/user`, {
                    params: {
                        page,
                        search: this.searchQuery || '',
                    },
                })

                const data = res.data.data as Paginated<User>
                this.setUsers(data)
            } catch (error) {
                console.error('❌ Gagal memuat data user:', error)
            } finally {
                this.isLoading = false
            }
        },

        setUsers(data: Paginated<User>) {
            this.users = data.data
            this.pagination = {
                current_page: data.current_page,
                per_page: data.per_page,
                total: data.total,
                links: data.links,
            }
        },

        setSearchQuery(query: string) {
            this.searchQuery = query
            this.fetchUsers(1)
        },

        openModal(user?: User) {
            if (user) {
                console.log(user)
                this.form = {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    role: user.role,
                    photo: null,
                    photoPreview: user.profile.photo_url, // URL lama
                    password: 'fatkulumar'
                }
            } else {
                this.resetForm()
            }
            this.showModal = true
        },

        closeModal() {
            this.showModal = false
        },

        resetForm() {
            this.form = {
                id: '',
                name: '',
                email: '',
                role: '',
                photo: null,
                photoPreview: '',
                password: 'fatkulumar'
            }
        },

        async saveUser() {
            try {
                this.isLoading = true
                const formData = new FormData()

                formData.append('id', this.form.id)
                formData.append('name', this.form.name)
                formData.append('email', this.form.email)
                formData.append('role', this.form.role)
                formData.append('password', this.form.password)

                if (this.form.photo) {
                    formData.append('photo', this.form.photo)
                }

                let res

                if (this.form.id) {
                    formData.append('_method', 'PUT') 

                    res = await axios.post(
                        `/api/dashboard/user/${this.form.id}`,
                        formData,
                        { headers: { "Content-Type": "multipart/form-data" } }
                    )
                } else {
                    console.log('💾 Tambah user:', this.form)
                    res = await axios.post(
                        `/api/dashboard/user`,
                        formData,
                        { headers: { "Content-Type": "multipart/form-data" } }
                    )
                }

                await this.fetchUsers(this.pagination.current_page, true)
                this.closeModal()
            } catch (error) {
                console.error('❌ Gagal menyimpan user:', error)
            } finally {
                this.isLoading = false
            }
        },

        async deleteUser(user: User) {
            try {
                this.isLoading = true
                await axios.delete(`/api/dashboard/user/${user.id}`)
                await this.fetchUsers(this.pagination.current_page, true)
            } catch (error) {
                console.error('❌ Gagal menghapus user:', error)
            } finally {
                this.isLoading = false
            }
        },

        async handlePageChange(page: number): Promise<void> {
            await this.fetchUsers(page, true);
        },

        handlePhotoChange(file: File | null) {
            if (!file) return

            const allowedTypes = ["image/jpeg", "image/png"]

            if (!allowedTypes.includes(file.type)) {
                alert("Hanya boleh upload JPG atau PNG")
                return
            }

            this.form.photo = file
            this.form.photoPreview = URL.createObjectURL(file)
        },

        removePhoto() {
            this.form.photo = null
            this.form.photoPreview = ''
        },
    },

    getters: {
        rows: (state) =>
            state.users.map((u, index) => ({
                no: (state.pagination.current_page - 1) * state.pagination.per_page + index + 1,
                id: u.id,
                name: u.name,
                email: u.email,
                role: u.role,
                profile: u.profile,
                photo_url: u.profile?.photo_url
            })),
    },
})
