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
        <div className="bg-card border border-border overflow-hidden shadow sm:rounded-lg dark:bg-card">
            <div className="px-4 py-5 sm:p-6 relative">
                <dl>
                    <dt className="text-sm leading-5 font-medium truncate">
                        {title}
                    </dt>
                    <dd className="mt-1 text-3xl leading-9 font-semibold text-primary">
                        {value}
                    </dd>
                </dl>

                {navigation && (
                    <div className="mt-5 absolute top-0 right-4">
                        <Tooltip title="Show All">
                            <div className="text-primary hover:opacity-80">
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
