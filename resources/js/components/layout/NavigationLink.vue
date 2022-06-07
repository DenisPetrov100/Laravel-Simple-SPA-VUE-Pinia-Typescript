<template>
    <div class="space-x-8 sm:-my-px sm:flex">

    <router-link
      :to="{ name: path, params: params }"
      class="
        inline-flex
        items-center
        px-1
        pt-1
        border-b-2 border-indigo-400
        text-sm
        font-medium
        leading-5
        text-gray-900
        focus:outline-none focus:border-indigo-700
        transition
        duration-150
        ease-in-out
      "
    >
      {{ title }}
    </router-link>
    </div>

</template>
<script lang="ts">
import { useAuthStore } from "../../store/auth";

export default {
  name: "NavigationLink",
  props: {
    path: {
      type: [String],
      required: true,
    },
    title: {
      type: [String],
      required: true,
    },
    params: {
      default: () => {},
    },
  },
  setup() {
    const auth = useAuthStore();
    return {
      auth,
    };
  },
};
</script>
