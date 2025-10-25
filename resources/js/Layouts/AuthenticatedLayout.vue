<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

// Define types for user props if available, adjust as needed
interface User {
    name: string;
    email: string;
}

const page = usePage();
const user = computed(() => page.props.auth.user as User); // Type assertion

const showingNavigationDropdown = ref(false);

const menu = ref(); // Ref for the PrimeVue Menu component
const menuItems = ref([
    {
        label: 'Profile',
        icon: 'pi pi-user',
        route: 'profile.edit', // Use route name for command
    },
    {
        label: 'Log Out',
        icon: 'pi pi-sign-out',
        route: 'logout', // Use route name for command
        method: 'post', // Specify method for Inertia link
    },
]);

// Function to toggle the PrimeVue menu
const toggleMenu = (event: Event) => {
    menu.value.toggle(event);
};

// Import router from inertiajs/vue3 if not already available globally
import { router } from '@inertiajs/vue3';

// Function to navigate using Inertia
const navigate = (routeName: string) => {
    router.get(route(routeName));
};
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav
                class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <!-- Replace Link with Button -->
                                <Button
                                    @click="navigate('dashboard')"
                                    label="Dashboard"
                                    link
                                    :class="[
                                        '!inline-flex !items-center !border-b-2 !px-1 !pt-1 !text-sm !font-medium !transition !duration-150 !ease-in-out',
                                        route().current('dashboard')
                                            ? '!focus:outline-none !focus:border-indigo-700 !border-indigo-400 !text-gray-900 dark:!border-indigo-600 dark:!text-gray-100'
                                            : '!focus:outline-none !focus:text-gray-700 dark:!focus:text-gray-300 !focus:border-gray-300 dark:!focus:border-gray-700 !border-transparent !text-gray-500 hover:!border-gray-300 hover:!text-gray-700 dark:!text-gray-400 dark:hover:!border-gray-700 dark:hover:!text-gray-300',
                                    ]"
                                />
                                <!-- Add other NavLinks here using Button link -->
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Button
                                    @click="toggleMenu"
                                    type="button"
                                    icon="pi pi-user"
                                    :label="user.name"
                                    text
                                    rounded
                                    aria-haspopup="true"
                                    aria-controls="overlay_menu"
                                    class="!inline-flex !items-center !text-sm !font-medium !leading-4 !text-gray-500 hover:!text-gray-700 dark:!text-gray-400 dark:hover:!text-gray-300"
                                >
                                    <i class="pi pi-angle-down ml-2"></i>
                                    <!-- Use PrimeVue icon -->
                                </Button>
                                <Menu
                                    ref="menu"
                                    id="overlay_menu"
                                    :model="menuItems"
                                    :popup="true"
                                >
                                    <template #item="{ item, props }">
                                        <Link
                                            :href="route(item.route)"
                                            :method="item.method || 'get'"
                                            as="a"
                                            v-bind="props.action"
                                            class="flex items-center"
                                        >
                                            <span :class="item.icon" />
                                            <span class="ml-2">{{
                                                item.label
                                            }}</span>
                                        </Link>
                                    </template>
                                </Menu>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <Button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                icon="pi pi-bars"
                                text
                                rounded
                                class="!inline-flex !items-center !justify-center !p-2 !text-gray-400 dark:!text-gray-500"
                            />
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div
                        v-show="showingNavigationDropdown"
                        class="sm:hidden"
                        style="display: none"
                    >
                        <div class="space-y-1 pb-3 pt-2">
                            <!-- Replace Responsive NavLink with Button -->
                            <Button
                                @click="navigate('dashboard')"
                                label="Dashboard"
                                text
                                :class="[
                                    'block w-full border-l-4 py-2 pe-4 ps-3 text-left text-base font-medium transition duration-150 ease-in-out',
                                    route().current('dashboard')
                                        ? 'border-indigo-400 bg-indigo-50 text-indigo-700 focus:border-indigo-700 focus:bg-indigo-100 focus:text-indigo-800 dark:border-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300 dark:focus:border-indigo-300 dark:focus:bg-indigo-900 dark:focus:text-indigo-200'
                                        : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 focus:border-gray-300 focus:bg-gray-50 focus:text-gray-800 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:focus:border-gray-600 dark:focus:bg-gray-700 dark:focus:text-gray-200',
                                ]"
                            />
                            <!-- Add other Responsive NavLinks here -->
                        </div>

                        <!-- Responsive Settings Options -->
                        <div
                            class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                        >
                            <div class="px-4">
                                <div
                                    class="text-base font-medium text-gray-800 dark:text-gray-200"
                                >
                                    {{ user.name }}
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ user.email }}
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Replace Links with Buttons -->
                                <Button
                                    @click="navigate('profile.edit')"
                                    label="Profile"
                                    text
                                    class="block w-full !px-4 !py-2 text-left !text-sm !leading-5 !text-gray-700 hover:!bg-gray-100 dark:!text-gray-300 dark:hover:!bg-gray-700"
                                />
                                <Button
                                    @click="router.post(route('logout'))"
                                    label="Log Out"
                                    text
                                    class="block w-full !px-4 !py-2 text-left !text-sm !leading-5 !text-gray-700 hover:!bg-gray-100 dark:!text-gray-300 dark:hover:!bg-gray-700"
                                />
                            </div>
                        </div>
                    </div>
                </transition>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow dark:bg-gray-800"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
