import { Config } from "ziggy-js";
import { Slot } from "./database";

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
    verifiedAt: string;
    profilePhotoUrl: string;
    label: string;
    roles: Role[];
    permissions: Permission[];
}

export type UserType = User & {
    createdAt: string;
    verifiedAt: string;
};

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

export type TimeStamp = {
    createdAt: string;
    updatedAt: string;
};

export type Shift = {
    id: number;
    name: string;
    comments: string;
    slots?: Slot[];
}

export type TimeTable = {
    id: number;
    title: string;
    description: string;
    shift_id: number;
    shift?: Shift;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
