import { useState, PropsWithChildren, ReactNode } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link } from "@inertiajs/react";
import { User } from "@/types";
import { ModeToggle } from "@/components/mode-toggle";
import { CommandDialogDemo } from "@/components/command";
import { User as UserIcon, LogOut } from "lucide-react";
import { NavLinks } from "@/Layouts/nav/layoutLinks";
import { cn } from "@/lib/utils";

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuLink,
    DropdownMenuPortal,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuSub,
    DropdownMenuSubContent,
    DropdownMenuSubTrigger,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarImage, AvatarFallback } from "@radix-ui/react-avatar";

export default function Authenticated({
    user,
    header,
    children,
}: PropsWithChildren<{ user: User; header?: ReactNode }>) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav className="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex">
                            <div className="shrink-0 flex items-center">
                                <Link href="/">
                                    <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </Link>
                            </div>

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                {NavLinks.map((link) => {
                                    return (
                                        <NavLink
                                            key={link.name}
                                            href={link.route}
                                            active={route().current(
                                                link.routeName
                                            )}
                                        >
                                            {link.name}
                                        </NavLink>
                                    );
                                })}
                            </div>
                        </div>

                        <div className="hidden sm:flex sm:items-center sm:ms-6">
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
                                            <div className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                <Avatar>
                                                    <AvatarImage
                                                        src={
                                                            user.profilePhotoUrl
                                                        }
                                                        alt={user.name}
                                                        className={
                                                            "h-10 w-10 rounded-full"
                                                        }
                                                    />
                                                    <AvatarFallback className="dark:bg-gray-600">
                                                        <UserIcon />
                                                    </AvatarFallback>
                                                </Avatar>

                                                <svg
                                                    className="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </DropdownMenuTrigger>

                                    <DropdownMenuContent className="w-52">
                                        <DropdownMenuLink
                                            href={route("profile.edit")}
                                        >
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

                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() =>
                                    setShowingNavigationDropdown(
                                        (previousState) => !previousState
                                    )
                                }
                                className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg
                                    className="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        className={
                                            !showingNavigationDropdown
                                                ? "inline-flex"
                                                : "hidden"
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={
                                            showingNavigationDropdown
                                                ? "inline-flex"
                                                : "hidden"
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    className={
                        (showingNavigationDropdown ? "block" : "hidden") +
                        " sm:hidden"
                    }
                >
                    <div className="pt-2 pb-3 space-y-1">
                        {NavLinks.map((link) => (
                            <ResponsiveNavLink
                                key={link.name}
                                href={link.route}
                                active={route().current(link.routeName)}
                            >
                                {link.name}
                            </ResponsiveNavLink>
                        ))}
                    </div>

                    <div className="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div className="px-4">
                            <div className="font-medium text-base text-gray-800 dark:text-gray-200">
                                {user.name}
                            </div>
                            <div className="font-medium text-sm text-gray-500">
                                {user.email}
                            </div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink href={route("profile.edit")}>
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                method="post"
                                href={route("logout")}
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            {header && (
                <header className="bg-white dark:bg-gray-800 shadow">
                    <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            <main>{children}</main>
        </div>
    );
}
