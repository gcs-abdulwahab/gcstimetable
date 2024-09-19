import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, UserType } from "@/types";
import { DataTable } from "@/Components/Table/DataTable";
import columns from "./columns";
import { ResourcePaginator } from "@/types/data-table";

export default function Users({
    auth,
    users,
}: PageProps<{ users: ResourcePaginator<UserType> }>) {
    console.log("Users -> users", users);
    console.log("Users  -> auth", auth);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Users
                </h2>
            }
        >
            <Head title="Users" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 sm:rounded-lg">
                        <div className="p-6">
                            <DataTable
                                data={users.data}
                                columns={columns}
                                inputProps={{
                                    searchFilter: true,
                                    filterColumn: "email",
                                    pagination: false,
                                }}
                                pageLinks={users.meta.links}
                                totalCount={users.meta.total}
                                from={users.meta.from}
                                to={users.meta.to}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
