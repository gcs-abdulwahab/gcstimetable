import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Student } from "@/types";
import { DataTable } from "@/Components/Table/DataTable";
import { ColumnDef } from "@tanstack/react-table";

export default function Students({ auth, students }: PageProps<{ students: Student[] }>) {

    const columns: ColumnDef<Student>[] = [
        {
            accessorKey: "id",
            header: "#",
        },
        {
            accessorKey: "name",
            header: "Name",
        },
        {
            accessorKey: "email",
            header: "Email",
        },
        {
            accessorKey: "mobile",
            header: "Phone"
        },
        {
            accessorKey: "createdAt",
            header: "Registration Date",
        },
    ];

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-card-foreground dark:text-gray-200 leading-tight">
                    Students
                </h2>
            }
        >
            <Head title="Students" />

            <div className="py-12">
                <div className="sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-background sm:rounded-lg">
                        <div className="p-6">
                            <DataTable
                                data={students}
                                columns={columns}
                                inputProps={{
                                    searchFilter: true,
                                    filterColumn: "email",
                                    pagination: true,
                                }}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
