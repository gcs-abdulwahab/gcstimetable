import { useState } from "react";
import { EllipsisVertical, Eye, Trash, User as UserIcon } from "lucide-react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuPortal,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuSub,
    DropdownMenuSubContent,
    DropdownMenuSubTrigger,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Fragment } from "react/jsx-runtime";
import Modal from "@/Components/Modal";
import {
    Card,
    CardHeader,
    CardTitle,
    CardDescription,
    CardContent,
    CardFooter,
} from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";

import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Link, router, useForm } from "@inertiajs/react";
import { UserType, Role } from "@/types";
import { toast } from "@/hooks/use-toast";
import SecondaryButton from "@/Components/SecondaryButton";
import PrimaryButton from "@/Components/PrimaryButton";
import { cn } from "@/lib/utils";
import { Room } from "@/types/database";

export function Actions({ row }: { row: Room }) {

    const handleDelete = (row: Room) => {
        router.delete(route("rooms.destroy", row.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast({
                    title: "Success!",
                    description: "Room deleted successfully.",
                });
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

    function handleView(row: Room) {
        router.get(route("rooms.show", row.id));
    }

    return (
        <Fragment>
            <DropdownMenu>
                <DropdownMenuTrigger asChild className="cursor-pointer">
                    <EllipsisVertical />
                </DropdownMenuTrigger>
                <DropdownMenuContent className="w-56">
                    <DropdownMenuLabel>Operations</DropdownMenuLabel>
                    <DropdownMenuSeparator />
                    <DropdownMenuGroup>
                        <DropdownMenuItem
                            className="cursor-pointer"
                            onClick={() => handleView(row)}
                        >
                            <Eye className="mr-2 h-4 w-4" />
                            <span>View</span>
                        </DropdownMenuItem>
                        <DropdownMenuItem
                            className="cursor-pointer"
                            onClick={() => handleDelete(row)}
                        >
                            <Trash className="mr-2 h-4 w-4" />
                            <span>Delete</span>
                        </DropdownMenuItem>
                    </DropdownMenuGroup>
                </DropdownMenuContent>
            </DropdownMenu>
        </Fragment>
    );
}