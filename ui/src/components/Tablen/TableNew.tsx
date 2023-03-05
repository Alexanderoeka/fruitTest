import React, {useEffect, useState} from "react";
import TableHeaderN from "./TableHeaderN";
import {FruitI, fruitType, SearchI} from "../../pages/FruitsPage";
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
    tableData: any[],
    refreshLocal: boolean,
    rows: number
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
    searchButton: boolean,
    search?: string | null,
    onRowChange: (fruit: FruitI) => Promise<requestResult>
}


export default function TableNew(props: propsI) {
    const {getTableData, columnsTypes, refresh, searchButton, onRowChange} = props

    const [state, setState] = useState<SearchTableI>({
        page: 1,
        pages: 1,
        perPage: 10,
        order: 'asc',
        orderBy: null,
        rows: 0,
        tableData: [],
        refreshLocal: false
    })

    useEffect(() => {
        getDataTable();
    }, [refresh, state.refreshLocal])

    useEffect(() => {
        handleChange('page', 1, false)
        refreshAction();
    }, [searchButton])


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
                setState(prev => ({
                    ...prev,
                    tableData: response.data,
                    ...response.pagination

                }))
            }
        );

    }

    const handleRowChange = (field: string, rowId: number) => (e: any) => {

        pr('CHANGE ROW')
        let value = e.target?.value ?? e;

        let changedRow = {...state.tableData[rowId]}
        changedRow[field] = value

        onRowChange(changedRow).then(response => {
            if (response.success) {
                setState(prev => {

                    let newTableData = [...prev.tableData]
                    newTableData[rowId] = changedRow;
                    return ({
                        ...prev,
                        tableData: newTableData
                    })
                })
            }
        });
    }

    const refreshAction = () => {
        setState(prev => ({
            ...prev,
            refreshLocal: !prev.refreshLocal
        }))
    }

    const handleChange = (field: string, value: any, isRefresh: boolean = true) => {
        pr("field")
        pr(field)
        pr(value)
        switch (field) {
            case 'perPage':
                let selection = (page - 1) * value;
                if (state.rows < selection)
                    handleChange('page', 1, false)
                break;
        }
        setState(prev => ({
            ...prev,
            [field]: value
        }));

        if (isRefresh)
            refreshAction();
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
        refreshAction();
    }

    const {page, perPage, pages, orderBy, order, tableData} = state

    return (
        <div className={ts.box}>

            <div className={g.tableScroll}>
                <table className={g.tableBeauty}>
                    <thead>
                    <TableHeaderN columnsTypes={columnsTypes} orderByColumn={orderByColumn} order={state.order}
                                  orderBy={state.orderBy}/>
                    </thead>
                    <tbody>
                    {tableData.map((row: any, idx) => {
                        return <TableRowN onChange={handleRowChange} id={idx} values={row}
                                          columnTypes={columnsTypes}/>
                    })}
                    </tbody>
                </table>
            </div>
            <TablePaginate onChange={handleChange} page={page} pages={pages} perPage={perPage}/>
        </div>
    )
}