import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import { DataTable } from "@/Components/DataTable";
import columns, { Teacher } from "./columns";

export default function Teachers({
    auth,
    teachers,
}: PageProps<{ teachers: Teacher[] }>) {
    console.log("Teachers -> teachers", teachers);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Teachers
                </h2>
            }
        >
            <Head title="Teachers" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 sm:rounded-lg">
                        <div className="p-6">
                            <DataTable
                                data={teachers}
                                columns={columns}
                                tableLayout="fixed"
                                inputProps={{
                                    pagination: true,
                                    searchFilter: true,
                                    filterColumn: "email",
                                }}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
