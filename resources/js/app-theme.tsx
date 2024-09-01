import { ThemeProvider } from "@/components/theme-provider";
import React from "react";

function AppTheme({ children }: React.PropsWithChildren<{}>) {
    return (
        <ThemeProvider defaultTheme="dark" storageKey="theme">
            {children}
        </ThemeProvider>
    );
}

export default AppTheme;
