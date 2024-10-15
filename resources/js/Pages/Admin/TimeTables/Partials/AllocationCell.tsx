import { Allocation } from "@/types/database";

export function AllocationCell({ allocation }: { allocation: Allocation }) {
    return (
        <div className="text-sm">
            {allocation?.course?.code && (
                <span>{allocation?.course?.display_code}</span>
            )}
            {allocation?.teacher?.name && (
                <span> - {allocation?.teacher?.name}</span>
            )}
            {allocation?.room?.name && <span> - {allocation?.room?.name}</span>}
            {allocation && <span> - {allocation?.day?.name}</span>}
        </div>
    );
}
