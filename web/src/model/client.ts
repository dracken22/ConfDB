import { isNil } from "../utils/object.util";
import { ApiRequest } from "./request";

export interface HttpOptions {
    params?: ApiRequest;
    body?: ApiRequest;
}

export class HttpClient {

    constructor(private apiUrl: string = '/api?') {}
    
    get<T>(options: HttpOptions): Promise<T> {
        const urlParams = new URLSearchParams(options.params as any);
        return fetch(this.apiUrl + urlParams, {
            method: 'GET'
        }).then(response => this.parse(response));
    }

    post<T>(options: HttpOptions): Promise<T> {
        const urlParams = new URLSearchParams(options.params as any);
        return fetch(this.apiUrl + urlParams, {
            method: 'POST',
            body: this.encode(options.body)
        }).then(response => this.parse(response));
    }


    private encode(data: any) {
        return isNil(data) ? JSON.stringify(data) : data;
    }

    private parse(response: Response) {
        return response.json().then(json => {
            if(json.success) {
               return json; 
            }
            throw new Error(json.error);
        });
    }
}