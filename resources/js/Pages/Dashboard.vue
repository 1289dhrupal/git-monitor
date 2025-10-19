<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Import PrimeVue components
import Button from 'primevue/button';
import Card from 'primevue/card';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6">
                    <Card>
                        <template #title>Git-Monitor Project</template>
                        <template #content>
                            <p class="m-0">
                                Welcome! Your project is successfully set up
                                with Laravel, Vue, TypeScript, and PrimeVue.
                            </p>
                        </template>
                        <template #footer>
                            <Button icon="pi pi-check" label="Awesome!" />
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
