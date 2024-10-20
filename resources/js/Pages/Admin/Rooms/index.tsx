import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, UserType } from "@/types";
import { DataTable } from "@/Components/Table/DataTable";
import columns from "./columns";
import { ResourcePaginator } from "@/types/data-table";
import { Room } from "@/types/database";

export default function Rooms({ auth, rooms }: PageProps<{ rooms: Room[] }>) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Rooms" />
            <div className="bg-card text-card-foreground border border-border sm:rounded-lg">
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
        </AuthenticatedLayout>
    );
}
