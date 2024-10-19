import { PropsWithChildren, ReactNode } from "react";
import { User } from "@/types";
import { ModeToggle } from "@/components/mode-toggle";
import { CommandDialogDemo } from "@/components/command";
import { User as UserIcon, LogOut } from "lucide-react";
import { cn } from "@/lib/utils";

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuLink,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarImage, AvatarFallback } from "@radix-ui/react-avatar";
import { MobileSidebar } from "@/Components/layout/mobileSidebar";

export default function Header({
    user,
}: PropsWithChildren<{ user: User }>) {
    return (
        <header className="sticky inset-x-0 top-0 w-full bg-transparent backdrop-blur-sm">
            <nav className="flex items-center justify-between px-4 py-2 md:justify-end">
                <div className={cn("block md:!hidden")}>
                    <MobileSidebar />
                </div>
                <div className="flex items-center ms-6">
                    <div>
                        <CommandDialogDemo />
                    </div>
                    <div className="ms-3">
                        <ModeToggle />
                    </div>
                    <div className="ms-3 relative">
                        <DropdownMenu>
                            <DropdownMenuTrigger className="outline-none focus:outline-none">
                                <div className="inline-flex rounded-md">
                                    <div className="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                                        <Avatar>
                                            <AvatarImage
                                                src={user.profilePhotoUrl}
                                                alt={user.name}
                                                className={
                                                    "h-10 w-10 rounded-full"
                                                }
                                            />
                                            <AvatarFallback className="dark:bg-gray-600">
                                                <UserIcon />
                                            </AvatarFallback>
                                        </Avatar>
                                    </div>
                                </div>
                            </DropdownMenuTrigger>

                            <DropdownMenuContent className="w-52">
                                <DropdownMenuLink href={route("profile.edit")}>
                                    <UserIcon className="mr-2 h-4 w-4" />
                                    Profile
                                    <DropdownMenuShortcut>
                                        ⌘P
                                    </DropdownMenuShortcut>
                                </DropdownMenuLink>
                                <DropdownMenuLink
                                    href={route("logout")}
                                    method="post"
                                    as="button"
                                >
                                    <LogOut className="mr-2 h-4 w-4" />
                                    Log Out
                                </DropdownMenuLink>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>
            </nav>
        </header>
    );
}
