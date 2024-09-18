import {QuestionItem} from "@/types/QuestionItem";

export interface Question{
    id: number;
    title: string;
    type: string;
    possibleValues: string[];
}