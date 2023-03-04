const address = 'http://localhost';


export interface requestResult {
    success: boolean,
    data: any,
    message: string
}


export async function requestApi(uri: string, params: object = {}): Promise<requestResult> {
    let fullUri = address + uri;

    let responce = await fetch(fullUri, params)
    let result = await responce.json()
    return result;
}