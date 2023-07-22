<template>
        <div class="flex justify-between p-3 border rounded-md bg-white shadow">
            <section class="space-y-1">
                <p class="font-medium">
                    {{ project.name }}
                </p>
                <p class="text-muted-foreground text-xs max-w-[250px]">{{ project.description }}</p>
            </section>
          <div class="flex items-center">
              <Button>
                  <Link :href="`project/${project?.id}`">View</Link>
              </Button>
          </div>


        </div>
</template>

<script setup lang="ts">
import {ref} from "@vue/reactivity";
import {Link} from "@inertiajs/vue3"
import Button from "../ui/Button.vue";
import {Project} from "../../models/Project";
const showModal = ref(false);

const props = defineProps<{ project?: Project }>();
</script>


<style scoped></style>
