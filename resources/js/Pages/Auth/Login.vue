<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <!-- Replaced div with PrimeVue Message component -->
        <Message
            v-if="status"
            severity="success"
            :closable="false"
            class="mb-4"
        >
            {{ status }}
        </Message>

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <!-- Replaced InputLabel, TextInput, and InputError -->
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <InputText
                    id="email"
                    type="email"
                    class="w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    :invalid="!!form.errors.email"
                />
                <small v-if="form.errors.email" class="p-error">
                    {{ form.errors.email }}
                </small>
            </div>

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
                    :invalid="!!form.errors.password"
                />
                <small v-if="form.errors.password" class="p-error">
                    {{ form.errors.password }}
                </small>
            </div>

            <!-- Replaced Breeze Checkbox with PrimeVue Checkbox -->
            <div class="flex items-center gap-2">
                <Checkbox
                    id="remember"
                    v-model="form.remember"
                    binary
                    name="remember"
                />
                <label
                    for="remember"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    Remember me
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end gap-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Forgot your password?
                </Link>

                <!-- Replaced PrimaryButton with PrimeVue Button -->
                <Button
                    type="submit"
                    label="Log in"
                    :loading="form.processing"
                />
            </div>
        </form>
    </GuestLayout>
</template>
