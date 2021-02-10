import { HttpClient } from "../client";
import { Ability, AbilityListRequest } from "./ability.model";

export class AbilityApi {

    private httpClient = new HttpClient();

    list(): Promise<Ability[]> {
        return this.httpClient
            .get<{abilities: Ability[]}>({ params: new AbilityListRequest() })
            .then(response => response.abilities);
    }
}