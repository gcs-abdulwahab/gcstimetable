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
import { Day, Instituion, Slot } from "@/types/database";

interface FormProps {
    time_table_id: number;
    slot_id: number;
    day_id: number | null;
}

interface CreateAllocationProps {
    props: {
        timetable: TimeTable & {
            shift: Shift & {
                institution: Instituion & {
                    days: Day[];
                };
            };
        };
        slot: Slot;
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
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("allocations.store"), {
            onSuccess: (response) => {
                toast({
                    title: "Allocation Created",
                    description: "Allocation is created successfully!",
                });
                handleClose();
            },
            onError: (error) => {
                if (error.message) {
                    toast({
                        variant: "destructive",
                        title: "Error!",
                        description: error.message,
                    });
                }
            },
        });
    };

    function handleClose() {
        router.get(route("timetables.index"));
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
                                            htmlFor="shift"
                                            value="Day"
                                            aria-required
                                        />
                                        <Select name="shift">
                                            <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                <SelectValue placeholder="Select a Day" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                {props?.timetable?.shift?.institution?.days?.map(
                                                    (day) => (
                                                        <SelectItem
                                                            key={day.id}
                                                            value={day.id.toString()}
                                                            onClick={() =>
                                                                setData(
                                                                    "day_id",
                                                                    day.id
                                                                )
                                                            }
                                                        >
                                                            {day.name}
                                                        </SelectItem>
                                                    )
                                                )}
                                            </SelectContent>
                                        </Select>
                                    </div>
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
