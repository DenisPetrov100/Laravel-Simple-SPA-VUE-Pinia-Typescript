<template>
<div v-if="auth.user.id && auth.user.role" class="flex">
    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <navigation-link
                path="dashboard"
                title="Dashboard"
        />
    </div>
    <div v-if="(auth.user.role?.name == 'admin')"
        class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <navigation-link
            path="users.index"
            title="Users"
        />
    </div>
    <div v-else-if="auth.user.id" class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <navigation-link
            path="users.edit"
            title="Account Settings"
            :params="{ id: auth.user.id }"
        />
    </div>
    <div  v-if="(auth.user.role?.name == 'admin')"
        class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <navigation-link
                path="payments.index"
                title="Payments"
        />
    </div>
    <div v-else-if="auth.user.id"
        class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <navigation-link
            path="user.payments"
            title="My payments"
            :params="{ id: auth.user.id }"
        />
    </div>
</div>
</template>
<script lang="ts">
import { useAuthStore } from "../../store/auth";
import NavigationLink from './NavigationLink.vue'


export default {
  name: "NavigationLinks",
  components: {
      NavigationLink,
  },
  setup() {
    const auth = useAuthStore();
    return {
      auth,
    };
  },
};
</script>
