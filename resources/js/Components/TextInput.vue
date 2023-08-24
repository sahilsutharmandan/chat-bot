<template>
    <div>
        <label class="block mb-1" :for="id">{{ label }}</label>
        <input
            :id="id"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            :type="type"
            :src="src"
        />
        <InputError class="mt-2" :message="errors" />
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import InputError from "@/Components/InputError.vue";
defineProps({
    modelValue: {
        type: String,
        required: true,
        default: "",
    },
    id: {
        type: String,
        default: `input_${Math.floor(Math.random() * 1000)}`,
    },
    label: {
        type: String,
    },
    errors: {
        type: String,
    },
    src: {
        type: String,
    },

    type: {
        type: String,
        default: "text",
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
