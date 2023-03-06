import React, {useState} from "react";
import SearchField from "../components/SearchField";
import fs from './fruitsStyle.module.css';
import TableNew, {ColumnI, SearchTParamsI} from "../components/Tablen/TableNew";
import {requestResult} from "../common/api";
import {searchFavoriteFruits, searchFruits, updateFruit} from "../queries/fruits";
import {pr} from "../common/utils";
import ls from "../components/styles/linksStyle.module.css";
import {FruitI, StateI} from "./FruitsPage";

export default function FavoriteFruitsPage() {


    const [state, setState] = useState<StateI>({
        search: '',
        searchButton: false
    });


    const searchFruitsTable = (params: SearchTParamsI): Promise<requestResult> => {
        const {search} = state
        return searchFavoriteFruits({...params, search});
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

    const onSearch = () => {
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


    const {searchButton} = state
    return (
        <div>
            <h3 className={ls.linkGroup}>FAVORITE</h3>
            <div className={fs.search}>
                <SearchField onSubmit={onSearch} onChange={handleChange('search')} value={state.search}/>
                <TableNew getTableData={searchFruitsTable} onRowChange={handleRowChange}
                          columnsTypes={columnsTypes} searchButton={searchButton}/>
            </div>


        </div>
    )
}