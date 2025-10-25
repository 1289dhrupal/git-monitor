<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <!-- Replaced InputLabel, TextInput, and InputError -->
            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <InputText
                    id="password"
                    type="password"
                    class="w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                    :invalid="!!form.errors.password"
                />
                <small v-if="form.errors.password" class="p-error">
                    {{ form.errors.password }}
                </small>
            </div>

            <div class="mt-4 flex justify-end">
                <!-- Replaced PrimaryButton with PrimeVue Button -->
                <Button
                    type="submit"
                    label="Confirm"
                    :loading="form.processing"
                />
            </div>
        </form>
    </GuestLayout>
</template>
