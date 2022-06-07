<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="savePayment">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <input type="text" description="description" id="description"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.description">
                </div>
            </div>
            <div>
                <label for="roleId" class="block text-sm font-medium text-gray-700">Amount</label>
                <div class="relative">
                    <select v-model="form.amount" name="roleId" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="10.23">$10.23</option>
                        <option value="20.58">$20.58</option>
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
import usePayments from '../../composables/payments'
import { reactive } from 'vue'

export default {
    setup() {
        const form = reactive({
            description: '',
            amount: '10.23',
          })

        const { errors, storePayment } = usePayments()

        const savePayment = async () => {
            await storePayment({ ...form })
        }

        return {
            form,
            errors,
            savePayment
        }
    }
}
</script>
