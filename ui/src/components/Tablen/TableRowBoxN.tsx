import React from "react";
import {ColumnI} from "./TableNew";

export type Column = string | number | null | boolean

interface PropsI {
    value?: Column,
    columnTypes: ColumnI,
    onChange: ((e: any) => void) | Function
}

export default function TableRowBoxN(props: PropsI) {

    const {value, onChange, columnTypes} = props

    let finalValue = typeof value === "boolean" ? value.toString() : value;
    let td = <td>{finalValue}</td>


    const changeValue = (bol: boolean) => () => {
        bol = !bol;
        onChange( bol);
    }

    if (props.columnTypes?.type === "change" && typeof value === "boolean") {
        td = <td onClick={changeValue(value)}>{finalValue}</td>
    }

    return (
        <td>
            {td}

        </td>
    )
}