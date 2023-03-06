import {requestApi} from '../common/api'
import {FruitI} from "../pages/FruitsPage";

const directory = '/api/fruit';


function fruitApi(uri: any, params?: any) {
    let fullUri = directory + uri;
    var fullParams =
        {
            method: 'GET',
            headers: {'Content-Type': 'application/json'},
            ...params
        }
    return requestApi(fullUri, fullParams)
}


export function searchFruits(search: any) {
    return fruitApi('/search-fruits', {
        method: "POST",
        body: JSON.stringify(search)
    });
}

export function searchFavoriteFruits(search: any) {
    return fruitApi('/search-favorite-fruits', {
        method: "POST",
        body: JSON.stringify(search)
    });
}

export function updateFruit(fruit: FruitI) {
    return fruitApi('/update-fruit', {
        method: "POST",
        body: JSON.stringify(fruit)
    })
}