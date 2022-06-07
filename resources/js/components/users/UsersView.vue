<template>
  <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
    {{ errors }}
  </div>
  <div class="mt-2 mb-6 text-sm text-indigo-600">User page</div>

  <div class="space-y-4 rounded-md shadow-sm">
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700"
        >Name</label
      >
      <div class="mt-1">
        {{ user.name }}
      </div>
    </div>

    <div>
      <label for="email" class="block text-sm font-medium text-gray-700"
        >Email</label
      >
      <div class="mt-1">
        {{ user.email }}
      </div>
    </div>

    <div>
      <label for="address" class="block text-sm font-medium text-gray-700"
        >Phone</label
      >
      <div class="mt-1">
        {{ user.phone }}
      </div>
    </div>
  </div>

  <div
    class="
      inline-flex
      items-center
      px-4
      py-2
      text-xs
      font-semibold
      tracking-widest
      text-white
      uppercase
      bg-gray-800
      rounded-md
      border border-transparent
      ring-gray-300
      transition
      duration-150
      ease-in-out
      hover:bg-gray-700
      active:bg-gray-900
      focus:outline-none focus:border-gray-900 focus:ring
      disabled:opacity-25
      cursor-pointer
    "
  >
    <router-link :to="{ name: 'users.index' }">View</router-link>
    Go back
  </div>
</template>

<script lang="ts">
import useUsers from "../../composables/users";
import { onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const { errors, user, getUser } = useUsers();
    const route = useRoute();

    onMounted(() => {
        if(route.params.id && !Array.isArray(route.params.id)){
            getUser(route.params.id);
        }
    });

    return {
      user,
      errors,
    };
  },
};
</script>
