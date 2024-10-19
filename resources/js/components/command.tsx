import * as React from "react";
import {
    Settings,
    GraduationCap,
    User,
    ChartNoAxesCombined,
    Users,
    CalendarDays,
    Building,
    LayoutDashboardIcon,
} from "lucide-react";

import {
    CommandDialog,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
    CommandSeparator,
    CommandShortcut,
} from "@/components/ui/command";
import { router } from "@inertiajs/react";
import { Button } from "@/components/ui/button";

export function CommandDialogDemo() {
    const [open, setOpen] = React.useState(false);
    const superKey = "CTRL+";

    React.useEffect(() => {
        const down = (e: KeyboardEvent) => {
            if (e.metaKey || e.ctrlKey) {
                if (e.key === "k") {
                    e.preventDefault();
                    setOpen((open) => !open);
                }

                if (e.key === "p") {
                    handleProfileNavigation(e);
                }
            }
        };

        document.addEventListener("keydown", down);
        return () => document.removeEventListener("keydown", down);
    }, []);

    const handleProfileNavigation = (e: KeyboardEvent | any) => {
        if (e instanceof KeyboardEvent) {
            e.preventDefault();
        }
        router.get("/profile");

        if (open === true) {
            setOpen(false);
        }
    };

    const handlePageSelect = (url: string) => {
        router.get(url);

        if (open === true) {
            setOpen(false);
        }
    };

    return (
        <>
            <Button onClick={() => setOpen(!open)} variant="outline" size="sm">
                <p className="text-sm text-muted-foreground">
                    Press{" "}
                    <kbd className="pointer-events-none inline-flex h-5 bg-muted border rounded-sm select-none items-center px-1.5 font-mono text-[10px] font-medium opacity-100">
                        <span className="text-xs">{superKey}</span>k
                    </kbd>
                </p>
            </Button>
            <CommandDialog open={open} onOpenChange={setOpen}>
                <CommandInput
                    className="border-transparent focus:border-transparent focus:ring-transparent"
                    placeholder="Type a command or search..."
                />
                <CommandList>
                    <CommandEmpty>No results found.</CommandEmpty>
                    <CommandGroup heading="Pages">
                        <CommandItem
                            onSelect={() => handlePageSelect("/dashboard")}
                        >
                            <LayoutDashboardIcon className="mr-2 h-4 w-4" />
                            <span>Dashboar</span>
                        </CommandItem>
                        <CommandItem
                            onSelect={() => handlePageSelect("/users")}
                        >
                            <Users className="mr-2 h-4 w-4" />
                            <span>Users</span>
                        </CommandItem>
                        <CommandItem
                            onSelect={() => handlePageSelect("/students")}
                        >
                            <GraduationCap className="mr-2 h-4 w-4" />
                            <span>Students</span>
                        </CommandItem>
                        <CommandItem
                            onSelect={() => handlePageSelect("/teachers")}
                        >
                            <User className="mr-2 h-4 w-4" />
                            <span>Teachers</span>
                        </CommandItem>
                        <CommandItem
                            onSelect={() => handlePageSelect("/timetables")}
                        >
                            <CalendarDays className="mr-2 h-4 w-4" />
                            <span>Time Tables</span>
                        </CommandItem>
                        <CommandItem
                            onSelect={() => handlePageSelect("/rooms")}
                        >
                            <Building className="mr-2 h-4 w-4" />
                            <span>Rooms</span>
                        </CommandItem>
                    </CommandGroup>
                    <CommandSeparator />
                    <CommandGroup heading="General">
                        <CommandItem onSelect={handleProfileNavigation}>
                            <User className="mr-2 h-4 w-4" />
                            <span>Profile</span>
                            <CommandShortcut>{superKey}P</CommandShortcut>
                        </CommandItem>
                        <CommandItem>
                            <Settings className="mr-2 h-4 w-4" />
                            <span>Settings</span>
                            <CommandShortcut>{superKey}S</CommandShortcut>
                        </CommandItem>
                    </CommandGroup>
                </CommandList>
            </CommandDialog>
        </>
    );
}
