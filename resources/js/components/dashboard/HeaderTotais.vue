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
                .get(`api/exportacoes/${props.uf}/get-totais`, {
                    params: { mes: props.mes, ano: props.ano },
                })
                .then((res) => {
                    const atual = res.data.data.find(
                        (d) => d.ano == props.ano && d.mes == props.mes
                    );

                    const anterior = res.data.data.find(
                        (d, i) => i != res.data.data.indexOf(atual)
                    );
                    data.value = {
                        vl_fob: {
                            valor: atual.total_vl_fob,
                            diferenca_com_mes_anterior:
                                (atual.total_vl_fob / anterior.total_vl_fob) *
                                    100 -
                                100,
                        },
                        kg_liquido: {
                            valor: atual.total_kg_liquido,
                            diferenca_com_mes_anterior:
                                (atual.total_kg_liquido /
                                    anterior.total_kg_liquido) *
                                    100 -
                                100,
                        },
                        qt_stat: {
                            valor: atual.total_qt_estat,
                            diferenca_com_mes_anterior:
                                (atual.total_qt_estat /
                                    anterior.total_qt_estat) *
                                    100 -
                                100,
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
    <div
        class="grid rounded-2xl border border-gray-200 bg-white sm:grid-cols-2 xl:grid-cols-3 dark:border-gray-800 dark:bg-gray-900"
        v-if="!loading"
    >
        <div
            class="border-b border-gray-200 px-6 py-5 sm:border-r xl:border-b-0 dark:border-gray-800"
        >
            <span class="text-sm text-gray-500 dark:text-gray-400"
                >Total VL_FOB</span
            >
            <div class="mt-2 flex items-end gap-3">
                <h4
                    class="text-title-xs sm:text-title-sm font-bold text-gray-800 dark:text-white/90"
                >
                    ${{ data?.vl_fob?.valor }}
                </h4>
                <div>
                    <span
                        class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                        v-if="data?.vl_fob?.diferenca_com_mes_anterior > 0"
                    >
                        +{{ data?.vl_fob?.diferenca_com_mes_anterior }}%
                    </span>
                    <span
                        class="bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                        v-if="data?.vl_fob?.diferenca_com_mes_anterior < 0"
                    >
                        {{ data?.vl_fob?.diferenca_com_mes_anterior }}%
                    </span>
                </div>
            </div>
        </div>
        <div
            class="border-b border-gray-200 px-6 py-5 xl:border-r xl:border-b-0 dark:border-gray-800"
        >
            <span class="text-sm text-gray-500 dark:text-gray-400"
                >Total KG Liquido</span
            >
            <div class="mt-2 flex items-end gap-3">
                <h4
                    class="text-title-xs sm:text-title-sm font-bold text-gray-800 dark:text-white/90"
                >
                    {{ data?.kg_liquido?.valor }}
                </h4>
                <div>
                    <span
                        class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                        v-if="data?.kg_liquido?.diferenca_com_mes_anterior > 0"
                    >
                        +{{ data?.kg_liquido?.diferenca_com_mes_anterior }}%
                    </span>
                    <span
                        class="bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                        v-if="data?.kg_liquido?.diferenca_com_mes_anterior < 0"
                    >
                        {{ data?.kg_liquido?.diferenca_com_mes_anterior }}%
                    </span>
                </div>
            </div>
        </div>
        <div
            class="border-b border-gray-200 px-6 py-5 sm:border-r sm:border-b-0 dark:border-gray-800"
        >
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400"
                    >Total QT_ESTAT</span
                >
                <div class="mt-2 flex items-end gap-3">
                    <h4
                        class="text-title-xs sm:text-title-sm font-bold text-gray-800 dark:text-white/90"
                    >
                        {{ data?.qt_stat?.valor }}
                    </h4>
                    <div>
                        <span
                            class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                            v-if="data?.qt_stat?.diferenca_com_mes_anterior > 0"
                        >
                            +{{ data?.qt_stat?.diferenca_com_mes_anterior }}%
                        </span>
                        <span
                            class="bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500 flex items-center gap-1 rounded-full py-0.5 pr-2.5 pl-2 text-sm font-medium"
                            v-if="data?.qt_stat?.diferenca_com_mes_anterior < 0"
                        >
                            {{ data?.qt_stat?.diferenca_com_mes_anterior }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
