import { DashboardNav } from "@/Components/layout/dashboardNav";
import { Sheet, SheetContent, SheetTrigger, SheetTitle } from "@/components/ui/sheet";
import { navItems } from "@/Layouts/nav/layoutLinks";
import { MenuIcon } from "lucide-react";
import { useState } from "react";

interface SidebarProps extends React.HTMLAttributes<HTMLDivElement> {
    // playlists: Playlist[];
}

export function MobileSidebar({ className }: SidebarProps) {
    const [open, setOpen] = useState(false);
    return (
        <>
            <Sheet open={open} onOpenChange={setOpen}>
                <SheetTrigger asChild className="focus:outline-none">
                    <MenuIcon />
                </SheetTrigger>
                <SheetContent side="left" className="!px-0">
                    <SheetTitle className="hidden">Menu</SheetTitle>
                    <div className="space-y-4 py-4">
                        <div className="px-3 py-2">
                            <h2 className="mb-2 px-4 text-lg font-semibold tracking-tight">
                                Overview
                            </h2>
                            <div className="space-y-1">
                                <DashboardNav
                                    items={navItems}
                                    isMobilePhone={true}
                                    setOpen={setOpen}
                                />
                            </div>
                        </div>
                    </div>
                </SheetContent>
            </Sheet>
        </>
    );
}
