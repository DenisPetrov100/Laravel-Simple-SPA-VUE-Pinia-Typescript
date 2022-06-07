import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { paymentInterface, paymentStoreInterface } from '@/interfaces/payment'

export default function usePayments() {
    const payments = ref<paymentInterface[]>()

    const errors = ref('')
    const router = useRouter()

    const getPayments = async (id? :string | string[]) => {
        let response = await axios.get('/api/payments' + ((id == undefined && !Array.isArray(id))?  '' :  ('?id=' +id)))
        payments.value = response.data.data
    }

    const storePayment = async (data :paymentStoreInterface) => {
        errors.value = ''
        try {
            await axios.post('/api/payments', data)
            await router.push({ name: 'payments.index' })
        } catch (error: unknown) {
            if (error instanceof Error) {
                errors.value += error.message;
            }
        }

    }

    const destroyPayment = async (id :string) => {
        await axios.delete(`/api/payments/${id}`)
    }

    return {
        errors,
        payments,
        getPayments,
        storePayment,
        destroyPayment,
    }
}
