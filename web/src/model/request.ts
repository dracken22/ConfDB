export type ControllerName = 'Label' | 'Army' | 'Ability';
export type ActionName = 'list' | 'read' | 'create' | 'update' | 'list_alliances' | 'list_armies' | 'list_armies_by_alliance';

export interface ApiRequest {
    controller: ControllerName;
    action: ActionName;
}