import { ActionName, ApiRequest, ControllerName } from "../request";

export interface Label {
    id: number;
    labels: {[key: number]: {label: string}};
}

export class LabelListRequest implements ApiRequest {
    controller: ControllerName = 'Label';
    action: ActionName = 'list';
}
