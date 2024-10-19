import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import { DataTable } from "@/Components/Table/DataTable";
import columns, { Teacher } from "./columns";
import { ResourcePaginator } from "@/types/data-table";

export default function Teachers({
    auth,
    teachers,
}: PageProps<{ teachers: ResourcePaginator<Teacher> }>) {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-card-foreground dark:text-gray-200 leading-tight">
                    Teachers
                </h2>
            }
        >
            <Head title="Teachers" />

            <div className="py-12">
                <div className="sm:px-6 lg:px-8">
                    <div className="bg-card text-card-foreground border border-border sm:rounded-lg">
                        <div className="p-6">
                            <DataTable
                                data={teachers.data}
                                columns={columns}
                                tableLayout="fixed"
                                inputProps={{
                                    pagination: false,
                                    searchFilter: true,
                                    filterColumn: "email",
                                }}
                                pageLinks={teachers.meta.links}
                                totalCount={teachers.meta.total}
                                from={teachers.meta.from}
                                to={teachers.meta.to}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
