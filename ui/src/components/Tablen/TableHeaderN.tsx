import React from "react";
import TableHeaderBoxN from "./TableHeaderBoxN";
import {ColumnI} from "./TableNew";

interface PropsI {
    columnsTypes: ColumnI[],
    orderByColumn: (orderBy: string) => () => void,
    order: 'asc' | 'desc',
    orderBy: string | null
}

export default function TableHeaderN(props: PropsI) {
    return (
        <tr>
            {props.columnsTypes.map((column: ColumnI) => {
                return <TableHeaderBoxN order={props.order} orderBy={props.orderBy} value={column} orderByColumn={props.orderByColumn}/>
            })}
        </tr>
    )
}