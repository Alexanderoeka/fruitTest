import React from "react";
import {ColumnI} from "./TableNew";
import g from '../parts/general.module.css';

export type Column = string | number | boolean | null

interface PropsI {
    value?: Column,
    columnTypes: ColumnI,
    onChange: ((e: any) => void) | Function
}

export default function TableRowBoxN(props: PropsI) {

    const {value, onChange, columnTypes} = props

    // let finalValue = typeof value === "boolean" ? value.toString() : value;
    let td = <td>{value}</td>


    const changeValue = (bol: boolean) => () => {
        bol = !bol;
        onChange(bol);
    }

    if (props.columnTypes?.type === "change" && typeof value === "boolean") {
        td = <td onClick={changeValue(value)}><input className={g.checkbox} type="checkbox" checked={value}/></td>
    }

    return (
        <>
            {td}
        </>
    )
}