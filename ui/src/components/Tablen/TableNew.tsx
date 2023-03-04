import React, {useEffect, useState} from "react";
import TableHeaderN from "./TableHeaderN";
import {fruitType, SearchI} from "../../pages/FruitsPage";
import TableRowN from "./TableRowN";
import g from '../parts/general.module.css';
import ts from "../styles/tableStyle.module.css";
import TablePaginate from "../parts/TablePaginate";
import {pr} from "../../common/utils";
import {requestResult} from "../../common/api";

export interface ColumnI {
    id: string,
    text: string,
    type?: 'change',
    onClick?: (field: string, rowId: number) => (e: any) => void
}

export interface SearchTableI extends Omit<SearchI, 'search'> {
    tableData: any[]
}

export interface SearchTParamsI {
    perPage: 10 | 30 | 50,
    page: number,
    order: 'asc' | 'desc',
    orderBy: string | null,
}

export interface propsI {
    getTableData: (params: SearchTParamsI) => Promise<requestResult>,
    columnsTypes: ColumnI[],
    refresh?: boolean,
    search?: string | null,
    onRowChange: (field: string, rowId: number) => (e: any) => void
}


export default function TableNew(props: propsI) {
    const {getTableData, columnsTypes, refresh} = props

    const [state, setState] = useState<SearchTableI>({
        page: 1,
        pages: 1,
        perPage: 10,
        order: 'asc',
        orderBy: null,
        tableData: []
    })

    useEffect(()=>{
        getDataTable();
    },[refresh])


    const getDataTable = () => {
        const {perPage, page, pages, orderBy, order} = state

        let params = {
            perPage,
            page,
            pages,
            order,
            orderBy
        }

        getTableData(params).then(response => {
                pr(response);
                setState(prev=>({
                    ...prev,
                    tableData:response.data
                }))
            }
        );

    }

    const handleChange = (field: string, value: any) => {
        pr("field")
        pr(field)
        pr(value)
        setState(prev => ({
            ...prev,
            [field]: value
        }));
    }

    useEffect(() => {
        // getTableData()
    }, [refresh, state.order, state.orderBy])


    // const handleChangeRow = (rowId: number) => (colId: string, newValue: any) => {
    //
    //     getTableData();
    // }

    const orderByColumn = (orderBy: string) => () => {

        setState(prev => ({
                ...prev,
                orderBy: orderBy,
                order: prev.order === 'asc' ? 'desc' : 'asc'
            })
        )
    }

    const {page, perPage, pages, orderBy, order, tableData} = state

    return (
        <div className={ts.box}>

            <table className={g.tableBeauty}>
                <thead>
                <TableHeaderN columnsTypes={columnsTypes} orderByColumn={orderByColumn} order={state.order}
                              orderBy={state.orderBy}/>
                </thead>
                <tbody>
                {tableData.map((row: any, idx) => {
                    return <TableRowN onChange={props.onRowChange} id={idx} values={row} columnTypes={columnsTypes}/>
                })}
                </tbody>
            </table>
            <TablePaginate onChange={handleChange} page={page} pages={pages} perPage={perPage}/>
        </div>
    )
}