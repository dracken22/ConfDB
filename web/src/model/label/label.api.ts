import { HttpClient } from "../client";
import { LabelListRequest } from "./label.model";

export class LabelApi {

    private httpClient = new HttpClient();

    list() {
        return this.httpClient.get({params: new LabelListRequest() });
    }
}