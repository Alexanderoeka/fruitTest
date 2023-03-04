import React, {useEffect, useState} from "react";
import SearchField from "../components/SearchField";
import fs from "./fruitsStyle.module.css";
import {searchFruits, trys} from "../queries/fruits";
import {pr} from "../common/utils";
import {dataTable} from "../common/dataRemoveAfter";
import TableNew, {ColumnI, SearchTParamsI} from "../components/Tablen/TableNew";
import ls from '../components/styles/linksStyle.module.css'
import {requestResult} from "../common/api";

export interface SearchI {
    search: string | null,
    perPage: 10 | 30 | 50,
    page: number,
    pages: number,
    order: 'asc' | 'desc',
    orderBy: string | null,
}


export interface FruitI {
    id: number,
    name: string,
    genus: string,
    family: string,
    fruitOrder: string
    isFavorite: boolean
}

interface StateI {
    search: string,
    fruits: FruitI[],
    refresh: boolean
}

export interface fruitType {
    id: number,
    name: string,
    genus: string,
    family: string,
    fruitOrder: string,
    isFavorite: boolean
}


export default function FruitsPage() {


    const [state, setState] = useState<StateI>({
        search: '',
        fruits: dataTable,
        refresh: true
    });

    useEffect(() => {
        // searchFruits(state.search).then(response=>{
        //     pr(response)
        //     setState(prev=>({
        //         ...prev
        //     }))
        //     }
        // );
        // searchFruits(state.search)
        //     .then(result=>{
        //         pr(result);
        //     })

    }, [])


    const searchFruitss = (params: SearchTParamsI): Promise<requestResult> => {
        const {search} = state
        return searchFruits({...params, search});
    }

    const handleChange = (field: string) => (e: any) => {

        let value = e.target.value ?? e;

        setState(prev => ({
            ...prev,
            [field]: value
        }))
    }

    const handleRowChange = (field: string, rowId: number) => (e: any) => {

        let value = e.target?.value ?? e;


        setState(prev => {
            let row = prev.fruits[rowId];
            row = {
                ...row,
                [field as keyof FruitI]: value
            };

            prev.fruits[rowId] = row;
            return ({
                ...prev

            })
        })
    }

    const onSearch = () => {
        pr('SEARCH FOR SHH')
        setState(prev => ({
            ...prev,
            refresh: !prev.refresh
        }))
        // searchFruitss()

    }


    const columnsTypes: ColumnI[] = [
        {id: 'id', text: 'id'},
        {id: 'name', text: 'name'},
        {id: 'genus', text: 'genus'},
        {id: 'family', text: 'family'},
        {id: 'fruitOrder', text: 'fruitOrder'},
        {id: 'favorite', text: 'favorite', type: "change", onClick: handleRowChange},
    ]


    const {refresh, fruits} = state
    return (
        <div>
            <h3 className={ls.linkGroup}> FRUITS 43</h3>
            <div className={fs.search}>
                <SearchField onSubmit={onSearch} onChange={handleChange('search')} value={state.search}/>
                <TableNew getTableData={searchFruitss} onRowChange={handleRowChange} refresh={refresh}
                          columnsTypes={columnsTypes}/>
            </div>


        </div>
    )
}