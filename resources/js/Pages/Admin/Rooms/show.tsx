import { FormEventHandler } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Shift, TimeStamp, TimeTable } from "@/types";
import { CheckCircle, XCircle } from "lucide-react";
import { router, useForm, Link } from "@inertiajs/react";
import {
    Card,
    CardHeader,
    CardTitle,
    CardDescription,
    CardContent,
    CardFooter,
} from "@/components/ui/card";
import SecondaryButton from "@/Components/SecondaryButton";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import InputLabel from "@/Components/InputLabel";
import InputError from "@/Components/InputError";
import { toast } from "@/hooks/use-toast";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Allocation, Room } from "@/types/database";

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
    // Helper function to check if a room is available for a given slot and day
    const isRoomAvailableForSlot = (slotId: number, dayId: number): boolean => {
        // console.log('slotId', slotId, dayId);
        return !room.allocations?.some(
            (allocation) =>
                allocation.slot_id === slotId && allocation.day_id === dayId
        );
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Show Room
                </h2>
            }
        >
            <Head title="Show Room" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg shadow-lg">
                        <div className="p-6 flex flex-col">
                            <h1 className="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
                                Room Availability for {room.name}
                            </h1>

                            {/* Table structure to show availability */}
                            <div className="overflow-x-auto shadow-md rounded-lg">
                                <table className="min-w-full border-collapse table-auto bg-white dark:bg-gray-900">
                                    <thead className="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th className="border-b p-4 text-left text-gray-600 dark:text-gray-300 font-medium">
                                                Day
                                            </th>
                                            {shifts.map((shift) => (
                                                <th
                                                    key={shift.id}
                                                    className="border-b p-4 text-left text-gray-600 dark:text-gray-300 font-medium"
                                                >
                                                    {shift.name} Shift
                                                </th>
                                            ))}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {Array.from(
                                            { length: 7 },
                                            (_, i) => i + 1
                                        ).map((dayNumber) => (
                                            <tr
                                                key={dayNumber}
                                                className="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                                            >
                                                <td className="border-b p-4 text-gray-700 dark:text-gray-300 font-medium">
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
                                                                            <span className="font-medium text-gray-700 dark:text-gray-300">
                                                                                {
                                                                                    slot.name
                                                                                }
                                                                                :
                                                                            </span>
                                                                            <span className="ml-1 text-sm text-gray-500 dark:text-gray-400">
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
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
