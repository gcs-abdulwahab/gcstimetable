import { Config } from "ziggy-js";

interface Role {
    id: number;
    name: string;
}

interface Permission {
    id: number;
    name: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    profile_photo_url: string;
    label: string;
    roles: Role[];
    permissions: Permission[];
}

export interface Student {
    id: number;
    name: string;
    email: string;
    mobile: string;
}

export interface Statistics {
    users: number;
    students: number;
    teachers: number;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
