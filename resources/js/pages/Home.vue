<script>
import axios from "axios";
import moment from "moment";
import { onMounted, ref } from "vue";
export default {
    setup() {
        // reactive state
        let meses = ref([]);
        let anos = ref([]);
        let mesSelecionado = ref(moment().format('M'));
        let anoSelecionado = ref(moment().format('YYYY'));
        // mounted
        onMounted(() => {
            // get api from laravel backend
            axios
                .get("api/exportacoes/rj/get-por/mes")
                .then((res) => {
                    meses.value = res.data.data;
                })
                .catch((error) => {
                    console.log(error.res.data);
                });

            axios
                .get("api/exportacoes/rj/get-por/ano")
                .then((res) => {
                    anos.value = res.data.data;
                })
                .catch((error) => {
                    console.log(error.res.data);
                });
        });

        return {
            meses,
            anos,
            mesSelecionado,
            anoSelecionado,
            options: {
                chart: {
                    id: "vuechart-example",
                },
                xaxis: {
                    categories: [
                        1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998,
                    ],
                },
            },
            series: [
                {
                    name: "series-1",
                    data: [30, 40, 45, 50, 49, 60, 70, 91],
                },
            ],
        };
    },
};
</script>
<template>
    <div class="col-span-12">
        <div x-data="{ pageName: `Task List`}">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-white/90"
                    x-text="pageName"
                >
                    Task List
                </h2>
                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a
                                class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="index.html"
                            >
                                Home
                                <svg
                                    class="stroke-current"
                                    width="17"
                                    height="16"
                                    viewBox="0 0 17 16"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                                        stroke=""
                                        stroke-width="1.2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </svg>
                            </a>
                        </li>
                        <li
                            class="text-sm text-gray-800 dark:text-white/90"
                            x-text="pageName"
                        >
                            Task List
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-span-12">
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
        >
            <div
                class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
            >
                <div>
                    <h3
                        class="text-lg font-semibold text-gray-800 dark:text-white"
                    >
                        Overview
                    </h3>
                </div>
                <div class="flex gap-x-3.5">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
                            >
                                Mês
                            </label>
                            <div
                                x-data="{ isOptionSelected: false }"
                                class="relative z-20 bg-transparent"
                            >
                                <select
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                    v-model="mesSelecionado"
                                >
                                    <option
                                        v-for="(mes, index) in meses"
                                        :value="index"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                    >
                                        {{ mes }}
                                    </option>
                                </select>
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                                >
                                    <svg
                                        class="stroke-current"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                            stroke=""
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
                            >
                                Ano
                            </label>
                            <div
                                x-data="{ isOptionSelected: false }"
                                class="relative z-20 bg-transparent"
                            >
                                <select
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                    v-model="anoSelecionado"
                                >
                                    <option
                                        v-for="ano in anos"
                                        :value="ano"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                    >
                                        {{ ano }}
                                    </option>
                                </select>
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                                >
                                    <svg
                                        class="stroke-current"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                            stroke=""
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <app-header-totais uf="rj" :ano="anoSelecionado" :mes="mesSelecionado" />
        </div>
        <div class="col-span-12 mt-5">
            <div
                class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6"
            >
                <div class="flex flex-wrap items-start justify-between gap-5">
                    <div>
                        <h3
                            class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90"
                        >
                            Analytics
                        </h3>
                        <span
                            class="block text-theme-sm text-gray-500 dark:text-gray-400"
                        >
                            Visitor analytics of last 30 days
                        </span>
                    </div>

                    <div
                        x-data="{selected: 'optionOne'}"
                        class="flex items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900"
                    >
                        <button
                            @click="selected = 'optionOne'"
                            :class="
                                selected === 'optionOne'
                                    ? 'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800'
                                    : 'text-gray-500 dark:text-gray-400'
                            "
                            class=":hover:text-white rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800"
                        >
                            12 months
                        </button>

                        <button
                            @click="selected = 'optionTwo'"
                            :class="
                                selected === 'optionTwo'
                                    ? 'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800'
                                    : 'text-gray-500 dark:text-gray-400'
                            "
                            class="hover:text-gray-900dark:hover:text-white rounded-md px-3 py-2 text-theme-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            30 days
                        </button>

                        <button
                            @click="selected = 'optionThree'"
                            :class="
                                selected === 'optionThree'
                                    ? 'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800'
                                    : 'text-gray-500 dark:text-gray-400'
                            "
                            class="rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 dark:hover:text-white text-gray-500 dark:text-gray-400"
                        >
                            7 days
                        </button>

                        <button
                            @click="selected = 'optionFour'"
                            :class="
                                selected === 'optionFour'
                                    ? 'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800'
                                    : 'text-gray-500 dark:text-gray-400'
                            "
                            class="rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 dark:hover:text-white text-gray-500 dark:text-gray-400"
                        >
                            24 hours
                        </button>
                    </div>
                </div>
                <div class="custom-scrollbar max-w-full overflow-x-auto">
                    <apexchart
                        height="300"
                        type="bar"
                        :options="options"
                        :series="series"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
