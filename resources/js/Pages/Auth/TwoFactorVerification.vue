<template>
    <form @submit.prevent="submit">
        <div>
            <Input
                label="Two Factor Authentication Code"
                type="text"
                class="mt-1 block w-full"
                v-model="form.code"
                :error="form.errors.code"
                required
                autofocus
                autocomplete="off"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Button
                type="submit"
                class="ml-4 bg-blue-600 hover:bg-blue-500 text-white"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Submit
            </Button>
        </div>
    </form>
</template>

<script>
import GuestLayout from "@/Layouts/Guest";
import Button from "@/Components/Button";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    inheritAttrs: false,
    layout: GuestLayout,
    components: {
        Button,
        Input,
    },

    props: {
        auth: Object,
        errors: Object,
    },
    setup() {
        const form = useForm({
            code: "",
        });

        function submit() {
            form.post(route("2fa.store"), {
                onFinish: () => form.reset(),
            });
        }

        return {
            form,
            submit,
        };
    },
};
</script>
