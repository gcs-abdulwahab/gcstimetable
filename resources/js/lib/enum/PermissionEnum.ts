export enum PermissionEnum {
    CREATE_USER = "create user",
    EDIT_USER = "edit user",
    DELETE_USER = "delete user",
    VIEW_USER = "view user",

    CREATE_TEACHER = "create teacher",
    EDIT_TEACHER = "edit teacher",
    DELETE_TEACHER = "delete teacher",
    VIEW_TEACHER = "view teacher",

    CREATE_STUDENT = "create student",
    EDIT_STUDENT = "edit student",
    DELETE_STUDENT = "delete student",
    VIEW_STUDENT = "view student",

    CREATE_INSTITUTE = "create institute",
    EDIT_INSTITUTE = "edit institute",
    DELETE_INSTITUTE = "delete institute",
    VIEW_INSTITUTE = "view institute",

    CREATE_DEPARTMENT = "create department",
    EDIT_DEPARTMENT = "edit department",
    DELETE_DEPARTMENT = "delete department",
    VIEW_DEPARTMENT = "view department",

    CREATE_COURSE = 'create course'
}

export namespace PermissionEnum {
    export function hasAbility(permission: PermissionEnum) {}
}
