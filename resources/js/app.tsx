import "./bootstrap";
import "../css/app.css";

import { createRoot, hydrateRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import AppTheme from "./app-theme";
import { BreadcrumbProvider } from "@/components/providers/breadcrum-provider";
import { Toaster } from "@/components/ui/toaster";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob("./Pages/**/*.tsx")
        ),
    setup({ el, App, props }) {

        const AppContainer = () => (
            <AppTheme>
                <BreadcrumbProvider>
                    <App {...props} />
                    <Toaster />
                </BreadcrumbProvider>
            </AppTheme>
        );
        
        if (import.meta.env.DEV) {
            createRoot(el).render(
                <AppContainer />
            );
            return;
        }

        hydrateRoot(
            el,
            <AppContainer />
        );
    },
    progress: {
        color: "#4B5563",
    },
});
