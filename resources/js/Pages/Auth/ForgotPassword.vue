<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <!-- class="mb-4 text-sm font-medium text-green-600 dark:text-green-400" -->
        <Message
            v-if="status"
            severity="success"
            :closable="false"
            class="mb-4"
        >
            {{ status }}
        </Message>

        <form @submit.prevent="submit" class="space-y-6">
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <InputText
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    :invalid="!!form.errors.email"
                    class="w-full"
                    aria-describedby="email-error"
                />
                <small
                    id="email-error"
                    class="text-red-600 dark:text-red-400"
                    v-if="form.errors.email"
                >
                    {{ form.errors.email }}
                </small>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Button
                    type="submit"
                    label="Email Password Reset Link"
                    :loading="form.processing"
                    :disabled="form.processing"
                />
            </div>
        </form>
    </GuestLayout>
</template>
