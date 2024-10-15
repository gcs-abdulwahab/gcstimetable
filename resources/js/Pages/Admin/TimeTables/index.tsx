import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, Link } from "@inertiajs/react";
import { PageProps, TimeStamp } from "@/types";
import { CirclePlus, Plus } from "lucide-react";
import SecondaryButton from "@/Components/SecondaryButton";

type TimeTable = {
    id: number;
    title: string;
    description: string;
    time_ago: string;
} & TimeStamp;

export default function TimeTables({
    auth,
    timeTables,
}: PageProps & { timeTables: TimeTable[] }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Time Tables
                </h2>
            }
        >
            <Head title="Time Tables" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                        <div className="p-6 flex justify-end cursor-pointer">
                            <Link href={route("timetables.create")}>
                                <SecondaryButton>
                                    <Plus
                                        size={15}
                                        className="mr-2 text-gray-800 dark:text-gray-100"
                                    />
                                    Add
                                </SecondaryButton>
                            </Link>
                        </div>
                        {timeTables.length > 0 ? (
                            timeTables.map((timeTable) => (
                                <div
                                    key={timeTable.id}
                                    className="px-6 py-3 cursor-pointer"
                                    onClick={() =>
                                        router.get(route("timetables.edit", timeTable.id))
                                    }
                                >
                                    <div className="flex items-center border border-gray-800 dark:border-gray-100 p-4 rounded-md">
                                        <div>
                                            <h2 className="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                {timeTable.title}
                                            </h2>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                {timeTable.description}
                                            </p>
                                        </div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400 ml-auto">
                                            {timeTable.time_ago}
                                        </p>
                                    </div>
                                </div>
                            ))
                        ) : (
                            <div className="p-6 text-center">
                                <p className="text-gray-600 dark:text-gray-400">
                                    No time tables found.
                                </p>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
