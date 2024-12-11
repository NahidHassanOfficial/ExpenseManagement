<script setup>
import { onBeforeMount, onMounted, ref } from 'vue';
const expenseData = ref('');

onBeforeMount(() => {
    (async () => {
        loader.show();
        try {
            const response = await axios.get(route('expense.list'));
            expenseData.value = response.data.expenseData;
        } catch (error) {
            toast.error('Something went wrong!');
        } finally {
            loader.hide();
        }
    })()
});

</script>
<template>
    <div class=" relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Currency
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="expense in expenseData" class="bg-white border-b  ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{ expense.description }}
                    </th>
                    <td class="px-6 py-4">
                        {{ expense.amount }}
                    </td>
                    <td class="px-6 py-4">
                        {{ expense.currency }}
                    </td>
                    <td class="px-6 py-4">
                        {{ new Date().toDateString(expense.created_at) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>