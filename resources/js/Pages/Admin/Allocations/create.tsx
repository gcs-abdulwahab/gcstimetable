import { FormEventHandler } from "react";
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
import { Day, Instituion, Room, Slot } from "@/types/database";
import { ComboboxDemo } from "@/components/combobox";
import { getNumberWithOrdinal } from "@/utils/helper";

interface FormProps {
    time_table_id: number;
    slot_id: number;
    day_id: number | null;
    section_id: number | null;
    room_id: number | null;
}

type ModifiedSection = {
    SemesterName: string;
    SemesterNo: number;
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
                };
            };
        };
        slot: Slot;
        sections: ModifiedSection[];
    };
}

export default function CreateAllocation({
    auth,
    props,
}: PageProps & CreateAllocationProps) {
    console.log("CreateAllocation -> Props", props);

    const { data, setData, post, errors, processing, reset } =
        useForm<FormProps>({
            time_table_id: props?.timetable?.id,
            slot_id: props?.slot?.id,
            day_id: null,
            section_id: null,
            room_id: null,
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("allocations.store"), {
            onError: (error) => {
                if (error.message) {
                    toast({
                        variant: "destructive",
                        title: "Error!",
                        description: error.message,
                    });
                }
            },
            onSuccess: (response) => {
                toast({
                    title: "Allocation Created",
                    description: "Allocation is created successfully!",
                });
                // handleClose();
            },
        });
    };

    function handleClose() {
        // router.get(route("timetables.add.allocations", props?.timetable?.id));
        history.back();
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Create Allocation
                </h2>
            }
        >
            <Head title="Create Allocation" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                        <div className="p-6 flex justify-end">
                            <Card className="w-full bg-white shadow-md rounded-lg dark:bg-gray-800">
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

                                    <div className="mb-4">
                                        <InputLabel
                                            htmlFor="day"
                                            value="Day"
                                            aria-required
                                        />
                                        <Select
                                            name="day"
                                            defaultValue={data.day_id?.toString()}
                                            onValueChange={(value) =>
                                                setData("day_id", Number(value))
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
                                        <InputError message={errors.day_id} />
                                    </div>

                                    <div className="grid grid-cols-12 gap-4">
                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="section"
                                                value="Section"
                                            />
                                            <Select
                                                name="section"
                                                defaultValue={data.section_id?.toString()}
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
                                            <InputError message={errors.section_id} />
                                        </div>

                                        {/* Rooms */}
                                        <div className="mb-4 col-span-12 md:col-span-6">
                                            <InputLabel
                                                htmlFor="room"
                                                value="Room"
                                            />
                                            <Select
                                                name="room"
                                                defaultValue={data.room_id?.toString()}
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
                                                    {props?.timetable?.shift?.institution?.rooms?.map(
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
                                            <InputError message={errors.room_id} />
                                        </div>
                                    </div>

                                    {/* <div>
                                        <ComboboxDemo
                                            label="Select Section..."
                                            value={data.section_id}
                                            setValue={(value: any) =>
                                                setData("section_id", value)
                                            }
                                            values={(props?.sections || []).map(
                                                (section) => ({
                                                    value: section.id,
                                                    label: `${section.SemesterNo} - ${section.name} - ${section.SemesterName}`,
                                                })
                                            )}
                                        />
                                    </div> */}
                                </CardContent>

                                <CardFooter className="mt-4 flex justify-end gap-3">
                                    <SecondaryButton onClick={handleClose}>
                                        Cancel
                                    </SecondaryButton>
                                    <PrimaryButton
                                        onClick={submit}
                                        disabled={processing}
                                    >
                                        Save
                                    </PrimaryButton>
                                </CardFooter>
                            </Card>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
