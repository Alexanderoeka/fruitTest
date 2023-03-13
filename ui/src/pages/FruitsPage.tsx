import React, {useEffect, useState} from "react";
import SearchField from "../components/SearchField";
import fs from "./fruitsStyle.module.css";
import {searchFruits, updateFruit} from "../queries/fruits";
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
    favorite: boolean
}

export interface StateI {
    search: string,
    searchButton: boolean
}

export interface fruitType {
    id: number,
    name: string,
    genus: string,
    family: string,
    fruitOrder: string,
    favorite: boolean
}


export default function FruitsPage() {


    const [state, setState] = useState<StateI>({
        search: '',
        searchButton: false
    });


    const searchFruitsTable = (params: SearchTParamsI): Promise<requestResult> => {
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

    const handleRowChange = (fruit: FruitI) => {
        return updateFruit(fruit)
    }

    const handleSearch = () => {
        setState(prev => ({
            ...prev,
            searchButton: !prev.searchButton
        }))
    }


    const columnsTypes: ColumnI[] = [
        {id: 'id', text: 'id'},
        {id: 'name', text: 'name'},
        {id: 'genus', text: 'genus'},
        {id: 'family', text: 'family'},
        {id: 'fruitOrder', text: 'fruitOrder'},
        {id: 'favorite', text: 'favorite', type: "change"},
    ]


    const {searchButton, search} = state
    return (
        <div>
            <h3 className={ls.linkGroup}> FRUITS DEPLOYED 1 </h3>
            <div className={fs.search}>
                <SearchField onSubmit={handleSearch} onChange={handleChange('search')} value={search}/>
                <TableNew getTableData={searchFruitsTable} onRowChange={handleRowChange}
                          columnsTypes={columnsTypes} searchButton={searchButton}/>
            </div>


        </div>
    )
}