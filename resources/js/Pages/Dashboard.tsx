import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps, Statistics } from '@/types';
import SimpleStats from '@/Components/SimpleStats';

export default function Dashboard({ auth, statistics }: PageProps<{ statistics : Statistics }>) {

    console.log("Dashboard -> statistics", statistics);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="flex flex-col sm:flex-row justify-between gap-4">
                        <div className="flex-1">
                            <SimpleStats title="Total Users" value={statistics.users} navigation={route('users')} />
                        </div>
                        <div className="flex-1">
                            <SimpleStats title="Total Students" value={statistics.students} />
                        </div>
                        <div className="flex-1">
                            <SimpleStats title="Total Teachers" value={statistics.teachers} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
