import React, { useState, FormEventHandler } from "react";
import { router, useForm } from "@inertiajs/react";
import Modal from "@/Components/Modal";
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

export function CreateModal({
    show,
    handleClose,
}: {
    show: boolean;
    handleClose: () => void;
}) {
    const { data, setData, post, errors, processing, reset } = useForm({
        title: "",
        description: "",
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("timetables"), {
            onFinish: () => {
                toast({
                    title: "Time Table Created",
                    description: "Time Table has been created successfully!",
                });
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
        </Modal>
    );
}
