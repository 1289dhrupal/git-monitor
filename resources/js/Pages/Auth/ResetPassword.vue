<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <!-- Email Field -->
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

            <div class="mt-4 flex items-center justify-end">
                <Button
                    type="submit"
                    label="Reset Password"
                    :loading="form.processing"
                />
            </div>
        </form>
    </GuestLayout>
</template>
