import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../store/auth'
import { getUserDataInterface, getUsersInterface, userInterface, usersPaginationInterface } from '../interfaces/user'

export default function useUsers() {
    const auth = useAuthStore()
    const user = ref<userInterface>({
        id: null,
        name: null,
        email: null,
        phone: null,
        password: null,
        password_confirmation: null,
        role: {
            id: null,
            name: null,
        },

    })
    const usersPagination = ref<usersPaginationInterface>({
        meta: null,
        links: null,
    })
    const users = ref<Array<userInterface>>([])
    const errors = ref('')
    const router = useRouter()

    const getUsers = async (page :string | null) => {
        let response :getUsersInterface;
        try {
            if (page) {
                response = await axios.get('/api/users' + "?page=" + page)
            } else {
                response = await axios.get('/api/users')
            }
            users.value = response.data.data
            usersPagination.value.links = response.data.links
            usersPagination.value.meta = response.data.meta
        } catch (error: unknown) {
            if (error instanceof Error) {
                errors.value += error.message;
            }
        }
    }

    const getUser = async (id :string) => {
        let response = await axios.get(`/api/users/${id}`) as getUserDataInterface
        user.value = response.data.data
    }

    const storeUser = async (data: userInterface) => {
        errors.value = ''
        try {
            await axios.post('/api/users', data)
            await router.push({ name: 'users.index' })
        } catch (error: unknown) {
            if (error instanceof Error) {
                errors.value += error.message;
            }
        }

    }

    const updateUser = async (id :number, redirectTo = 'dashboard') => {
        errors.value = ''
        try {
            await axios.patch(`/api/users/${id}`, user.value)
            auth.stateIsReady = false;
            auth.getUserInfo();
            await router.push({ name: redirectTo })
        } catch (error: unknown) {
            if (error instanceof Error) {
                errors.value += error.message;
            }
        }
    }

    const destroyUser = async (id: number) => {
        await axios.delete(`/api/users/${id}`)
    }

    return {
        errors,
        user,
        users,
        usersPagination,
        getUser,
        getUsers,
        storeUser,
        updateUser,
        destroyUser,
    }
}
