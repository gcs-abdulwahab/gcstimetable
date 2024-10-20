import React, { useEffect } from "react";
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { Link } from "@inertiajs/react";
import {
    PageBreadcrumsProps,
    useBreadcrumb,
} from "@/components/providers/breadcrum-provider";

const Items = [
    {
        title: "Dashboard",
        isActive: route().current("dashboard"),
    },
    {
        title: "Users",
        isActive: route().current("users.index"),
    },
    {
        title: "Teachers",
        isActive: route().current("teachers.index"),
        backItems: [
            {
                title: "Users",
                url: route("users.index"),
            },
        ],
    },
    {
        title: "Students",
        isActive: route().current("students.index"),
        backItems: [
            {
                title: "Users",
                url: route("users.index"),
            },
        ],
    },
    {
        title: "Time Tables",
        isActive: route().current("timetables.index"),
    },
    {
        title: "Rooms",
        isActive: route().current("rooms.index"),
    },
    {
        title: "Profile",
        isActive: route().current("profile.edit"),
        backItems: [
            {
                title: "Dashboard",
                url: route("dashboard"),
            },
        ],
    },
];

export function PageBreadcrums() {
    const { breadcrumb } = useBreadcrumb();

    return (
        <Breadcrumb>
            <BreadcrumbList>
                {breadcrumb && (
                    <React.Fragment>
                        {breadcrumb.backItems &&
                            breadcrumb.backItems.length > 0 &&
                            breadcrumb.backItems.map(
                                (
                                    backItem: { title: string; url: string },
                                    index: number
                                ) => (
                                    <React.Fragment key={index}>
                                        <BreadcrumbItem className="hidden md:block">
                                            <BreadcrumbLink href={"#"} asChild>
                                                <Link href={backItem.url}>
                                                    {backItem.title}
                                                </Link>
                                            </BreadcrumbLink>
                                        </BreadcrumbItem>
                                        <BreadcrumbSeparator className="hidden md:block" />
                                    </React.Fragment>
                                )
                            )}
                        <BreadcrumbItem>
                            <BreadcrumbLink href="#">
                                {breadcrumb.title}
                            </BreadcrumbLink>
                        </BreadcrumbItem>
                    </React.Fragment>
                )}
            </BreadcrumbList>
        </Breadcrumb>
    );
}
