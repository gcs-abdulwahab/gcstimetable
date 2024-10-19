import React, { createContext, useContext, useState, useEffect } from 'react';

interface SidebarContextProps {
    isMinimized: boolean;
    toggle: () => void;
}

const SidebarContext = createContext<SidebarContextProps | undefined>(undefined);

const getInitialState = (): boolean => {
    const savedState = localStorage.getItem('isMinimized');
    return savedState ? JSON.parse(savedState) : false;
};

export const SidebarProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
    const [isMinimized, setIsMinimized] = useState<boolean>(getInitialState());

    useEffect(() => {
        localStorage.setItem('isMinimized', JSON.stringify(isMinimized));
    }, [isMinimized]);

    const toggle = () => {
        setIsMinimized((prev) => !prev);
    };

    return (
        <SidebarContext.Provider value={{ isMinimized, toggle }}>
            {children}
        </SidebarContext.Provider>
    );
};

export const useSidebar = (): SidebarContextProps => {
    const context = useContext(SidebarContext);
    if (!context) {
        throw new Error('useSidebar must be used within a SidebarProvider');
    }
    return context;
};
