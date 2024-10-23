import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Shift } from "@/types";
import { CheckCircle, XCircle } from "lucide-react";
import { Link } from "@inertiajs/react";
import { Allocation, Room } from "@/types/database";
import { Button } from "@/components/ui/button";
import { useBreadcrumb } from "@/components/providers/breadcrum-provider";
import { useEffect } from "react";

interface ShowRoomProps extends Record<string, unknown> {
    room: Room & {
        allocations: Allocation[];
    };
    shifts: Shift[];
}

export default function ShowRoom({
    auth,
    room,
    shifts,
}: PageProps<ShowRoomProps>) {

    const { setBreadcrumb } = useBreadcrumb();

    useEffect(() => {
        setBreadcrumb({
            title: 'Show',
            backItems : [
                {
                    title: 'Rooms',
                    url: route('rooms.index')
                }
            ]
        });
    }, [setBreadcrumb]);

    // Helper function to check if a room is available for a given slot and day
    const isRoomAvailableForSlot = (slotId: number, dayId: number): boolean => {
        // console.log('slotId', slotId, dayId);
        return !room.allocations?.some(
            (allocation) =>
                allocation.slot_id === slotId && allocation.day_id === dayId
        );
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Show Room" />

            <div className="bg-card text-card-foreground border border-border sm:rounded-lg shadow-lg">
                <div className="p-6 flex flex-col">
                    <div className="flex justify-between">
                        <h1 className="text-xl font-semibold mb-6 text-card-foreground dark:text-foreground">
                            Room Availability for {room.name}
                        </h1>
                        <Link
                            href={route("rooms.index")}
                            className="flex items-center space-x-2"
                        >
                            <Button variant={"outline"} >Back</Button>
                        </Link>
                    </div>

                    {/* Table structure to show availability */}
                    <div className="overflow-x-auto shadow-md rounded-lg">
                        <table className="min-w-full border-collapse table-auto bg-background text-foreground">
                            <thead className="bg-sidebar text-sidebar-foreground">
                                <tr>
                                    <th className="border-b p-4 text-left font-medium">
                                        Day
                                    </th>
                                    {shifts.map((shift) => (
                                        <th
                                            key={shift.id}
                                            className="border-b p-4 text-left font-medium"
                                        >
                                            {shift.name} Shift
                                        </th>
                                    ))}
                                </tr>
                            </thead>
                            <tbody>
                                {Array.from({ length: 6 }, (_, i) => i + 1).map(
                                    (dayNumber) => (
                                        <tr key={dayNumber}>
                                            <td className="border-b p-4 text-foreground font-medium">
                                                Day {dayNumber}
                                            </td>
                                            {shifts.map((shift) => (
                                                <td
                                                    key={shift.id}
                                                    className="border-b p-4"
                                                >
                                                    <div className="space-y-2">
                                                        {shift?.slots?.map(
                                                            (slot) => (
                                                                <div
                                                                    key={
                                                                        slot.id
                                                                    }
                                                                    className="flex items-center justify-between"
                                                                >
                                                                    <div>
                                                                        <span className="ml-1 text-sm text-foreground/80">
                                                                            {
                                                                                slot.start_time
                                                                            }{" "}
                                                                            -{" "}
                                                                            {
                                                                                slot.end_time
                                                                            }
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        {isRoomAvailableForSlot(
                                                                            slot.id,
                                                                            dayNumber
                                                                        ) ? (
                                                                            <span className="flex items-center text-green-500">
                                                                                <CheckCircle className="w-5 h-5 mr-1" />
                                                                                Available
                                                                            </span>
                                                                        ) : (
                                                                            <span className="flex items-center text-red-500">
                                                                                <XCircle className="w-5 h-5 mr-1" />
                                                                                Occupied
                                                                            </span>
                                                                        )}
                                                                    </div>
                                                                </div>
                                                            )
                                                        )}
                                                    </div>
                                                </td>
                                            ))}
                                        </tr>
                                    )
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
