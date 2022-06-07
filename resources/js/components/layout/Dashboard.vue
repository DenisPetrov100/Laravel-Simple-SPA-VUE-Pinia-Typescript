<template>
   <div>
       <h2 class="font-bold text-xl text-gray-800 leading-tight pb-8">
           Hello, {{ auth.getUserName }}!</h2>
       <p>
           Your email: {{ auth.getUserEmail }}
       </p>
       <p>
           Your role: {{ auth.getUserRole?.name }}
       </p>
   </div>
</template>
<script lang="ts">
import { useAuthStore } from "../../store/auth";

export default {
  name: "Dashboard",
  setup() {
    const auth = useAuthStore();
    return {
      auth,
    };
  },
};
</script>
