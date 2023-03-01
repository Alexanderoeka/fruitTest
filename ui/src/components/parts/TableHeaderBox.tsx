import React from "react";
import {ColumnI} from "../Table";
import g from './general.module.css';


interface filter {

}

interface propsI {
    value?: ColumnI,
    onFilter?: () => void,
    filter?: 'asc' | 'desc'
}


export default function TableHeaderBox(props: propsI) {
    return (
        <div className={g.tableHeaderBox} onClick={props.onFilter}>

        </div>
    )
}