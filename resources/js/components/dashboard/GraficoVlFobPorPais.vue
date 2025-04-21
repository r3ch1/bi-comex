<script>
import axios from "axios";
import { onMounted, ref, watch } from "vue";
export default {
    props: ["uf", "mes", "ano"],
    setup(props) {
        let loading = ref(true);
        let data = ref({});
        let mes = ref(props.mes);

        const load = async () => {
            loading.value = true;
            axios
                .get(
                    `api/exportacoes/${props.uf}/get-totais-por-campo/vl_fob/pais_id`,
                    {
                        params: { mes: props.mes, ano: props.ano },
                    }
                )
                .then((res) => {
                    data.value = {
                        series: res.data.data.map((d) =>
                            parseFloat(d.sumed_vl_fob)
                        ),
                        options: {
                            chart: {
                                width: 380,
                                type: "pie",
                            },
                            labels: res.data.data.map((d) => d.pais.nome),
                            responsive: [
                                {
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200,
                                        },
                                        legend: {
                                            position: "bottom",
                                        },
                                    },
                                },
                            ],
                        },
                    };
                })
                .finally(() => {
                    loading.value = false;
                });
        };

        watch(
            () => [props.mes, props.ano, props.uf],
            () => {
                load();
            }
        );

        onMounted(() => {
            load();
        });

        return {
            loading,
            data,
        };
    },
};
</script>
<template>
    <div class="flex flex-wrap items-start justify-between gap-5">
        <div>
            <h3
                class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90"
            >
                VL_FOB por país
            </h3>
            <span class="block text-theme-sm text-gray-500 dark:text-gray-400">
            </span>
        </div>

        <!-- <div
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
        </div> -->
    </div>
    <div
        class="grid rounded-2xl border border-gray-200 bg-white sm:grid-cols-1 xl:grid-cols-1 dark:border-gray-800 dark:bg-gray-900"
        v-if="loading"
    >
        <div
            class="border-b border-gray-200 px-6 py-5 sm:border-r xl:border-b-0 dark:border-gray-800 text-center"
        >
            LOADING
        </div>
    </div>
    <div class="custom-scrollbar max-w-full overflow-x-auto" v-if="!loading">
        <apexchart type="pie" :options="data.options" :series="data.series" />
    </div>
</template>
