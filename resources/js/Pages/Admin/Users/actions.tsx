import {
    Cloud,
    CreditCard,
    EllipsisVertical,
    Github,
    Keyboard,
    LifeBuoy,
    LogOut,
    Mail,
    MessageSquare,
    Plus,
    PlusCircle,
    Settings,
    Trash,
    User as UserIcon,
    UserPlus,
    Users,
    View,
} from "lucide-react";
import { User as UserInterface } from "@/types";

import { Button } from "@/components/ui/button";
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

export function UserActions({ row }: { row: UserInterface }) {

    const handleDelete = (row : UserInterface) => {
        confirm("Are you sure you want to delete this user?");

        console.log("Delete user", row);
    };

    const handleView = (row : UserInterface) => {
        console.table(row);
    }


    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <EllipsisVertical />
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-56">
                <DropdownMenuLabel>Operations</DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuGroup>
                    <DropdownMenuItem onClick={() => handleView(row)}>
                        <View className="mr-2 h-4 w-4" />
                        <span>View</span>
                    </DropdownMenuItem>
                    <DropdownMenuItem onClick={() => handleDelete(row)}>
                        <Trash className="mr-2 h-4 w-4" />
                        <span>Delete</span>
                    </DropdownMenuItem>
                </DropdownMenuGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
