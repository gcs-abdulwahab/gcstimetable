import { useState, useEffect } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Shift, TimeStamp, TimeTable } from "@/types";
import { router, useForm, Link } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton";
import { ArrowUpRight, Plus } from "lucide-react";
import Tooltip from "@/components/ui/tooltip";
import { getRomanNumber } from "@/utils/helper";
import { Allocation, Section, Slot } from "@/types/database";
import { AllocationCell } from "./Partials/AllocationCell";

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

    function handleCreateAllocation(slot: Slot, section_id = null as any) {
        let params : any = {
            time_table_id: timetable.id,
            slot_id: slot.id,
        };

        if (section_id) {
            params["section_id"] = section_id;
        }

        router.get(
            route("allocations.create", params)
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

                            <div className="grid grid-cols-12 gap-2 overflow-auto">
                                {/* Shift Slots Header */}
                                <div className="col-span-12 flex">
                                    <p className="flex-1 font-bold text-gray-800 dark:text-gray-100 text-center h-[50px] w-[200px] flex items-center justify-center overflow-hidden">
                                        Period
                                    </p>
                                    {timetable.shift?.slots?.map(
                                        (slot, index) => (
                                            <p
                                                key={`period-${index}`}
                                                className="flex-1 font-bold text-gray-800 dark:text-gray-100 text-center h-[50px] w-[200px] flex items-center justify-center overflow-hidden"
                                            >
                                                {getRomanNumber(index + 1)}
                                            </p>
                                        )
                                    )}
                                </div>

                                {/* Time Header */}
                                <div className="col-span-12 flex">
                                    <p className="flex-1 font-bold text-gray-800 dark:text-gray-100 text-center h-[50px] w-[200px] flex items-center justify-center overflow-hidden">
                                        Time
                                    </p>
                                    {timetable.shift?.slots?.map((slot) => (
                                        <p
                                            key={slot.id}
                                            className="flex-1 font-bold text-gray-800 dark:text-gray-100 text-center h-[50px] w-[200px] flex items-center justify-center overflow-hidden"
                                        >
                                            {slot.name}
                                        </p>
                                    ))}
                                </div>

                                {/* Allocations With Sections */}
                                {sections.length > 0 &&
                                    sections.map((section) => (
                                        <div
                                            key={section.id}
                                            className="col-span-12 flex text-center"
                                        >
                                            {/* Section Name */}
                                            <p className="text-sm flex-1 text-center h-[100px] w-[200px] flex justify-center items-center overflow-hidden">
                                                {section?.semester?.name} (
                                                {section.name})
                                            </p>

                                            {timetable.shift?.slots?.map(
                                                (slot) => {
                                                    let alloc = getAllocation(
                                                        slot.id,
                                                        section.id
                                                    );

                                                    if (alloc) {
                                                        return (
                                                            <p
                                                                key={slot.id}
                                                                className="flex-1 text-center h-[100px] w-[200px] flex items-center justify-center overflow-hidden"
                                                            >
                                                                <AllocationCell
                                                                    allocation={
                                                                        alloc
                                                                    }
                                                                />
                                                            </p>
                                                        );
                                                    } else {
                                                        return (
                                                            <p
                                                                key={slot.id}
                                                                className="flex-1 text-center h-[100px] w-[200px] flex items-center justify-center overflow-hidden"
                                                            >
                                                                <SecondaryButton
                                                                    onClick={() =>
                                                                        handleCreateAllocation(
                                                                            slot,
                                                                            section.id
                                                                        )
                                                                    }
                                                                >
                                                                    <Plus
                                                                        size={
                                                                            16
                                                                        }
                                                                    />
                                                                </SecondaryButton>
                                                            </p>
                                                        );
                                                    }
                                                }
                                            )}
                                        </div>
                                    ))}

                                {/* Empty Section */}
                                <div className="col-span-12 flex text-center">
                                    <p className="flex-1 text-center h-[100px] w-[200px]"></p>
                                    {timetable.shift?.slots?.map((slot) => (
                                        <p
                                            key={slot.id}
                                            className="flex-1 text-center h-[100px] w-[200px] flex items-center justify-center overflow-hidden"
                                        >
                                            <SecondaryButton
                                                onClick={() =>
                                                    handleCreateAllocation(slot)
                                                }
                                            >
                                                <Plus size={16} />
                                            </SecondaryButton>
                                        </p>
                                    ))}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
