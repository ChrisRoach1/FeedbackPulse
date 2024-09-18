<script setup lang="ts">

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

const props = defineProps<{
  title: string,
  questions: Question[]
}>();

</script>



<template>

  <form class="grid w-full items-start gap-6 overflow-auto p-4 pt-0">
    <fieldset class="grid gap-6 rounded-lg border p-4">
      <div class="grid gap-3 justify-items-center">

        <h1 class="font-bold">{{props.title}}</h1>
      </div>

      <div v-for="(question, index) in props.questions">
        <fieldset class="grid gap-6 rounded-lg border p-4">
          <legend class="-ml-1 px-1 text-sm font-medium">
            {{question.title}}
          </legend>

          <div class="grid gap-3" v-if="question.type === '1'">
            <Input :id="'questionTitle-' + index" type="text" placeholder=""/>
          </div>
          <div class="grid gap-3" v-if="question.type === '2'">
            <Select :id="'questionType-' + index">
              <SelectTrigger id="model" class="items-start [&_[data-description]]:hidden">
                <SelectValue placeholder="Select an answer" />
              </SelectTrigger>
              <SelectContent>
                <div v-for="answer in question.possibleValues">
                  <SelectItem :value="answer">
                    {{ answer }}
                  </SelectItem>
                </div>
              </SelectContent>
            </Select>
          </div>

          <div class="grid gap-3" v-if="question.type === '3'">
            <Textarea :id="'questionTitle-' + index" type="text" placeholder=""/>
          </div>

          <div class="grid gap-3" v-if="question.type === '4'">
            <RadioGroup>
              <div class="flex items-center space-x-2" v-for="answer in question.possibleValues">
                <RadioGroupItem :id="answer" :value="answer" />
                <Label :for="answer">{{answer}}</Label>
              </div>
            </RadioGroup>
          </div>

        </fieldset>
      </div>
      <div class="gap-3 flex flex-row-reverse">
        <Button type="button">Submit</Button>
      </div>
    </fieldset>
  </form>
</template>
