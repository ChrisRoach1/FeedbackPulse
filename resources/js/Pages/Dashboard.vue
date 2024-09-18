<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select'
import {ref} from "vue";
import {Input} from "@/Components/ui/input";
import {Label} from "@/Components/ui/label";
import {Question} from "@/types/Question";
import {TagsInput, TagsInputItem, TagsInputItemText, TagsInputItemDelete, TagsInputInput} from "@/Components/ui/tags-input";
import {TrashIcon, ViewVerticalIcon} from "@radix-icons/vue";
import InputError from "@/Components/InputError.vue";
import QuestionnairePreview from "@/Pages/QuestionnairePreview.vue";
import Modal from "@/Components/Modal.vue";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/Components/ui/card";
import { Activity, ArrowUpRight, CircleUser, CreditCard, DollarSign, Menu, Package2, Search, Users } from 'lucide-vue-next'

const questionnaireForm = useForm({
  title: "",
  questions: new Array<Question>()
})

const props = defineProps<{
  totalResponders: number;
  totalUserQuestionnaireCount: number;
  totalQuestionnaireCount: number;
}>();

const confirmOpenPreview = ref(false);

function resetForm(){
  questionnaireForm.reset();
}
function addQuestion(){
  questionnaireForm.questions.push({
    id: 0,
    title: "",
    type: "",
    possibleValues: new Array<string>()
  })
}

function resetPossibleItems(index: number){
  if(questionnaireForm.questions[index].type === "4" && questionnaireForm.questions[index].possibleValues.length > 2){
    questionnaireForm.questions[index].possibleValues = [];
  }
}

function deleteQuestion(index: number){
  questionnaireForm.questions.splice(index, 1);
}

function getQuestionTitleError(index: number){
  let errorIndex = `questions.${index}.title`;
  if(errorIndex in questionnaireForm.errors){
    return "Title required"
  }else{
    return "";
  }
}

function getQuestionTypeError(index: number): string
{
  let errorIndex = `questions.${index}.type`;
  if(errorIndex in questionnaireForm.errors){
    return "Type required"
  }else{
    return "";
  }
}

const openPreview = () => {
  confirmOpenPreview.value = true;
};

const closeModal = () => {
  confirmOpenPreview.value = false;
};

</script>



<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

      <template #header>
        <h1>Dashboard</h1>
      </template>
      <div class="grid gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-4">
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">
              Total Responses
            </CardTitle>
            <Users class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">
              {{props.totalResponders}}
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">
              Your Total Questionnaires
            </CardTitle>
            <Menu class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">
              {{ props.totalUserQuestionnaireCount }}
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">
              Total Questionnaires
            </CardTitle>
            <Activity class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">
              {{ props.totalQuestionnaireCount }}
            </div>
          </CardContent>
        </Card>
      </div>

      <Card class="xl:col-span-2">
        <CardHeader class="flex flex-row items-center">
          <div class="grid gap-2">
            <CardTitle>Questionnaire Builder
            </CardTitle>
            <CardDescription>
              Build out a new questionnaire
            </CardDescription>
          </div>
          <Button as-child size="sm" class="ml-auto gap-1">
            <a :href="route('allQuestionnaires')">
              View All
              <ArrowUpRight class="h-4 w-4" />
            </a>
          </Button>
        </CardHeader>
        <CardContent>
          <Button variant="secondary" @click="openPreview" class="max-w-12 mb-5">
            <ViewVerticalIcon/>
          </Button>

          <Modal :show="confirmOpenPreview" @close="closeModal" :max-width="'2xl'">
            <div class="p-5">
              <h2 class="text-lg font-medium text-gray-900 ml-4 mb-4">
                Questionnaire Preview
              </h2>
              <QuestionnairePreview :title="questionnaireForm.title" :questions="questionnaireForm.questions" />
            </div>
          </Modal>

          <form @submit.prevent="questionnaireForm.post(route('questionnaire.store'), {onSuccess: () => questionnaireForm.reset(), preserveScroll: true})" class="grid w-full items-start gap-6 overflow-auto p-4 pt-0">
            <fieldset class="grid gap-6 rounded-lg border p-4">
              <div class="grid gap-3">
                <Label for="questionnaireTitle">Title</Label>
                <Input id="questionnaireTitle" type="text" placeholder="Title..." v-model="questionnaireForm.title"/>
                <InputError class="mt-2" :message="questionnaireForm.errors.title"/>
              </div>
              <div class="grid gap-3">
                <Button @click="addQuestion" type="button">Add Question</Button>
                <InputError class="mt-2" :message="questionnaireForm.errors.questions ? 'Add some questions!' : '' "/>

              </div>
              <div v-for="(question, index) in questionnaireForm.questions">
                <fieldset class="grid gap-6 rounded-lg border p-4">
                  <legend class="-ml-1 px-1 text-sm font-medium">
                    Question {{index+1}} *
                    <Button type="button" variant="ghost" @click="deleteQuestion(index)">
                      <TrashIcon />
                    </Button>

                  </legend>
                  <div class="grid gap-3">
                    <Label :for="'questionTitle-' + index">Question</Label>
                    <Input :id="'questionTitle-' + index" type="text" placeholder="" v-model="question.title"/>
                    <InputError class="mt-2" :message="getQuestionTitleError(index)"/>
                  </div>
                  <div class="grid gap-3">
                    <Label :for="'questionType-' + index">Question Type</Label>
                    <Select :update:modelValue="resetPossibleItems(index)" :id="'questionType-' + index" v-model="question.type">
                      <SelectTrigger id="model" class="items-start [&_[data-description]]:hidden">
                        <SelectValue placeholder="Select a Question Type" />
                      </SelectTrigger>
                      <SelectContent >
                        <SelectItem value="1">
                          Free Text
                        </SelectItem>
                        <SelectItem value="2" >
                          Select
                        </SelectItem>
                        <SelectItem value="3" >
                          Text Area
                        </SelectItem>
                        <SelectItem value="4">
                          Radio Button
                        </SelectItem>
                      </SelectContent>
                    </Select>
                    <InputError class="mt-2" :message="getQuestionTypeError(index)" />
                  </div>
                  <div v-if="question.type === '4'">
                    <div class="grid gap-3">
                      <Label :for="'radio-button-value-1-' + index">Radio Button 1 Value</Label>
                      <Input :id="'radio-button-value-1-' + index" type="text" placeholder="" v-model="question.possibleValues[0]"/>

                      <Label :for="'radio-button-value-2-' + index">Radio Button 2 Value</Label>
                      <Input :id="'radio-button-value-2-' + index" type="text" placeholder="" v-model="question.possibleValues[1]"/>
                    </div>
                  </div>

                  <div v-if="question.type === '2'">
                    <div class="grid gap-3">
                      <TagsInput v-model="question.possibleValues">
                        <TagsInputItem v-for="item in question.possibleValues" :key="item" :value="item">
                          <TagsInputItemText />
                          <TagsInputItemDelete />
                        </TagsInputItem>

                        <TagsInputInput placeholder="Values..." />
                      </TagsInput>
                    </div>
                  </div>
                </fieldset>
              </div>
              <div class="gap-3 flex flex-row-reverse">
                <Button @click="resetForm" variant="outline" type="button">Reset</Button>
                <Button type="submit">Submit</Button>
              </div>
            </fieldset>
          </form>
        </CardContent>
      </Card>



    </AuthenticatedLayout>
</template>
