import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, UserType } from "@/types";
import { DataTable } from "@/Components/Table/DataTable";
import columns from "./columns";
import { ResourcePaginator } from "@/types/data-table";
import { Room } from "@/types/database";

export default function Rooms({
    auth,
    rooms,
}: PageProps<{ rooms: Room[] }>) {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Rooms
                </h2>
            }
        >
            <Head title="Rooms" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 sm:rounded-lg">
                        <div className="p-6">
                            <DataTable
                                data={rooms}
                                columns={columns}
                                inputProps={{
                                    searchFilter: true,
                                    filterColumn: "code",
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
