import { Label } from "../label/label.model";
import { ActionName, ApiRequest, ControllerName } from "../request";

export interface Ability {
    id: number;
    name: Label;
    description: Label;
    has_value?: boolean;
}

export class AbilityListRequest implements ApiRequest {
    controller: ControllerName = 'Ability';
    action: ActionName = 'list';
}
