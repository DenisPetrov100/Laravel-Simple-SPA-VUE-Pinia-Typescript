<template>
    {{ auth.getUserName }}
</template>
<script lang="ts">
import { useAuthStore } from "../../store/auth";

export default {
  name: "UserName",
  setup() {
    const auth = useAuthStore();
    return {
      auth,
    };
  },
};
</script>
