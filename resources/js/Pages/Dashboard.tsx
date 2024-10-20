import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Statistics } from "@/types";
import SimpleStats from "@/Components/SimpleStats";
import { useBreadcrumb } from "@/components/providers/breadcrum-provider";
import { useEffect } from "react";

export default function Dashboard({
    auth,
    statistics,
}: PageProps<{ statistics: Statistics }>) {
    const { setBreadcrumb } = useBreadcrumb();

    useEffect(() => {
        setBreadcrumb({
            title: "Dashboard",
        });
    }, [setBreadcrumb]);
    
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Dashboard" />
            <div className="flex flex-col sm:flex-row justify-between gap-4">
                <div className="flex-1">
                    <SimpleStats
                        title="Total Users"
                        value={statistics.users}
                        navigation={route("users.index")}
                    />
                </div>
                <div className="flex-1">
                    <SimpleStats
                        title="Total Students"
                        value={statistics.students}
                        navigation={route("students.index")}
                    />
                </div>
                <div className="flex-1">
                    <SimpleStats
                        title="Total Teachers"
                        value={statistics.teachers}
                        navigation={route("teachers.index")}
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
