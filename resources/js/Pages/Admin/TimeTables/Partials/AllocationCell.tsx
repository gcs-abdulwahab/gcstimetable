import { Allocation } from "@/types/database";

export function AllocationCell({ allocation }: { allocation: Allocation }) {
    return (
        <div className="flex items-center space-x-2">
            {allocation?.course?.code && (
                <div className="flex items-center space-x-2">
                    <div>{allocation?.course?.code}</div>
                </div>
            )}
            {allocation?.teacher?.name && (
                <div className="flex items-center space-x-2">
                    <div>{allocation?.teacher?.name}</div>
                </div>
            )}
            {allocation?.room?.name && (
                <div className="flex items-center space-x-2">
                    <div>{allocation?.room?.name}</div>
                </div>
            )}
            {allocation && (
                <div className="flex items-center space-x-2">
                    <div>{allocation?.day?.name}</div>
                </div>
            )}
        </div>
    );
}
