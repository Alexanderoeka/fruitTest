import React from "react";
import ts from './styles/tableStyle.module.css';
import TableHeader from "./parts/TableHeader";
import TablePaginate from "./parts/TablePaginate";
import TableRow from "./parts/TableRow";

export interface ColumnI {
    id: string,
    text: string
}


interface propsI {
    getTableData?: () => () => void,
    columns?: ColumnI[],
    refresh?: boolean
}


export default function Table(props: propsI) {
    const {getTableData, columns, refresh} = props


    return (
        <div className={ts.box}>
            <TableHeader/>
            <TableRow/>
            <TablePaginate/>
        </div>
    )
}
