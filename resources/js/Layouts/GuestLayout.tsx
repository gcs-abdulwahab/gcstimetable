import ApplicationLogo from "@/Components/ApplicationLogo";
import { ModeToggle } from "@/components/mode-toggle";
import { Link } from "@inertiajs/react";
import { PropsWithChildren } from "react";

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background">
            {/* Toggle move */}
            <div className="absolute top-3 right-3">
                <ModeToggle
                    variant={"outline"}
                    size={"lg"}
                    className="w-10 h-10"
                />
            </div>
            <div>
                <Link href="/">
                    <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 border border-border bg-card text-card-foreground shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
