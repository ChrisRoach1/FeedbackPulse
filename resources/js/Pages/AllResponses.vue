<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted, ref} from "vue";
import {Response} from "@/types/Response";
import { watchOnce } from '@vueuse/core'
import type { CarouselApi } from '@/Components/ui/carousel'
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/Components/ui/carousel'
import { Card, CardContent } from '@/Components/ui/card'

let props = defineProps<{
  responses?: Response[];
}>();

const groupedResponses: Map<String, Response[]> = ref(new Map<String, Response[]>());
const api = ref<CarouselApi>()
const totalCount = ref(0)
const current = ref(0)

onMounted(() =>{
  const uniqueGroupIds = [...new Set(props.responses.map(x => x.responseGroupId))];
  let index = 0;
  uniqueGroupIds.forEach(responseGroupdId =>{
    const responses = props.responses.filter(x => x.responseGroupId == responseGroupdId);
    groupedResponses.value.set(index, responses);
    index++;
  })
});

function setApi(val: CarouselApi) {
  api.value = val
}

watchOnce(api, (api) => {
  if (!api)
    return

  totalCount.value = groupedResponses.value.size
  current.value = api.selectedScrollSnap() + 1

  api.on('select', () => {
    current.value = api.selectedScrollSnap() + 1
  })
})

</script>



<template>
  <Head title="Responses" />

  <AuthenticatedLayout>

    <template #header>
      <h1>All Responses</h1>
    </template>
    <div class="flex flex-col justify-center items-center p-10">
      <Carousel class="relative w-fit" @init-api="setApi">
        <CarouselContent>
          <CarouselItem v-for="[key, value] in groupedResponses" :key="key">
            <div class="p-1">
              <Card>
                <CardContent class="flex flex-col aspect-square p-6">
                  <div>
                    <span class="text-2xl font-semibold">{{ value[0].userName }}</span>
                  </div>

                  <div v-for="response in value">
                    <b>{{response.question.title}}</b> - {{response.response}}
                  </div>
                </CardContent>
              </Card>
            </div>
          </CarouselItem>
        </CarouselContent>
        <CarouselPrevious />
        <CarouselNext />
      </Carousel>

      <div class="flex py-2 text-center text-sm text-muted-foreground">
        Response {{ current }} of {{ totalCount }}
      </div>
    </div>

  </AuthenticatedLayout>
</template>
