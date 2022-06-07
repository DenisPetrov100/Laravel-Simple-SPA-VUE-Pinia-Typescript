export interface userInterface {
    created_at?: string | null
    email: string | null
    id?: number | null
    name: string | null
    phone: string | null
    role?: roleInterface | null
    updated_at?: string | null
    email_verified_at?: string | null
    password?: string | null
    password_confirmation?: string | null
}

export interface roleInterface {
    id: number | null
    name: string | null
}

export interface getUsersDataMetaLinksInterface {
    active: boolean
    label: string | null
    url: string | null
}
export interface getUsersDataLinksInterface {
    first: string | null
    last: string | null
    next: string | null
    prev: string | null
}

export interface getUsersDataMetaInterface {
    current_page: number
    from: number
    last_page: number
    links: getUsersDataMetaLinksInterface[]
    path: string
    per_page: number
    to: number
    total: number
}

export interface getUsersDataInterface {
    data: userInterface[]
    meta: getUsersDataMetaInterface
    links: getUsersDataLinksInterface
}
export interface getUsersInterface {
    data: getUsersDataInterface
}

export interface getUserDataInterface {
    data: getUserInterface
}
export interface getUserInterface {
    data: userInterface
}
export interface usersPaginationInterface {
    meta: getUsersDataMetaInterface | null
    links: getUsersDataLinksInterface | null
}



