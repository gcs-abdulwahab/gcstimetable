import "./bootstrap";
import "../css/app.css";

import { createRoot, hydrateRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import AppTheme from "./app-theme";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob("./Pages/**/*.tsx")
        ),
    setup({ el, App, props }) {
        
        if (import.meta.env.DEV) {
            createRoot(el).render(
                <AppTheme>
                    <App {...props} />
                </AppTheme>
            );
            return;
        }

        hydrateRoot(
            el,
            <AppTheme>
                <App {...props} />
            </AppTheme>
        );
    },
    progress: {
        color: "#4B5563",
    },
});
