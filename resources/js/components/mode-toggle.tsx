import { Moon, Sun } from "lucide-react"

import { Button } from "@/components/ui/button"
import Dropdown from "@/Components/Dropdown";
import { useTheme } from "@/components/theme-provider"

export function ModeToggle() {
  const { setTheme } = useTheme()

  return (
    <Dropdown>
      <Dropdown.Trigger>
        <Button variant="outline" className="dark:hover:bg-gray-900 dark:focus:ring-gray-700 dark:border-gray-700" size="icon">
          <Sun className="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
          <Moon className="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
          <span className="sr-only">Toggle theme</span>
        </Button>
      </Dropdown.Trigger>
      <Dropdown.Content>
        <Dropdown.Item onClick={() => setTheme("light")}>
          Light
        </Dropdown.Item>
        <Dropdown.Item onClick={() => setTheme("dark")}>
          Dark
        </Dropdown.Item>
        <Dropdown.Item onClick={() => setTheme("system")}>
          System
        </Dropdown.Item>
      </Dropdown.Content>
    </Dropdown>
  )
}
