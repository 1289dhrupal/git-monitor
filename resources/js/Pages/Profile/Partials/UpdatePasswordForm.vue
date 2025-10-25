<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<any>(null);
const currentPasswordInput = ref<any>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div class="flex flex-col gap-2">
                <label for="current_password">Current Password</label>
                <InputText
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="w-full"
                    autocomplete="current-password"
                    :invalid="!!form.errors.current_password"
                />
                <small v-if="form.errors.current_password" class="p-error">
                    {{ form.errors.current_password }}
                </small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password">New Password</label>
                <InputText
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="w-full"
                    autocomplete="new-password"
                    :invalid="!!form.errors.password"
                />
                <small v-if="form.errors.password" class="p-error">
                    {{ form.errors.password }}
                </small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password_confirmation">Confirm Password</label>
                <InputText
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="w-full"
                    autocomplete="new-password"
                    :invalid="!!form.errors.password_confirmation"
                />
                <small v-if="form.errors.password_confirmation" class="p-error">
                    {{ form.errors.password_confirmation }}
                </small>
            </div>

            <div class="flex items-center gap-4">
                <Button type="submit" label="Save" :loading="form.processing" />

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
