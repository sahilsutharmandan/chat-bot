<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-5">
            <TextInput
                label="Email"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                :errors="form.errors.email"
            />

            <TextInput
                label="Password"
                type="password"
                v-model="form.password"
                autocomplete="current-password"
                :errors="form.errors.password"
            />

            <div class="flex justify-between mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>
            </div>

            <div class="mt-4">
                <PrimaryButton
                    class="w-full !text-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
            <div class="flex justify-center mt-3">
                <span class="text-sm text-gray-600"
                    >Don't have an account?
                </span>
                <Link
                    :href="route('register')"
                    class="text-sm font-medium text-center text-indigo-400 hover:text-indigo-600"
                    >Register</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    canRegister: {
        type: Boolean,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>
