export interface authUserResponseInterface {
    data: {
        email: string
        id: number
        name: string
    }
}
export interface authUserRoleResponseInterface {
    data: {
        id: number
        name: string
    }
}
export interface authUserRolesResponseInterface {
    data: authUserRoleInterface[]
}
export interface authUserRoleInterface {
    id: number
    name: string
}
export interface authUserInterface {
    email: string | null
    id: number | null
    name: string | null
    role: {
        name: string | null
    }
}

export interface authStateInterface {
    user: authUserInterface
    roles: authUserRoleInterface[]
    stateIsReady: boolean
    //getRoles: Function
    // getUserInfo: Function
    // getUserName: Function
    // getUserEmail: Function
    // getUserRole: Function
}
