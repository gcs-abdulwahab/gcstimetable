import { FormEventHandler, useEffect, useMemo, useState } from "react";
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
import {
    Day,
    Instituion,
    Room,
    Slot,
    Teacher,
    Semester,
    Course,
    Section,
    Allocation,
} from "@/types/database";
import { AutoCompleteSelect } from "@/components/combobox";
import { getNumberWithOrdinal } from "@/utils/helper";
import { AllocationCell } from "../TimeTables/Partials/AllocationCell";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";

interface FormProps {
    time_table_id: number;
    slot_id: number;
    day_id: number | null;
    section_id: number | null;
    room_id: number | null;
    teacher_id: number | null;
    course_id: number | null;
}

type ModifiedSection = {
    SemesterName: string;
    SemesterNo: number;
    SemesterId: number;
    ProgramType: string;
    id: number;
    name: string;
};

interface CreateAllocationProps {
    props: {
        timetable: TimeTable & {
            shift: Shift & {
                institution: Instituion & {
                    days?: Day[];
                    rooms?: Room[];
                    teachers?: Teacher[];
                    semesters?: Semester[];
                };
            };
        };
        slot: Slot;
        sections: ModifiedSection[];
        courses: Course[];
        allocations: Allocation[];
        haveSection: boolean;
    };
}

const EmptyAllocation: Allocation = {
    id: 0,
    day_id: 0,
    room_id: 0,
    teacher_id: 0,
    course_id: 0,
    section_id: 0,
    slot_id: 0,
    time_table_id: 0,
    name: "",
};

