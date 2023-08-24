<template>
    <Head title="Chats Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Chats Create
            </h2>
        </template>

        <div
            class="flex flex-col justify-center flex-1 min-h-full py-12 mx-auto md:max-w-2xl sm:px-6 lg:px-8"
        >
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
                <div
                    class="px-6 py-12 bg-white border shadow sm:rounded-lg sm:px-12"
                >
                    <form
                        class="space-y-5"
                        @submit.prevent="
                            chat?.id ? updateChat(chat?.id) : createChat()
                        "
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <TextInput
                            label="Name"
                            v-model="form.name"
                            :errors="errors?.name"
                        />
                        <TextInput
                            label="Email"
                            v-model="form.email"
                            :errors="errors?.email"
                        />
                        <TextInput
                            v-model="form.image"
                            v-if="chat?.image"
                            label="Image Link"
                            type="image"
                            :src="form.image"
                        />
                        <TextInput
                            v-else
                            label="Image Link"
                            v-model="form.image"
                            type="file"
                            :errors="errors?.image"
                        />

                        <TextInput
                            label="Title"
                            v-model="form.title"
                            :errors="errors?.title"
                        />
                        <TextInput
                            label="Status"
                            v-model="form.status"
                            :errors="errors?.status"
                        />
                        <TextInput
                            label="Role"
                            v-model="form.role"
                            :errors="errors?.role"
                        />

                        <div>
                            <button
                                type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    errors: Object,
    chat: Object,
});

const form = useForm(
    props?.chat
        ? { ...props?.chat }
        : {
              name: null,
              email: null,
              image: null,
              status: null,
              role: null,
              title: null,
          }
);
const createChat = () => {
    form.post(route("chat.store"));
};
const updateChat = (id) => {
    form.put(route("chat.update", id));
};
</script>
