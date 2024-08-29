import {Question} from "@/types/Question";

export interface Questionnaire{
    title: string;
    questions: Question[];
    created_at: Date;
    updated_at: Date;
}