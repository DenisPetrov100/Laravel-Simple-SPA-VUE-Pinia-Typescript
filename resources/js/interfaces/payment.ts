
export interface paymentStoreInterface {
    description: string
    amount: string
}
export interface paymentsInterface {
    description: string
    amount: string
}
export interface paymentInterface {
    description: string
    amount: string
    user: {
        id: number
        name: string
    }
}
