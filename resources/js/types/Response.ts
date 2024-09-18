import {Question} from "@/types/Question";

export interface Response {
    id: number;
    questionnaire_id: number;
    question_id: number;
    question: Question;
    response: string;
    responseGroupId: string;
    userName: string;
}