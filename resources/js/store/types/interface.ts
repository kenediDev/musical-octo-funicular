export interface Category {
    id: number;
    name: string;
    icon: string;
    product: Product[];
}

export interface Product {
    id: number;
    name: string;
    image: string;
    category?: Category;
    price: string;
    sold: boolean;
}

export interface Message {
    loading: boolean;
    message: string;
    valid: number;
    soft_loading: string;
}

export interface Accounts {
    first_name: string;
    last_name: string;
    avatar: string;
    background: string;
    is_superuser: boolean;
    brithday: string;
    gender: string;
    staff: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    password: string;
    accounts?: Accounts;
}

export interface UserState {
    user: User[];
    data: User;
    message: Message;
}

type Modals = "profile" | "dashboardDialog";

export interface Update {
    name?: string;
    title?: string;
    description?: string;
    price?: string;
    photo?: any;
    gender?: string;
    calendar?: Date;
    modals?: {
        type?: Modals | string;
        open?: number;
    };
}

export interface Dialog {
    open: number;
    type: string;
}

export interface CategoryState {
    category: Category[];
    data: Category;
}

export interface ProductState {
    product: Product[];
    data: Product;
}
