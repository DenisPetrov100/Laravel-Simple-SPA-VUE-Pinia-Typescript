<template>
  <div class="flex place-content-end mb-4">
    <div
      v-if="!route.params.id || route.params.id == auth.user.id"
      class="
        px-4
        py-2
        text-white
        bg-indigo-600
        hover:bg-indigo-700
        cursor-pointer
      "
    >
      <router-link :to="{ name: 'payments.create' }" class="text-sm font-medium"
        >Create payment</router-link
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
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
              >Name</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
              >Amount</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
              >Description</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
              >Action</span
            >
          </th>
          <th class="bg-gray-50"></th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <template v-for="item in payments" :key="item.id">
          <tr class="bg-white">
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
                text-center
              "
            >
              {{ item.user.name }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
                text-center
              "
            >
              $ {{ item.amount }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
                text-center
              "
            >
              {{ item.description }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm text-center
                leading-5
                text-gray-900
                whitespace-no-wrap
                text-center
              "
            >
              <button
                @click="deletePayment(item.id)"
                class="
                  inline-flex
                  items-center
                  px-4
                  py-2
                  bg-gray-800
                  border border-transparent
                  rounded-md
                  font-semibold
                  text-xs text-white
                  uppercase
                  tracking-widest
                  hover:bg-gray-700
                  active:bg-gray-900
                  focus:outline-none focus:border-gray-900 focus:ring
                  ring-gray-300
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
</template>

<script lang="ts">
import usePayments from "../../composables/payments";
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import { useAuthStore } from "../../store/auth";

export default {
  setup() {
    const auth = useAuthStore();
    const { payments, getPayments, destroyPayment } = usePayments();
    const route = useRoute();

    const deletePayment = async (id) => {
      if (!window.confirm("You sure?")) {
        return;
      }

      await destroyPayment(id);
      await getPayments();
    };

    onMounted(() => {
      getPayments(route.params.id ? route.params.id : undefined);
    });

    return {
      auth,
      route,
      payments,
      deletePayment,
    };
  },
};
</script>
