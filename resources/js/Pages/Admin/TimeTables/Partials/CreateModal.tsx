import { FormEventHandler } from "react";
import { Shift } from "@/types";
import { useForm } from "@inertiajs/react";
import {
    Card,
    CardHeader,
    CardTitle,
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
import Modal from "@/Components/Modal";

interface FormProps {
    title: string;
    description: string;
    shift_id: number | null;
}

export function CreateModal({
    show,
    handleClose,
    shifts,
}: {
    show: boolean;
    handleClose: () => void;
    shifts: Shift[];
}) {
    const { data, setData, post, errors, processing, reset } = useForm<FormProps>({
        title: "",
        description: "",
        shift_id: null,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("timetables"), {
            onFinish: () => {
                reset("title", "description");
                handleClose();
            },
        });
    };

    return (
        <Modal
            show={show}
            onClose={handleClose}
            maxWidth="md"
            className="!w-full"
        >
            <Card className="w-full bg-white shadow-md rounded-lg dark:bg-background">
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
                            onChange={(e) => setData("title", e.target.value)}
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
                                setData("description", e.target.value)
                            }
                            required
                        />
                        <InputError message={errors.description} />
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
                                setData("shift_id", Number(value))
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
                    <Button variant={"outline"} onClick={handleClose}>
                        Cancel
                    </Button>
                    <Button onClick={submit} disabled={processing}>
                        Update
                    </Button>
                </CardFooter>
            </Card>
        </Modal>
    );
}
