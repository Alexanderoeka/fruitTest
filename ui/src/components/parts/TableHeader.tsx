import React from "react";
import g from './general.module.css';
import TableHeaderBox from "./TableHeaderBox";

export default function TableHeader() {
    return (
        <div className={g.tableHeader}>
            <TableHeaderBox filter='asc'/>
        </div>
    )
}