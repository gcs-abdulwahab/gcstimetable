import { Monitor, Moon, Sun } from "lucide-react";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { useTheme } from "@/components/theme-provider";

import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

export function ModeToggle() {
    const { theme, setTheme } = useTheme();

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button
                    variant="outline"
                    size="icon"
                    className="relative flex items-center justify-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    <Sun
                        className={cn(
                            "absolute h-[1.2rem] w-[1.2rem] transition-transform duration-500",
                            theme === "light"
                                ? "rotate-0 scale-100 opacity-100"
                                : "rotate-90 scale-0 opacity-0"
                        )}
                    />

                    <Moon
                        className={cn(
                            "absolute h-[1.2rem] w-[1.2rem] transition-transform duration-500",
                            theme === "dark"
                                ? "rotate-0 scale-100 opacity-100"
                                : "-rotate-90 scale-0 opacity-0"
                        )}
                    />

                    <Monitor
                        className={cn(
                            "absolute h-[1.2rem] w-[1.2rem] transition-transform duration-500",
                            theme === "system"
                                ? "rotate-0 scale-100 opacity-100"
                                : "rotate-90 scale-0 opacity-0"
                        )}
                    />
                    <span className="sr-only">Toggle theme</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-52">
                <DropdownMenuCheckboxItem
                    checked={theme === "light"}
                    onCheckedChange={(checked) => {
                        if (checked) setTheme("light");
                    }}
                >
                    Light
                </DropdownMenuCheckboxItem>
                <DropdownMenuCheckboxItem
                    checked={theme === "dark"}
                    onCheckedChange={(checked) => {
                        if (checked) setTheme("dark");
                    }}
                >
                    Dark
                </DropdownMenuCheckboxItem>
                <DropdownMenuCheckboxItem
                    checked={theme === "system"}
                    onCheckedChange={(checked) => {
                        if (checked) setTheme("system");
                    }}
                >
                    System
                </DropdownMenuCheckboxItem>
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
