<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>
    <div class="mt-2 mb-6 text-sm text-indigo-600">
        New User
    </div>



    <form class="space-y-6" @submit.prevent="saveUser">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.name">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="text" name="email" id="email"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.email">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <div class="mt-1">
                    <input type="text" name="address" id="address"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.phone">
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" name="address" id="address"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.password">
                </div>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                <div class="mt-1">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.password_confirmation">
                </div>
            </div>
            <div v-if="(auth.user.role?.name == 'admin')">
                <label for="roleId" class="block text-sm font-medium text-gray-700">Role</label>
                <div class="relative" v-if="user && user.role">
                    <select  v-model="user.role.id" name="roleId" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option v-for="role in auth.getRoles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"></div>
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
    </form>
</template>

<script lang="ts">
import useUsers from "../../composables/users";
import { reactive } from "vue";
import { useAuthStore } from "../../store/auth";


export default {
  setup() {
    const auth = useAuthStore();

    const form = reactive({
      name: "",
      email: "",
      phone: "",
      password: "",
      password_confirmation: "",
    });

    const { errors, storeUser, user } = useUsers();

    const saveUser = async () => {
      await storeUser({ ...form });
    };

    return {
      user,
      auth,
      form,
      errors,
      saveUser,
    };
  },
};
</script>
