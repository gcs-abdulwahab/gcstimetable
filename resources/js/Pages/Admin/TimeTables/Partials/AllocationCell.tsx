import { cn } from "@/lib/utils";
import { Allocation } from "@/types/database";

export function AllocationCell({
    allocation,
    className,
}: {
    allocation: Allocation;
    className?: string;
}) {
    return (
        <span className={cn("text-sm", className)}>
            {allocation?.course?.code && (
                <span>{allocation?.course?.display_code}</span>
            )}
            {allocation?.teacher?.name && (
                <span> - {allocation?.teacher?.name}</span>
            )}
            {allocation?.room?.name && <span> - {allocation?.room?.name}</span>}
            {allocation && <span> - {allocation?.day?.name}</span>}
        </span>
    );
}
