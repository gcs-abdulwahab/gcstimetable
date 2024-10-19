import { FormEventHandler } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps, Shift, TimeStamp } from "@/types";
import { router, useForm, Link } from "@inertiajs/react";
import {
    Card,
    CardHeader,
    CardTitle,
    CardDescription,
    CardContent,
    CardFooter,
} from "@/components/ui/card";
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
import { Button } from "@/components/ui/button";

interface FormProps {
    title: string;
    description: string;
    shift_id: number | null;
}

export default function CreateTimeTable({
    auth,
    shifts,
}: PageProps<{ shifts: Shift[] }>) {
    console.log("Create Time Table -> shifts", shifts);
    const { data, setData, post, errors, processing, reset } =
        useForm<FormProps>({
            title: "",
            description: "",
            shift_id: null,
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("timetables.store"), {
            onSuccess: (response) => {
                reset("title", "description");
                toast({
                    title: "Time Table Created",
                    description: "Time Table has been created successfully!",
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
                <h2 className="font-semibold text-xl text-card-foreground dark:text-gray-200 leading-tight">
                    Create Time Table
                </h2>
            }
        >
            <Head title="Create | Time Table" />

            <div className="py-12">
                <div className="sm:px-6 lg:px-8">
                    <div className="bg-card border border-border text-foreground sm:rounded-lg">
                        <div className="p-6 flex justify-end">
                            <Card className="w-full bg-white shadow-md rounded-lg dark:bg-background">
                                <CardHeader className="flex items-center space-x-4">
                                    <CardTitle>Create Time Table</CardTitle>
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
                                                {shifts?.length > 0 &&
                                                    shifts.map((shift) => (
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
                                    <Button variant={'outline'} onClick={handleClose}>
                                        Cancel
                                    </Button>
                                    <Button
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
