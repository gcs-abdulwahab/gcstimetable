import { FormEventHandler, useState, useEffect } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Shift, TimeStamp, TimeTable } from "@/types";
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
import { toast } from "@/hooks/use-toast";
import { MoveUpRight, ArrowUpRight, Plus } from "lucide-react";
import Tooltip from "@/components/ui/tooltip";
import { getRomanNumber } from "@/utils/helper";
import { Allocation, Section, Slot } from "@/types/database";
import { AllocationCell } from "./Partials/AllocationCell";

interface FormProps {
    title: string;
    description: string;
    shift_id: number | null;
}

export default function AddAllocationsTimeTable({
    auth,
    timetable,
    sections,
}: PageProps<{ timetable: TimeTable; sections: Section[] }>) {
    console.log(
        "AddAllocationsTimeTable => allocations",
        timetable.allocations
    );

    // state
    const [allocations, setAllocations] = useState<Allocation[]>([]);

    useEffect(() => {
        if (timetable?.allocations?.length) {
            setAllocations(timetable.allocations);
        }
    }, [timetable]);

    function handleClose() {
        router.get(route("timetables.index"));
    }

    function getAllocation(slotId: number, sectionId: number) {
        return (
            allocations &&
            allocations.find(
                (allocation) =>
                    allocation.slot_id === slotId &&
                    allocation.section_id === sectionId
            )
        );
    }

    function handleCreateAllocation(slot: Slot) {
        router.get(
            route("allocations.create", {
                time_table_id: timetable.id,
                slot_id: slot.id,
            })
        );
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Add Allocations Time Table
                </h2>
            }
        >
            <Head title="Add Allocations" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                        <div className="p-6 flex flex-col">
                            {/* Time Table Infor */}
                            <div className="w-full text-center relative">
                                <div className="flex gap-4 justify-center">
                                    <h2 className="text-lg font-bold">
                                        {timetable.title}
                                    </h2>
                                    <Tooltip title="Shift">
                                        <span className="text-sm self-end">
                                            {timetable.shift?.name}
                                        </span>
                                    </Tooltip>
                                </div>
                                <p>{timetable.description}</p>
                                <Link
                                    href={route(
                                        "timetables.edit",
                                        timetable.id
                                    )}
                                    className="absolute top-0 right-0 p-2"
                                >
                                    <Tooltip title="Edit Time Table">
                                        <ArrowUpRight
                                            className="text-gray-700 dark:text-gray-100"
                                            size={20}
                                        />
                                    </Tooltip>
                                </Link>
                            </div>

                            <hr className="my-10" />

                            {/* Shift Slots */}
                            <table className="min-w-7xl max-w-7xl overflow-auto">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        {timetable.shift?.slots?.map(
                                            (slot, index) => (
                                                <th key={`period-${index}`}>
                                                    {getRomanNumber(index + 1)}
                                                </th>
                                            )
                                        )}
                                    </tr>
                                    <tr>
                                        <th>Time</th>
                                        {timetable.shift?.slots?.map((slot) => (
                                            <th key={slot.id}>{slot.name}</th>
                                        ))}
                                    </tr>
                                </thead>
                                <tbody>
                                    {/* Allocations With Sections */}
                                    {sections.length > 0 &&
                                        sections.map((section) => (
                                            <tr className="text-center">
                                                {/* Section Name */}
                                                <td className="py-10 text-wrap">
                                                    {section?.semester?.name}(
                                                    {section.name})
                                                </td>

                                                {timetable.shift?.slots?.map(
                                                    (slot) => {
                                                        let alloc =
                                                            getAllocation(
                                                                slot.id,
                                                                section.id
                                                            );

                                                        if (alloc) {
                                                            return (
                                                                <td>
                                                                    <AllocationCell
                                                                        allocation={
                                                                            alloc
                                                                        }
                                                                    />
                                                                </td>
                                                            );
                                                        } else {
                                                            return (
                                                                <td
                                                                    key={
                                                                        slot.id
                                                                    }
                                                                    className="py-10"
                                                                >
                                                                    <SecondaryButton
                                                                        onClick={() =>
                                                                            handleCreateAllocation(
                                                                                slot
                                                                            )
                                                                        }
                                                                    >
                                                                        <Plus
                                                                            size={
                                                                                16
                                                                            }
                                                                        />
                                                                    </SecondaryButton>
                                                                </td>
                                                            );
                                                        }
                                                    }
                                                )}
                                            </tr>
                                        ))}

                                    {/* Empty Section */}
                                    <tr className="text-center">
                                        <td className="py-10"></td>
                                        {timetable.shift?.slots?.map((slot) => (
                                            <td key={slot.id} className="py-10">
                                                <SecondaryButton
                                                    onClick={() =>
                                                        handleCreateAllocation(
                                                            slot
                                                        )
                                                    }
                                                >
                                                    <Plus size={16} />
                                                </SecondaryButton>
                                            </td>
                                        ))}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
