import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: string;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    role: string;
    profile: Profile;
}

export interface Profile {
    id: string;
    user_id: string;
    photo: File | null;
    photo_url: string;
}

export interface Paginated<T> {
    current_page: number;
    data: T[];
    per_page: number;
    total: number;
    last_page: number;
    from?: number;
    to?: number;
    links: Array;
}

export type BreadcrumbItemType = BreadcrumbItem;
