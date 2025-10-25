<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
// We type the ref to `any` because it will hold a PrimeVue component instance,
// not a simple HTMLInputElement.
const passwordInput = ref<any>(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => {
        // PrimeVue components expose a focus() method
        passwordInput.value?.focus();
    });
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete Account
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </p>
        </header>

        <Button
            @click="confirmUserDeletion"
            label="Delete Account"
            severity="danger"
        />

        <Dialog
            v-model:visible="confirmingUserDeletion"
            @hide="closeModal"
            modal
            header="Are you sure you want to delete your account?"
            class="w-full max-w-lg p-6"
        >
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Please enter your password to confirm
                you would like to permanently delete your account.
            </p>

            <div class="mt-6 flex flex-col gap-2">
                <label for="password_delete" class="sr-only">Password</label>

                <InputText
                    id="password_delete"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="w-full"
                    placeholder="Password"
                    :invalid="!!form.errors.password"
                    @keyup.enter="deleteUser"
                />

                <small v-if="form.errors.password" class="p-error">
                    {{ form.errors.password }}
                </small>
            </div>

            <template #footer>
                <Button
                    label="Cancel"
                    severity="secondary"
                    outlined
                    @click="closeModal"
                />

                <Button
                    label="Delete Account"
                    severity="danger"
                    class="ms-3"
                    :loading="form.processing"
                    @click="deleteUser"
                />
            </template>
        </Dialog>
    </section>
</template>
