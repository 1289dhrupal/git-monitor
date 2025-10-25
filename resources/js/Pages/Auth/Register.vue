<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <!-- Name Field -->
            <div class="flex flex-col gap-2">
                <label for="name">Name</label>
                <InputText
                    id="name"
                    type="text"
                    class="w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    :invalid="!!form.errors.name"
                />
                <small v-if="form.errors.name" class="p-error">
                    {{ form.errors.name }}
                </small>
            </div>

            <!-- Email Field -->
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <InputText
                    id="email"
                    type="email"
                    class="w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    :invalid="!!form.errors.email"
                />
                <small v-if="form.errors.email" class="p-error">
                    {{ form.errors.email }}
                </small>
            </div>

            <!-- Password Field -->
            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <InputText
                    id="password"
                    type="password"
                    class="w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    :invalid="!!form.errors.password"
                />
                <small v-if="form.errors.password" class="p-error">
                    {{ form.errors.password }}
                </small>
            </div>

            <!-- Confirm Password Field -->
            <div class="flex flex-col gap-2">
                <label for="password_confirmation">Confirm Password</label>
                <InputText
                    id="password_confirmation"
                    type="password"
                    class="w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    :invalid="!!form.errors.password_confirmation"
                />
                <small v-if="form.errors.password_confirmation" class="p-error">
                    {{ form.errors.password_confirmation }}
                </small>
            </div>

            <div class="mt-4 flex items-center justify-end gap-4">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <Button
                    type="submit"
                    label="Register"
                    :loading="form.processing"
                />
            </div>
        </form>
    </GuestLayout>
</template>
