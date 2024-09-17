import { ColumnDef } from "@tanstack/react-table";
import { Verified, BadgeInfo, EllipsisVertical } from "lucide-react";
import Tooltip from "@/components/ui/tooltip";
import { UserType } from "@/types";
import { UserActions } from "./actions";

const columns: ColumnDef<UserType>[] = [
    {
        accessorKey: "id",
        header: "#",
    },
    {
        accessorKey: "name",
        header: "Name",
    },
    {
        accessorKey: "email",
        header: "Email",
    },
    {
        accessorKey: "email_verified_at",
        header: "Email Verified",
        cell: ({ row }) => {
            const isVerified = row.original.email_verified_at;

            return (
                <Tooltip
                    title={
                        "Email " + (isVerified ? "Verified!" : "Not-Verifed!")
                    }
                >
                    {isVerified ? (
                        <Verified color="green" />
                    ) : (
                        <BadgeInfo color="red" />
                    )}
                </Tooltip>
            );
        },
    },
    {
        accessorKey: "createdAt",
        header: "Registration Date",
    },
    {
        accessorKey: "",
        header: "Actions",
        cell: ({ row }) => {
            return (
                <div className="flex items-center justify-center">
                    <UserActions row={row.original}/>
                </div>
            );
        },
    },
];

export default columns;
