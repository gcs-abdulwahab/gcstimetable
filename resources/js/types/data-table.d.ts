import { ColumnDef } from "@tanstack/react-table";

interface WithSearchFilter {
    pagination?: boolean;
    searchFilter: true,
    filterColumn: string
}

interface WithoutSearchFilter {
    pagination?: boolean,
    searchFilter: false
}

type InputProps =  WithoutSearchFilter | WithSearchFilter;

export interface DataTableProps<TData, TValue> {
    columns: ColumnDef<TData, TValue>[];
    data: TData[];
    inputProps?: InputProps;
}
