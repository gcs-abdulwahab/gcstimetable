import ApplicationLogo from "@/Components/ApplicationLogo";
import { ModeToggle } from "@/components/mode-toggle";
import { Link } from "@inertiajs/react";
import { PropsWithChildren } from "react";

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="relative min-h-screen flex flex-col lg:flex-row items-center bg-background">
            {/* Mode Toggle - Positioned at top right corner */}
            <div className="absolute top-3 right-3">
                <ModeToggle
                    variant={"outline"}
                    size={"lg"}
                    className="w-10 h-10"
                />
            </div>

            {/* Left side image - Hidden on small screens, takes half screen on large devices */}
            <div className="hidden lg:block lg:w-1/2 h-screen p-1">
                <img
                    src="https://picsum.photos/1600/900/?calender,time"
                    alt="Random Picture"
                    className="object-cover w-full h-full rounded-xl overflow-hidden"
                />
            </div>

            {/* Content area - Takes full width on small screens, half on large screens */}
            <div className="w-full lg:w-1/2 flex flex-col items-center justify-center min-h-screen">
                <Link href="/">
                    <ApplicationLogo className="h-16 w-auto" iconSize={10} />
                </Link>
                <div className="w-full sm:max-w-xl mt-6 px-6 py-4 border border-border bg-card text-card-foreground shadow-md overflow-hidden sm:rounded-lg">
                    {children}
                </div>
            </div>
        </div>
    );
}
