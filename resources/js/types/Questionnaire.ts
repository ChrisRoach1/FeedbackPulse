import {Question} from "@/types/Question";
import {Response} from "@/types/Response";

export interface Questionnaire{
    id: number;
    title: string;
    slug: string;
    questions: Question[];
    created_at: Date;
    updated_at: Date;
    responses: Response[];
}