import * as React from "react"
import {
  type LucideIcon,
  BookOpen,
  Bot,
  Command,
  Frame,
  LifeBuoy,
  Map,
  PieChart,
  Send,
  Settings2,
  SquareTerminal,
  HomeIcon, 
  UsersIcon,
  UserIcon,
  CalendarIcon,
  Building,
  CalendarDays,
  LayoutDashboardIcon,
  GraduationCap
} from "lucide-react"

import { NavMain } from "@/components/nav-main"
import { NavProjects } from "@/components/nav-projects"
import { NavSecondary } from "@/components/nav-secondary"
import { NavUser } from "@/components/nav-user"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from "@/components/ui/sidebar"
import { User } from "@/types"
import ApplicationLogo from "@/Components/ApplicationLogo"

export type Icon = LucideIcon;

export type NavItem = {
  title: string;
  url: string;
  icon: Icon;
  isActive: boolean;
  disabled?: boolean;
  items?: NavItem[];
};

type NavDataType = {
  navMain: NavItem[];
  navSecondary: any;
  projects: any;
}

export const NavData : NavDataType = {
  navMain: [
    {
      title: "Dashboard",
      url: route('dashboard'),
      icon: LayoutDashboardIcon,
      isActive: route().current('dashboard'),
    },
    {
      title: "Users",
      url: route('users.index'),
      icon: UsersIcon,
      isActive: false,
      items : [
        {
          title: "Teachers",
          url: route('teachers.index'),
          icon: UserIcon,
          isActive: route().current('teachers.index')
        },
        {
          title: "Students",
          url: route('students.index'),
          icon: GraduationCap,
          isActive: route().current('students.index')
        },
      ]
    },
    {
        title: 'Time Tables',
        url: route('timetables.index'),
        isActive: route().current('timetables.index'),
        icon: CalendarDays
    },
    {
      title: 'Rooms',
      url: route('rooms.index'),
      isActive: route().current('rooms.index'),
      icon: Building
    }
  ],
  navSecondary: [
    {
      title: "Support",
      url: "#",
      icon: LifeBuoy,
    },
    {
      title: "Feedback",
      url: "#",
      icon: Send,
    },
  ],
  projects: [
    {
      name: "Design Engineering",
      url: "#",
      icon: Frame,
    },
    {
      name: "Sales & Marketing",
      url: "#",
      icon: PieChart,
    },
    {
      name: "Travel",
      url: "#",
      icon: Map,
    },
  ],
}

interface AppSidebarProps extends React.ComponentProps<typeof Sidebar> {
  user: User
}

export function AppSidebar({ user, ...props }: AppSidebarProps) {
  console.log("AppSidebar -> NavData.navMain", NavData.navMain);
  return (
    <Sidebar variant='inset' collapsible="icon" {...props}>
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton size="lg" asChild>
              <a href="#">
                <ApplicationLogo />
                <div className="grid flex-1 text-left text-sm leading-tight">
                  <span className="truncate font-semibold">Time Table</span>
                  <span className="truncate text-xs">Enterprise</span>
                </div>
              </a>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <NavMain items={NavData.navMain} />
        {/* <NavProjects projects={NavData.projects} /> */}
        <NavSecondary items={NavData.navSecondary} className="mt-auto" />
      </SidebarContent>
      <SidebarFooter>
        <NavUser user={user} />
      </SidebarFooter>
    </Sidebar>
  )
}
