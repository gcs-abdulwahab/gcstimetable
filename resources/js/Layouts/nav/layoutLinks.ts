interface NavLink {
    name: string;
    route: string;
    routeName: string;
}

export const NavLinks : NavLink[] = [
    {
        name: 'Dashboard',
        route: route('dashboard'),
        routeName: 'dashboard'
    },
    {
        name: 'Users',
        route: route('users'),
        routeName: 'users'
    },
    {
        name: 'Teachers',
        route: route('teachers'),
        routeName: 'teachers'
    },
    {
        name: 'Time Tables',
        route: route('timetables.index'),
        routeName: 'timetables.index'
    },
    {
        name: 'Rooms',
        route: route('rooms.index'),
        routeName: 'rooms.index'
    }
]; 