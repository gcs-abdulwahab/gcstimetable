import { Link } from "@inertiajs/react";
import { ArrowUpRight } from "lucide-react";
import Tooltip from "@/components/ui/tooltip";

export default function SimpleStats({
    title,
    value,
    navigation,
}: {
    title: string;
    value: number;
    navigation?: string;
}) {
    return (
        <div className="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-800">
            <div className="px-4 py-5 sm:p-6 relative">
                <dl>
                    <dt className="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                        {title}
                    </dt>
                    <dd className="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                        {value}
                    </dd>
                </dl>

                {navigation && (
                    <div className="mt-5 absolute top-0 right-4">
                        <Tooltip title="Show All">
                            <div className="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                <Link href={navigation}>
                                    <ArrowUpRight />
                                </Link>
                            </div>
                        </Tooltip>
                    </div>
                )}
            </div>
        </div>
    );
}
