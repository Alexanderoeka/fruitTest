import {requestApi} from '../common/api'

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
    return fruitApi('/bobil', {
        method: "POST",
        body: JSON.stringify(search)
    });
}


export function trys(search: any) {
    return fruitApi('/bobil', {
        method: "POST",
    });
}
