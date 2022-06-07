<template>
  <div v-if="auth.getUserRole?.name == 'admin'">
    <div class="flex place-content-end mb-4">
      <div
        class="
          px-4
          py-2
          text-white
          bg-indigo-600
          hover:bg-indigo-700
          cursor-pointer
        "
      >
        <router-link :to="{ name: 'users.create' }" class="text-sm font-medium"
          >Create New User</router-link
        >
      </div>
    </div>
    <div
      class="
        overflow-hidden overflow-x-auto
        min-w-full
        align-middle
        sm:rounded-md
      "
    >
      <table class="min-w-full border divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-6 py-3 bg-gray-50 text-left">
              <span
                class="
                  text-xs
                  font-medium
                  tracking-wider
                  leading-4
                  text-gray-500
                  uppercase
                "
                >Name</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left">
              <span
                class="
                  text-xs
                  font-medium
                  tracking-wider
                  leading-4
                  text-gray-500
                  uppercase
                "
                >Email</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left">
              <span
                class="
                  text-xs
                  font-medium
                  tracking-wider
                  leading-4
                  text-gray-500
                  uppercase
                "
                >Phone</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50 text-right">
              <span
                class="
                  text-xs
                  font-medium
                  tracking-wider
                  leading-4
                  text-gray-500
                  uppercase
                "
                >Actions</span
              >
            </th>
          </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
          <template v-for="item in users" :key="item.id">
            <tr class="bg-white">
              <td
                class="
                  px-6
                  py-4
                  text-sm
                  leading-5
                  text-left text-gray-900
                  whitespace-no-wrap
                "
              >
                {{ item.name }}
              </td>
              <td
                class="
                  px-6
                  py-4
                  text-sm
                  leading-5
                  text-left text-gray-900
                  whitespace-no-wrap
                "
              >
                {{ item.email }}
              </td>
              <td
                class="
                  px-6
                  py-4
                  text-sm
                  leading-5
                  text-left text-gray-900
                  whitespace-no-wrap
                "
              >
                {{ item.phone }}
              </td>
              <td
                class="
                  px-6
                  py-4
                  text-sm text-center
                  leading-5
                  text-gray-900 text-right
                  whitespace-no-wrap
                "
              >
                <div
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    mx-1
                    bg-orange-500
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-orange-400
                    active:bg-orange-600
                    focus:outline-none focus:border-orange-900 focus:ring
                    ring-orange-100
                    disabled:opacity-25
                    transition
                    ease-in-out
                    duration-150
                    cursor-pointer
                  "
                >
                  <router-link
                    :to="{ name: 'user.payments', params: { id: item.id } }"
                    >Payments</router-link
                  >
                </div>
                <div
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    mx-1
                    bg-green-500
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-green-400
                    active:bg-green-600
                    focus:outline-none focus:border-green-900 focus:ring
                    ring-green-100
                    disabled:opacity-25
                    transition
                    ease-in-out
                    duration-150
                    cursor-pointer
                  "
                >
                  <router-link
                    :to="{ name: 'users.view', params: { id: item.id } }"
                    >View</router-link
                  >
                </div>
                <div
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    mx-1
                    bg-blue-500
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-blue-400
                    active:bg-blue-600
                    focus:outline-none focus:border-blue-900 focus:ring
                    ring-blue-100
                    disabled:opacity-25
                    transition
                    ease-in-out
                    duration-150
                    cursor-pointer
                  "
                >
                  <router-link
                    :to="{ name: 'users.edit', params: { id: item.id } }"
                    >Edit</router-link
                  >
                </div>

                <button
                  @click="deleteUser(item.id)"
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    mx-1
                    bg-red-500
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-red-400
                    active:bg-red-600
                    focus:outline-none focus:border-red-900 focus:ring
                    ring-red-100
                    disabled:opacity-25
                    transition
                    ease-in-out
                    duration-150
                  "
                >
                  Delete
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <Pagination
      :links="usersPagination?.links"
      :meta="usersPagination?.meta"
    />
  </div>
  <h2 v-else-if="auth.getUserRole?.name !== null">Access Denied</h2>
</template>

<script lang="ts">
import useUsers from "../../composables/users";
import { onMounted, watch, ref, provide } from "vue";
import { useAuthStore } from "../../store/auth";
import Pagination from "../layout/Pagination.vue";
import { useRouter } from "vue-router";

export default {
  components: {
    Pagination,
  },
  setup() {
    const auth = useAuthStore();
    const { users, usersPagination, getUsers, destroyUser } = useUsers();
    const router = useRouter();
    const page = ref(null);

    const deleteUser = async (id) => {
      if (!window.confirm("You sure?")) {
        return;
      }

      await destroyUser(id);
      await getUsers(router.currentRoute.value.query.page as string);
    }

    onMounted(() => {
        getUsers(router.currentRoute.value.query.page as string)
    })

    provide("user-pagination-page", page);

    watch(
      () => page.value,
      () => {
          if(page.value){
              getUsers(page.value);
          }
      }
    );

    return {
      users,
      auth,
      page,
      usersPagination,
      deleteUser,
    };
  },
};
</script>
