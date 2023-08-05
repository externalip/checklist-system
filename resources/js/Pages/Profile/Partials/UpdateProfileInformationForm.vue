<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    user: Object,
    employee: Object,
});

const form = useForm({
    _method: "PUT",
    username: props.user?.username,
    first_name: props.employee?.first_name,
    last_name: props.employee?.last_name,
    gender: props.employee?.gender,
    date_of_birth: props.employee?.date_of_birth,
    contact: props.employee?.contact,
    shift: props.employee?.shift,
});
console.log(form.shift);
const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Profile Information </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="col-span-6 sm:col-span-4"
            >
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                />

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>

                <SecondaryButton
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="username" value="Username" />
                <TextInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError :message="form.errors.username" class="mt-2" />
            </div>
            <!-- Employee Form -->
            <div class="col-span-6 sm:col-span-4">
                <!-- First Name Input -->
                <InputLabel for="first_name" value="First Name" />
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="given-name"
                />
                <InputError :message="form.errors.first_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Last Name Input -->
                <InputLabel for="last_name" value="Last Name" />
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="family-name"
                />
                <InputError :message="form.errors.last_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Gender Input -->
                <InputLabel for="gender" value="Gender" />
                <select
                    id="gender"
                    v-model="form.gender"
                    class="mt-1 block w-full"
                    required
                    autocomplete="sex"
                >
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <InputError :message="form.errors.gender" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Date of Birth Input -->
                <InputLabel for="date_of_birth" value="Date of Birth" />
                <TextInput
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    type="date"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="form.errors.date_of_birth" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Contact Input -->
                <InputLabel for="contact" value="Contact" />
                <TextInput
                    id="contact"
                    v-model="form.contact"
                    type="number"
                    class="mt-1 block w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    required
                    autocomplete="tel"
                />
                <InputError :message="form.errors.contact" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Shift Input -->
                <InputLabel for="shift" value="Shift" />
                <select
                    id="shift"
                    v-model="form.shift"
                    class="mt-1 block w-full"
                    required
                >
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Night">Night</option>
                </select>
                <InputError :message="form.errors.shift" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
