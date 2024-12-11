<script setup>
import { onBeforeMount, ref } from 'vue';
import { toast } from 'vue3-toastify';
const totalExpense = ref('');
const expenseData = ref('');
const baseCurrency = ref(localStorage.getItem('baseCurrency') ?? 'BDT');

async function getSummary() {
    loader.show();
    try {
        const response = await axios.get(route('expense.summary', baseCurrency.value));
        totalExpense.value = response.data.totalExpense;
        expenseData.value = response.data.currencyWiseExpense;
    } catch (error) {
        if (error.response.data.error) {
            toast.error(error.response.data.error);
            localStorage.removeItem('baseCurrency'); //removes asuming unsupported currency
        }
        else toast.error('Something went wrong!');
    } finally {
        loader.hide();
    }
}

onBeforeMount(() => {
    getSummary();
});

function updateBaseAndFetchSummary() {
    localStorage.setItem('baseCurrency', baseCurrency.value);
    getSummary();
}

</script>
<template>

    <div class="flex flex-col gap-3">

        <div class="w-full border border-gray-200 rounded-lg shadow relative">
            <div class="flex justify-end">
                <div class="absolute top-3 right-3">
                    <select v-model="baseCurrency" @change="updateBaseAndFetchSummary" id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-28 md:w-52 p-2.5 text-center">
                        <option value="USD">USD</option>
                        <option value="BDT">BDT</option>
                        <option value="EUR">EUR</option>
                        <option value="JPY">JPY</option>
                        <option value="KRY">KRY</option>
                    </select>
                </div>
            </div>

            <div v-for="( value, key) in totalExpense" :key="key" class="flex flex-col items-center mt-5 md:mt-0 p-10">
                <h5 class="mb-1 text-xl font-bold text-orange-500 justify-center text-center">Total Expense in {{ key }}
                </h5>
                <span class="text-xl  text-blue-500  ">{{ value }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            <div v-for="(amount, currency) in expenseData"
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow  ">
                <div class="flex flex-col items-center p-10">
                    <h5 class="mb-1 text-xl font-medium text-gray-900 ">{{ currency }}</h5>
                    <span class="text-sm text-gray-500  ">{{ amount }}</span>
                </div>
            </div>
        </div>

    </div>
</template>