export default function CreateAllocation({
    auth,
    props,
}: PageProps & CreateAllocationProps) {

    // State
    const [selectedAllocation, setSelectedAllocation] = useState<Allocation>(
        props.allocations[0] ?? EmptyAllocation
    );

    const { data, setData, post, put, errors, processing, reset } =
        useForm<FormProps>({
            time_table_id: props?.timetable?.id,
            slot_id: props?.slot?.id,
            day_id: null,
            section_id:
                props?.sections.length > 1 ? null : props?.sections[0]?.id,
            room_id: null,
            teacher_id: null,
            course_id: null,
        });

    // Life Cycle Hooks
    useEffect(() => {
        if (selectedAllocation) {
            setData((data) => ({
                ...data,
                day_id: mapZeroToNull(selectedAllocation.day_id),
                room_id: mapZeroToNull(selectedAllocation.room_id),
                teacher_id: mapZeroToNull(selectedAllocation.teacher_id),
                course_id: mapZeroToNull(selectedAllocation.course_id),
            }));
        }
    }, [selectedAllocation]);

    function mapZeroToNull(value: number) {
        return value === 0 ? null : value;
    }

    const filteredCourse: Course[] | [] = useMemo(() => {
        if (data.section_id) {
            let semester = props?.sections?.find(
                (section: ModifiedSection) => section.id === data.section_id
            );
            return props?.courses?.filter(
                (course) => course.semester_id === semester?.SemesterId
            );
        }

        return [];
    }, [data.section_id]);

    const filteredRooms: Room[] | [] = useMemo(() => {
        if (data.section_id) {
            let semester = props?.sections?.find(
                (section: ModifiedSection) => section.id === data.section_id
            );

            return (props?.timetable?.shift?.institution?.rooms || []).filter(
                (room) =>
                    semester?.ProgramType === room?.type ||
                    room?.type === "BOTH"
            );
        }

        return [];
    }, [data.section_id]);

    // Submit Form
    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        if (selectedAllocation.id === 0) {
            // Create New Allocation
            post(route("allocations.store"), {
                onSuccess: () => {
                    reset('day_id', 'room_id', 'teacher_id', 'course_id');
                    setSelectedAllocation(EmptyAllocation);
                },
            });
        } else {
            // Update Existing Allocation
            put(route("allocations.update", selectedAllocation.id));
        }
    };

    function handleClose() {
        router.get(route('timetables.add.allocations', props.timetable));
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-card-foreground dark:text-gray-200 leading-tight">
                    Create Allocation
                </h2>
            }
        >
            <Head title="Create Allocation" />

            <div className="py-12">
                <div className="sm:px-6 lg:px-8">
                    <div className="bg-card text-card-foreground border border-border sm:rounded-lg">
                        <div className="p-6 space-y-4">
                            {/* Show Allocations */}

                            {props.allocations.length > 0 ? (
                                <ol className="w-full bg-white shadow-md rounded-lg dark:bg-background px-6 py-4 border border-border">
                                    {props.allocations?.map(
                                        (allocation: Allocation, index) => (
                                            <li key={allocation.id}>
                                                <span className="mr-4">
                                                    {index + 1} -{" "}
                                                </span>
                                                <span
                                                    onClick={() =>
                                                        setSelectedAllocation(
                                                            allocation
                                                        )
                                                    }
                                                >
                                                    <AllocationCell
                                                        className={cn(
                                                            "cursor-pointer text-base",
                                                            {
                                                                underline:
                                                                    selectedAllocation?.id ===
                                                                    allocation.id,
                                                            }
                                                        )}
                                                        allocation={allocation}
                                                    />
                                                </span>
                                            </li>
                                        )
                                    )}
                                    <li>
                                        <span className="mr-4">
                                            {props.allocations.length + 1} -{" "}
                                        </span>
                                        <span
                                            className={cn("cursor-pointer", {
                                                underline:
                                                    selectedAllocation?.id ===
                                                    0,
                                            })}
                                            onClick={() =>
                                                setSelectedAllocation(
                                                    EmptyAllocation
                                                )
                                            }
                                        >
                                            Create New Allocation
                                        </span>
                                    </li>
                                </ol>
                            ) : null}

                            {/* Create Allocation */}
                            <Card className="w-full bg-white shadow-md rounded-lg dark:bg-background border border-border">
                                <CardHeader className="flex items-center space-x-4">
                                    <CardTitle>Create Allocation</CardTitle>
                                </CardHeader>

                                <CardContent className="mt-4">
                                    <div className="mb-4 flex">
                                        <span className="font-bold w-2/12">
                                            TimeTable:{" "}
                                        </span>
                                        <span className="flex-1">
                                            {props?.timetable?.title}
                                        </span>
                                    </div>
                                    <div className="mb-4 flex">
                                        <span className="font-bold w-2/12">
                                            Time Slot:{" "}
                                        </span>
                                        <span className="flex-1">
                                            {props?.slot?.name}
                                        </span>
                                    </div>

                                    {props.haveSection === false ? (
                                        <div className="mb-4">
                                            <InputLabel
                                                htmlFor="section"
                                                value="Section"
                                            />
                                            <Select
                                                name="section"
                                                value={data.section_id?.toString()}
                                                onValueChange={(value) =>
                                                    setData(
                                                        "section_id",
                                                        Number(value)
                                                    )
                                                }
                                            >
                                                <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                    <SelectValue placeholder="Select Section" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {props?.sections.map(
                                                        (section) => (
                                                            <SelectItem
                                                                key={section.id}
                                                                value={section.id.toString()}
                                                            >
                                                                {getNumberWithOrdinal(
                                                                    section.SemesterNo
                                                                )}{" "}
                                                                - {section.name}{" "}
                                                                -{" "}
                                                                {
                                                                    section.SemesterName
                                                                }
                                                            </SelectItem>
                                                        )
                                                    )}
                                                </SelectContent>
                                            </Select>
                                            <InputError
                                                message={errors.section_id}
                                            />
                                        </div>
                                    ) : (
                                        <div className="mb-4 flex">
                                            <span className="font-bold w-2/12">
                                                Section:{" "}
                                            </span>
                                            <span className="flex-1">
                                                {props.sections[0]?.name} -{" "}
                                                {getNumberWithOrdinal(
                                                    props.sections[0]?.SemesterNo
                                                )}{" "}
                                                -{" "}
                                                {props.sections[0]?.SemesterName}
                                            </span>
                                        </div>
                                    )}

                                    <div className="grid grid-cols-12 gap-4">
                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="day"
                                                value="Day"
                                                aria-required
                                            />
                                            <Select
                                                name="day"
                                                value={data.day_id?.toString()}
                                                onValueChange={(value) =>
                                                    setData(
                                                        "day_id",
                                                        Number(value)
                                                    )
                                                }
                                            >
                                                <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                    <SelectValue placeholder="Select a Day" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {props?.timetable?.shift?.institution?.days?.map(
                                                        (day) => (
                                                            <SelectItem
                                                                key={day.id}
                                                                value={day.id.toString()}
                                                            >
                                                                {day.name}
                                                            </SelectItem>
                                                        )
                                                    )}
                                                </SelectContent>
                                            </Select>
                                            <InputError
                                                message={errors.day_id}
                                            />
                                        </div>

                                        {/* Rooms */}
                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="room"
                                                value="Room"
                                            />
                                            <Select
                                                name="room"
                                                disabled={
                                                    filteredRooms.length === 0
                                                }
                                                value={data.room_id?.toString()}
                                                onValueChange={(value) =>
                                                    setData(
                                                        "room_id",
                                                        Number(value)
                                                    )
                                                }
                                            >
                                                <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                    <SelectValue placeholder="Select Room" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {filteredRooms?.map(
                                                        (room) => (
                                                            <SelectItem
                                                                key={room.id}
                                                                value={room.id.toString()}
                                                            >
                                                                {room.name}
                                                            </SelectItem>
                                                        )
                                                    )}
                                                </SelectContent>
                                            </Select>
                                            <InputError
                                                message={errors.room_id}
                                            />
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-12 gap-4">
                                        {/* Teacher Id */}
                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="teacher"
                                                value="Teacher"
                                            />
                                            <Select
                                                name="teacher"
                                                value={data.teacher_id?.toString()}
                                                onValueChange={(value) =>
                                                    setData(
                                                        "teacher_id",
                                                        Number(value)
                                                    )
                                                }
                                            >
                                                <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                    <SelectValue placeholder="Select Teacher" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {props?.timetable?.shift?.institution?.teachers?.map(
                                                        (teacher) => (
                                                            <SelectItem
                                                                key={teacher.id}
                                                                value={teacher.id.toString()}
                                                            >
                                                                {teacher.name}
                                                            </SelectItem>
                                                        )
                                                    )}
                                                </SelectContent>
                                            </Select>
                                            <InputError
                                                message={errors.teacher_id}
                                            />
                                        </div>

                                        {/* Course Id */}

                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="course"
                                                value="Course"
                                            />
                                            <Select
                                                name="course"
                                                disabled={
                                                    filteredCourse?.length === 0
                                                }
                                                value={data.course_id?.toString()}
                                                onValueChange={(value) =>
                                                    setData(
                                                        "course_id",
                                                        Number(value)
                                                    )
                                                }
                                            >
                                                <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                    <SelectValue placeholder="Select Course" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {filteredCourse?.map(
                                                        (course) => (
                                                            <SelectItem
                                                                key={course.id}
                                                                value={course.id.toString()}
                                                            >
                                                                <span>
                                                                    {
                                                                        course.code
                                                                    }{" "}
                                                                </span>
                                                                <span className="ml-auto">
                                                                    Credit{" "}
                                                                    {
                                                                        course.credit_hours
                                                                    }{" "}
                                                                    hrs
                                                                </span>
                                                            </SelectItem>
                                                        )
                                                    )}
                                                </SelectContent>
                                            </Select>
                                        </div>
                                    </div>
                                </CardContent>

                                <CardFooter className="mt-4 flex justify-end gap-3">
                                    <Button variant={'outline'} onClick={handleClose}>
                                        Cancel
                                    </Button>
                                    <Button
                                        size={'sm'}
                                        className="px-4"
                                        onClick={submit}
                                        disabled={processing}
                                    >
                                        Save
                                    </Button>
                                </CardFooter>
                            </Card>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
