import { PropsWithChildren, ReactNode, useEffect } from "react";
import { PageProps, User } from "@/types";
import Sidebar from "@/Components/layout/sideBar";
import { ScrollArea } from "@/components/ui/scroll-area";
import { SidebarProvider } from "@/Components/layout/SidebarContext";
import Header from "@/Components/layout/Header";
import { usePage } from "@inertiajs/react";
import { toast } from "@/hooks/use-toast";

export default function Authenticated({
    user,
    header,
    children,
}: PropsWithChildren<{ user: User; header?: ReactNode }>) {
    const { flash } = usePage<PageProps>().props;

    useEffect(() => {
        if (flash?.error || flash?.success) {
            toast({
                variant: flash.error ? 'destructiveOutline' : 'successOutline',
                description: flash.error || flash.success,
            });
        }
    }, [flash]);

    return (
        <SidebarProvider>
            <div className="flex bg-white dark:bg-background">
                <Sidebar />
                <main className="w-full flex-1 overflow-hidden">
                    <Header user={user} />
                    <ScrollArea className="h-[calc(100dvh-75px)]">
                        {children}
                    </ScrollArea>
                </main>
            </div>
        </SidebarProvider>
    );
}
