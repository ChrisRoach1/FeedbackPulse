<script setup lang="ts">
import {useForm} from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select'
import {Input} from "@/Components/ui/input";
import {Label} from "@/Components/ui/label";
import {Question} from "@/types/Question";
import {Textarea} from "@/Components/ui/textarea";
import {RadioGroup,RadioGroupItem} from "@/Components/ui/radio-group";
import {onMounted} from "vue";
import {Response} from "@/types/Response";
import InputError from "@/Components/InputError.vue";
import ResponseLayout from "@/Layouts/ResponseLayout.vue";

const props = defineProps<{
  title: string,
  questionnaire_id: number,
  questions: Question[]
}>();

const questionnaireForm = useForm({
  name: "",
  responses: new Array<Response>()
});

onMounted(() =>{
  props.questions?.forEach(question =>{
    questionnaireForm.responses.push({id: 0, question_id: question.id, question: question, questionnaire_id: props.questionnaire_id, response: ''} as Response);
  })
});

function getQuestionError(index: number){
  let errorIndex = `responses.${index}.response`;
  if(errorIndex in questionnaireForm.errors){
    return "Answer required"
  }else{
    return "";
  }
}

</script>

<template>
  <ResponseLayout>
    <form v-if="props.questionnaire_id !== undefined" @submit.prevent="questionnaireForm.post(`/respond/${props.questionnaire_id}`, { preserveScroll: true})" class="grid w-full items-start gap-6 overflow-auto p-4 pt-0">
      <fieldset class="grid gap-6 rounded-lg border p-4">
        <div class="grid gap-3 justify-items-center">

          <h1 class="font-bold">{{props.title}}</h1>
        </div>

        <fieldset class="grid gap-6 rounded-lg border p-4">
          <legend class="-ml-1 px-1 text-sm font-medium">
            Your name
          </legend>
        <Input id="'userName" type="text" placeholder="" v-model="questionnaireForm.name"/>
        <InputError class="mt-2" :message="questionnaireForm.errors.name"/>
        </fieldset>

        <div v-for="(response, index) in questionnaireForm.responses">
          <fieldset class="grid gap-6 rounded-lg border p-4">
            <legend class="-ml-1 px-1 text-sm font-medium">
              {{response.question.title}}
            </legend>

            <div class="grid gap-3" v-if="response.question.type === '1'">
              <Input :id="'questionTitle-' + index" type="text" placeholder="" v-model="response.response"/>
              <InputError class="mt-2" :message="getQuestionError(index)"/>
            </div>

            <div class="grid gap-3" v-if="response.question.type === '2'">
              <Select :id="'questionType-' + index" v-model="response.response">
                <SelectTrigger id="model" class="items-start [&_[data-description]]:hidden" >
                  <SelectValue placeholder="Select an answer" />
                </SelectTrigger>
                <SelectContent>
                  <div v-for="answer in response.question.possibleValues">
                    <SelectItem :value="answer">
                      {{ answer }}
                    </SelectItem>
                  </div>
                </SelectContent>
              </Select>
              <InputError class="mt-2" :message="getQuestionError(index)"/>
            </div>

            <div class="grid gap-3" v-if="response.question.type === '3'">
              <Textarea :id="'questionTitle-' + index" type="text" placeholder="" v-model="response.response"/>
              <InputError class="mt-2" :message="getQuestionError(index)"/>
            </div>

            <div class="grid gap-3" v-if="response.question.type === '4'">
              <RadioGroup v-model="response.response">
                <div class="flex items-center space-x-2" v-for="answer in response.question.possibleValues">
                  <RadioGroupItem :id="answer" :value="answer" />
                  <Label :for="answer">{{answer}}</Label>
                </div>
              </RadioGroup>
              <InputError class="mt-2" :message="getQuestionError(index)"/>
            </div>

          </fieldset>
        </div>
        <div class="gap-3 flex flex-row-reverse">
          <Button type="submit">Submit</Button>
        </div>
      </fieldset>
    </form>

    <div v-if="props.questionnaire_id == undefined" class="grid w-full items-start gap-6 overflow-auto p-4 pt-0">
      <fieldset class="grid gap-6 rounded-lg border p-4 justify-items-center">
        <h1>questionnaire does not exist</h1>
      </fieldset>
    </div>
  </ResponseLayout>

</template>
