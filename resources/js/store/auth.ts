import { defineStore } from 'pinia'
import axios from 'axios'
import {
    authStateInterface,
    authUserInterface,
    authUserResponseInterface,
    authUserRoleInterface,
    authUserRoleResponseInterface,
    authUserRolesResponseInterface
} from '../interfaces/auth'

export const useAuthStore = defineStore('auth', {
// export const useAuthStore = defineStore<string, authStateInterface, >('auth', {
    state: () => {
        return {
            stateIsReady: false,
            user: {
                role: {
                    name: null,
                },
                name: null,
                email: null,
                id: null,
            } as authUserInterface,
            roles: [] as authUserRoleInterface[],
        }
    },
    actions: {
        async getUserInfo() :Promise<any> {
            this.stateIsReady = true

            let response = await axios.get('/api/user') as authUserResponseInterface
            this.user.id = response.data.id
            this.user.name = response.data.name
            this.user.email = response.data.email


            let response_1 = await axios.get('/api/role') as authUserRoleResponseInterface
            this.user.role = response_1.data[0]

            let response_2 = await axios.get('/api/all-roles') as authUserRolesResponseInterface
            this.roles = Object.values(response_2.data)
        },
    },
    getters: {
        getUserName: (state :any) :string | null => {
            if (!state.stateIsReady) {
                state.getUserInfo()
            }
            return state.user.name
        },
        getUserEmail: (state :any) :string | null => {
            if (!state.stateIsReady) {
                state.getUserInfo()
            }
            return state.user.email
        },
        getRoles: (state :any) :authUserRoleInterface[] => {
            if (!state.stateIsReady) {
                state.getUserInfo()
            }
            return state.roles
        },
        getUserRole: (state :any) : string | null => {
            if (!state.stateIsReady) {
                state.getUserInfo()
            }
            return state.user.role
        },
    },
})
