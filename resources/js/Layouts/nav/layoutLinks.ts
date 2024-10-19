// Import All icons from lucide-react
import {
    type LucideIcon,
    HomeIcon, 
    UsersIcon,
    UserIcon,
    CalendarIcon,
    Building,
    CalendarDays,
    LayoutDashboardIcon
} from 'lucide-react'


export type Icon = LucideIcon;

export type NavItem = {
    title: string;
    icon?: Icon;
    href?: string;
    pathName: string;
    disabled?: boolean;
    children?: NavItem[];
};

export const navItems : NavItem[] = [
    {
        title: 'Dashboard',
        href: route('dashboard'),
        pathName: 'dashboard',
        icon:  LayoutDashboardIcon
    },
    {
        title: 'Users',
        href: route('users'),
        pathName: 'users',
        icon: UsersIcon
    },
    {
        title: 'Teachers',
        href: route('teachers'),
        pathName: 'teachers',
        icon: UserIcon
    },
    {
        title: 'Time Tables',
        href: route('timetables.index'),
        pathName: 'timetables.index',
        icon: CalendarDays
    },
    {
        title: 'Rooms',
        href: route('rooms.index'),
        pathName: 'rooms.index',
        icon: Building
    }
]; 