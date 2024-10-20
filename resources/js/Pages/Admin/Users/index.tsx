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
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Users" />

            <div className="bg-card border border-border text-foreground sm:rounded-lg">
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
        </AuthenticatedLayout>
    );
}
