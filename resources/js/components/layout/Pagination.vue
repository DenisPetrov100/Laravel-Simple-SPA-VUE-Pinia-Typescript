<template>
  <div v-if="meta != null && links != null">
    <nav aria-label="Page navigation" class="mt-8">
      <ul class="inline-flex -space-x-px">
        <template v-for="(link, key) in pageLinks" :key="key">
          <li
            v-if="link.label == meta.last_page"
            :class="meta.current_page == link.label ? 'pagination-active' : ''"
          >
            <router-link
              :to="{ name: 'users.index', query: { page: link.label } }"
              @click="setPage(link.label)"
              class="
                py-2
                px-3
                leading-tight
                text-gray-500
                bg-white
                rounded-r-lg
                border border-gray-300
                hover:bg-gray-100 hover:text-gray-700
                dark:bg-gray-800
                dark:border-gray-700
                dark:text-gray-400
                dark:hover:bg-gray-700
                dark:hover:text-white
              "
              >{{ link.label }}</router-link
            >
          </li>
          <li
            v-else-if="key == 0"
            :class="meta.current_page == link.label ? 'pagination-active' : ''"
          >
            <router-link
              :to="{ name: 'users.index', query: { page: link.label } }"
              @click="setPage(link.label)"
              class="
                py-2
                px-3
                leading-tight
                text-gray-500
                bg-white
                rounded-l-lg
                border border-gray-300
                hover:bg-gray-100 hover:text-gray-700
                dark:bg-gray-800
                dark:border-gray-700
                dark:text-gray-400
                dark:hover:bg-gray-700
                dark:hover:text-white
              "
              >{{ link.label }}</router-link>
          </li>
          <li
            v-else-if="key != 0 && key != meta.total - 1 && link.url"
            :class="meta.current_page == link.label ? 'pagination-active' : ''"
          >
            <router-link
              :to="{ name: 'users.index', query: { page: link.label } }"
              @click="setPage(link.label)"
              class="
                py-2
                px-3
                leading-tight
                text-gray-500
                bg-white
                border border-gray-300
                hover:bg-gray-100 hover:text-gray-700
                dark:bg-gray-800
                dark:border-gray-700
                dark:text-gray-400
                dark:hover:bg-gray-700
                dark:hover:text-white
              "
              >{{ link.label }}</router-link
            >
          </li>
          <li v-else-if="!link.url">
            <span
              :to="{ name: 'users.index', query: { page: link.label } }"
              class="
                py-2
                px-3
                leading-tight
                text-gray-500
                bg-white
                border border-gray-300
                hover:bg-gray-100 hover:text-gray-700
                dark:bg-gray-800
                dark:border-gray-700
                dark:text-gray-400
                dark:hover:bg-gray-700
                dark:hover:text-white
              "
              >{{ link.label }}</span
            >
          </li>
        </template>
      </ul>
    </nav>
  </div>
</template>
<script lang="ts">
import { inject, computed } from "vue";

export default {
  name: "Pagination",
  props: ["links", "meta"],
  setup(props) {
    const page = inject("user-pagination-page") as any;
    const setPage = (newPage) => {
      page.value = newPage;
    };

    const pageLinks = computed(() => {
      if (Array.isArray(props.meta?.links)) {
        let links = props.meta.links.slice(1, -1);
        return links;
      }
    });

    return {
      pageLinks,
      setPage,
    };
  },
};
</script>
<style scoped>
.pagination-active a {
  color: black;
  font-weight: 700;
}
</style>
