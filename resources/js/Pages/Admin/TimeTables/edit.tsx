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

interface FormProps {
    title: string;
    description: string;
    shift_id: number | null;
}

export default function EditTimeTable({
    auth,
    timetable,
    shifts
}: PageProps<{ timetable: TimeTable, shifts: Shift[] }>) {
    const { data, setData, put, errors, processing, reset } =
        useForm<FormProps>({
            title: timetable?.title,
            description: timetable?.description,
            shift_id: timetable?.shift?.id ?? null,
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        put(route("timetables.update", timetable.id), {
            onSuccess: (response) => {
                reset("title", "description");
                toast({
                    title: "Time Table Updated",
                    description: "Time Table has been updated successfully!",
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
                    Edit Time Table
                </h2>
            }
        >
            <Head title="Edit | Time Table" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                        <div className="p-6 flex justify-end">
                            <Card className="w-full bg-white shadow-md rounded-lg dark:bg-gray-800">
                                <CardHeader className="flex items-center space-x-4">
                                    <CardTitle>Edit Time Table</CardTitle>
                                </CardHeader>

                                <CardContent className="mt-4">
                                    <div className="mb-4">
                                        <InputLabel
                                            htmlFor="title"
                                            value="Title"
                                            aria-required
                                        />
                                        <TextInput
                                            autoFocus
                                            className={"w-full"}
                                            id="title"
                                            value={data.title}
                                            onChange={(e) =>
                                                setData("title", e.target.value)
                                            }
                                            required
                                        />
                                        <InputError message={errors.title} />
                                    </div>
                                    <div className="mb-4">
                                        <InputLabel
                                            htmlFor="description"
                                            value="Description"
                                            aria-required
                                        />
                                        <TextInput
                                            className={"w-full"}
                                            id="description"
                                            value={data.description}
                                            onChange={(e) =>
                                                setData(
                                                    "description",
                                                    e.target.value
                                                )
                                            }
                                            required
                                        />
                                        <InputError
                                            message={errors.description}
                                        />
                                    </div>

                                    <div className="mb-4">
                                        <InputLabel
                                            htmlFor="shift"
                                            value="Shift"
                                            aria-required
                                        />
                                        <Select
                                            name="shift"
                                            defaultValue={data.shift_id?.toString()}
                                            onValueChange={(value) =>
                                                setData(
                                                    "shift_id",
                                                    Number(value)
                                                )
                                            }
                                        >
                                            <SelectTrigger className="dark:bg-gray-900 dark:border dark:border-gray-700">
                                                <SelectValue placeholder="Select a shift" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                {shifts.map((shift) => (
                                                    <SelectItem
                                                        key={shift.id}
                                                        value={shift.id.toString()}
                                                    >
                                                        {shift.name}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <InputError message={errors.shift_id} />
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
                                        Update
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
