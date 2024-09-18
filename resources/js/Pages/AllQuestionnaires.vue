<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow} from '@/Components/ui/table'
import {Search} from "lucide-vue-next";
import {Button} from "@/Components/ui/button";
import { router } from '@inertiajs/vue3'
import {ref, watch} from "vue";
import {Input} from "@/Components/ui/input";
import {Questionnaire} from "@/types/Questionnaire";
import {ViewVerticalIcon, ClipboardCopyIcon, ActivityLogIcon} from "@radix-icons/vue";
import QuestionnairePreview from "@/Pages/QuestionnairePreview.vue";
import Modal from "@/Components/Modal.vue";
import {Tooltip,TooltipContent, TooltipProvider, TooltipTrigger} from "@/Components/ui/tooltip";


let props = defineProps<{
  questionnaires?: Questionnaire[];
  searchString: string | undefined;
}>();

let searchString = ref(props.searchString);
const confirmOpenPreview = ref(false);
const questionnairePreview = ref<Questionnaire>({} as Questionnaire);

watch(searchString, (value) =>{
  loadData(value);
})

function loadData(searchString: string | null = ''){
  router.get('/questionnaire',
      {
        searchString: searchString
      },
      {
        preserveState: true,
        preserveScroll: true,
        replace: true
      });
}
const openPreview = (questionnaire: Questionnaire) => {
  questionnairePreview.value = questionnaire;
  confirmOpenPreview.value = true;
};

const closeModal = () => {
  confirmOpenPreview.value = false;
};

const copyToClipboard = (questionnaire: Questionnaire) =>{
  navigator.clipboard.writeText(`${window.location.origin}/respond/${questionnaire.slug}`);
}

</script>



<template>
  <Head title="Questionnaires" />

  <AuthenticatedLayout>

    <Modal :show="confirmOpenPreview" @close="closeModal" :max-width="'2xl'">
      <div class="p-5">
        <h2 class="text-lg font-medium text-gray-900 ml-4 mb-4">
          Questionnaire Preview
        </h2>
        <QuestionnairePreview :title="questionnairePreview?.title" :questions="questionnairePreview?.questions" />
      </div>

    </Modal>

    <template #header>
      <h1>All Questionnaires</h1>
    </template>

    <div class="ml-auto flex items-center gap-2">

      <div class="relative ml-auto flex-1 md:grow-0">
        <Search class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
        <Input
            type="search"
            v-model="searchString"
            placeholder="Search..."
            class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[320px]"
        />
      </div>

    </div>

    <Table>
      <TableCaption>All your questionnaires.</TableCaption>
      <TableHeader>
        <TableRow>
          <TableHead>Questionnaire Title</TableHead>
          <TableHead class="text-right">
            Action
          </TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="questionnaire in questionnaires" :key="questionnaire.id">
          <TableCell class="font-medium">
            {{ questionnaire.title }}
          </TableCell>
          <TableCell class="text-right space-x-2">
            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger as-child>
                  <Button @click="openPreview(questionnaire)" class="max-w-12">
                    <ViewVerticalIcon/>
                  </Button>
                </TooltipTrigger>
                <TooltipContent>
                  <p>Open Preview</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>

            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger as-child>
                  <Button variant="secondary" @click="copyToClipboard(questionnaire)" class="max-w-12">
                    <ClipboardCopyIcon />
                  </Button>
                </TooltipTrigger>
                <TooltipContent>
                  <p>Copy Link to Clipboard</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>

            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger as-child>
                  <Button variant="link" class="max-w-12">
                    <a :href="route('allResponses', questionnaire.id)">
                      <ActivityLogIcon/>
                    </a>
                  </Button>
                </TooltipTrigger>
              <TooltipContent>
                  <p>View Responses</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>

  </AuthenticatedLayout>
</template>
