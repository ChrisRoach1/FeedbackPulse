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
import {TrashIcon, ViewVerticalIcon, RocketIcon} from "@radix-icons/vue";
import InputError from "@/Components/InputError.vue";
import QuestionnairePreview from "@/Pages/QuestionnairePreview.vue";
import Modal from "@/Components/Modal.vue";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/Components/ui/card";
import { Activity, ArrowUpRight, CircleUser, CreditCard, DollarSign, Menu, Package2, Search, Users, ClipboardIcon } from 'lucide-vue-next'

const questionnaireForm = useForm({
  title: "",
  questions: new Array<Question>()
})

const props = defineProps<{
  totalResponders: number;
  totalUserQuestionnaireCount: number;
  totalQuestionnaireCount: number;
}>()

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
      <h1 class="text-3xl font-bold tracking-tight">Questionnaire Dashboard</h1>
    </template>

    <!-- Enhanced Metrics Grid -->
    <div class="grid gap-4 md:grid-cols-3 md:gap-6 lg:grid-cols-3 mb-8">
      <Card class="hover:border-primary transition-colors">
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">
            Total Responses
          </CardTitle>
          <Users class="h-5 w-5 text-primary" />
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ props.totalResponders }}</div>
          <p class="text-xs text-muted-foreground mt-1">
            +20.1% from last month
          </p>
        </CardContent>
      </Card>

      <Card class="hover:border-primary transition-colors">
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">
            Your Questionnaires
          </CardTitle>
          <ClipboardIcon class="h-5 w-5 text-primary" />
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ props.totalUserQuestionnaireCount }}</div>
          <p class="text-xs text-muted-foreground mt-1">
            +2 new this week
          </p>
        </CardContent>
      </Card>

      <Card class="hover:border-primary transition-colors">
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">
            Platform Total
          </CardTitle>
          <Activity class="h-5 w-5 text-primary" />
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ props.totalQuestionnaireCount }}</div>
          <p class="text-xs text-muted-foreground mt-1">
            +12.3% overall growth
          </p>
        </CardContent>
      </Card>
    </div>

    <!-- Enhanced Builder Section -->
    <Card class="xl:col-span-2 border-primary/20 hover:border-primary/40 transition-colors">
      <CardHeader class="flex flex-row items-center space-x-4">
        <div class="space-y-1.5">
          <CardTitle class="text-2xl font-bold flex items-center gap-2">
            <RocketIcon class="h-6 w-6 text-primary" />
            Questionnaire Builder
          </CardTitle>
          <CardDescription class="text-muted-foreground">
            Craft your perfect survey with our intuitive tools
          </CardDescription>
        </div>
        <Button as-child size="sm" class="ml-auto gap-1">
          <a :href="route('allQuestionnaires')" class="group">
            View All
            <ArrowUpRight class="h-4 w-4 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
          </a>
        </Button>
      </CardHeader>
      <CardContent>
        <div class="space-y-8">
          <div class="flex items-center justify-between">
            <Button
              variant="ghost"
              @click="openPreview"
              class="gap-2 text-muted-foreground hover:text-primary"
            >
              <ViewVerticalIcon class="h-4 w-4" />
              Preview Draft
            </Button>
          </div>

          <Modal :show="confirmOpenPreview" @close="closeModal" :max-width="'2xl'">
            <div class="p-5">
              <h2 class="text-lg font-medium text-gray-900 ml-4 mb-4">
                Questionnaire Preview
              </h2>
              <QuestionnairePreview :title="questionnaireForm.title" :questions="questionnaireForm.questions" />
            </div>
          </Modal>

          <form @submit.prevent="questionnaireForm.post(route('questionnaire.store'), {onSuccess: () => questionnaireForm.reset(), preserveScroll: true})"
                class="space-y-8 overflow-auto p-1">
            <div class="space-y-6">
              <div class="space-y-3">
                <Label for="questionnaireTitle" class="text-base">Questionnaire Title</Label>
                <Input
                  id="questionnaireTitle"
                  type="text"
                  placeholder="Customer Feedback Survey..."
                  v-model="questionnaireForm.title"
                  class="text-lg py-6"
                />
                <InputError class="mt-1" :message="questionnaireForm.errors.title"/>
              </div>

              <div class="space-y-6">
                <div class="space-y-3">
                  <Button
                    @click="addQuestion"
                    type="button"
                    variant="outline"
                    class="w-full border-dashed hover:border-primary/50 hover:bg-primary/5"
                  >
                    + Add Question
                  </Button>
                  <InputError class="mt-1 text-center" :message="questionnaireForm.errors.questions ? 'Add some questions!' : '' "/>
                </div>

                <div v-for="(question, index) in questionnaireForm.questions"
                     class="space-y-4 border-l-4 border-primary/20 pl-4 hover:border-primary/40 transition-colors">
                  <div class="flex items-center justify-between">
                    <h3 class="font-medium text-lg">Question {{ index + 1 }}</h3>
                    <Button
                      type="button"
                      variant="ghost"
                      size="sm"
                      @click="deleteQuestion(index)"
                      class="text-muted-foreground hover:text-destructive"
                    >
                      <TrashIcon class="h-4 w-4" />
                    </Button>
                  </div>

                  <div class="space-y-4">
                    <div class="space-y-2">
                      <Label :for="'questionTitle-' + index">Question Text</Label>
                      <Input
                        :id="'questionTitle-' + index"
                        type="text"
                        placeholder="How satisfied are you with our service?"
                        v-model="question.title"
                      />
                      <InputError class="mt-1" :message="getQuestionTitleError(index)"/>
                    </div>

                    <div class="space-y-2">
                      <Label :for="'questionType-' + index">Response Type</Label>
                      <Select
                        :update:modelValue="resetPossibleItems(index)"
                        :id="'questionType-' + index"
                        v-model="question.type"
                      >
                        <SelectTrigger class="w-[240px]">
                          <SelectValue placeholder="Select response type..." />
                        </SelectTrigger>
                        <SelectContent>
                          <SelectItem value="1" class="hover:bg-primary/5">Free Text</SelectItem>
                          <SelectItem value="2">Multiple Choice</SelectItem>
                          <SelectItem value="3">Long Answer</SelectItem>
                          <SelectItem value="4">Radio Button</SelectItem>
                        </SelectContent>
                      </Select>
                      <InputError class="mt-1" :message="getQuestionTypeError(index)" />
                    </div>

                    <!-- Enhanced Options Section -->
                    <div v-if="question.type === '4'" class="space-y-3 bg-muted/10 p-4 rounded-lg">
                      <div class="space-y-2">
                        <Label>Radio Button values</Label>
                        <div class="grid gap-3 md:grid-cols-2">
                          <Input
                            placeholder="First Value"
                            v-model="question.possibleValues[0]"
                          />
                          <Input
                            placeholder="Second Value"
                            v-model="question.possibleValues[1]"
                          />
                        </div>
                      </div>
                    </div>

                    <div v-if="question.type === '2'" class="bg-muted/10 p-4 rounded-lg">
                      <Label>Multiple Choice Options</Label>
                      <TagsInput
                        v-model="question.possibleValues"
                        class="mt-2"
                      >
                        <TagsInputItem v-for="item in question.possibleValues" :key="item" :value="item">
                          <TagsInputItemText />
                          <TagsInputItemDelete class="hover:text-destructive" />
                        </TagsInputItem>
                        <TagsInputInput placeholder="Add option..." />
                      </TagsInput>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex gap-3 justify-end border-t pt-6">
                <Button
                  @click="resetForm"
                  variant="outline"
                  type="button"
                  class="border-destructive/20 text-destructive hover:bg-destructive/5 hover:border-destructive/30"
                >
                  Reset Form
                </Button>
                <Button type="submit" class="gap-2">
                  <RocketIcon class="h-4 w-4" />
                  Publish Questionnaire
                </Button>
              </div>
            </div>
          </form>
        </div>
        </CardContent>

      </Card>
  </AuthenticatedLayout>
</template>
