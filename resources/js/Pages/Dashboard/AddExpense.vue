<script setup>
import { reactive, ref } from 'vue';

const formData = reactive({
    description: '',
    amount: '',
    currency: '',
})
const formErrors = ref('');


function clearFormData() {
    formData.description = '';
    formData.amount = '';
    formData.currency = '';
    formErrors.value = '';
}

async function submitForm() {
    loader.show();
    try {
        const response = await axios.post(route('expense.create'), formData);
        clearFormData();
        toast.success('Successfully Added!');

    } catch ({ response: { data: { data: errors } } }) {
        formErrors.value = errors;
    } finally {
        loader.hide();
    }
}
</script>
<template>
    <form class="max-w-lg mx-auto  ">
        <h1 class="text-center text-xl mb-5">Enter Expense Details</h1>

        <div class="mb-4">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Expense Description</label>
            <textarea v-model="formData.description" id="message" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Leave a comment..."></textarea>
            <span v-for="error in formErrors.description" class="text-red-500 text-sm">{{ error }}</span>

        </div>

        <div class="flex gap-4">
            <div class="flex-1 mb-5">
                <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900">Enter Amount</label>
                <input v-model="formData.amount" type="number" id="base-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <span v-for="error in formErrors.amount" class="text-red-500 text-sm">{{ error }}</span>
            </div>

            <div class="flex-1">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Select your Currency</label>
                <select v-model="formData.currency" id="countries"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="USD">USD</option>
                    <option value="BDT">BDT</option>
                    <option value="EUR">EUR</option>
                    <option value="JPY">JPY</option>
                    <option value="KRY"> KRY</option>
                </select>
                <span v-for="error in formErrors.currency" class="text-red-500 text-sm">{{ error }}</span>
            </div>
        </div>

        <button @click="submitForm" type="button" class="bg-blue-500 text-white w-full p-3 rounded-md">Add
            Expense</button>
    </form>
</template>