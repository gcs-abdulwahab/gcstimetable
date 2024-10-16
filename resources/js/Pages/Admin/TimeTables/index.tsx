import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, Link } from "@inertiajs/react";
import { PageProps, TimeStamp } from "@/types";
import { ArrowUpRight, CirclePlus, Plus } from "lucide-react";
import SecondaryButton from "@/Components/SecondaryButton";
import Tooltip from "@/components/ui/tooltip";

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
                            timeTables.map((timetable) => (
                                <div key={timetable.id} className="px-6 py-3">
                                    <div className="relative flex flex-col md:flex-row items-center border border-gray-800 dark:border-gray-100 p-4 rounded-md">
                                        <div>
                                            <div className="flex items-center">
                                                <h2
                                                    onClick={() =>
                                                        router.get(
                                                            route(
                                                                "timetables.edit",
                                                                timetable.id
                                                            )
                                                        )
                                                    }
                                                    className="text-lg font-semibold text-gray-800 dark:text-gray-200 cursor-pointer hover:underline"
                                                >
                                                    {timetable.title}
                                                </h2>
                                                <p className="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                                    {timetable.time_ago}
                                                </p>
                                            </div>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                {timetable.description}
                                            </p>
                                        </div>
                                        <Link
                                            href={route(
                                                "timetables.add.allocations",
                                                timetable.id
                                            )}
                                            className="p-2 ml-auto"
                                        >
                                            <Tooltip title="Add Allocations">
                                                <SecondaryButton>
                                                    Allocations
                                                </SecondaryButton>
                                            </Tooltip>
                                        </Link>
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
