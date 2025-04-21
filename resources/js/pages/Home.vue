<script>
import axios from "axios";
import moment from "moment";
import { onMounted, ref } from "vue";
export default {
    setup() {
        // reactive state
        let meses = ref([]);
        let anos = ref([]);
        let mesSelecionado = ref(moment().format("M"));
        let anoSelecionado = ref(moment().format("YYYY"));
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
                    {{ [
                        { nome: "Acre", url: "/AC" },
                        { nome: "Alagoas", url: "/AL" },
                        { nome: "Amapá", url: "/AP" },
                        { nome: "Amazonas", url: "/AM" },
                        { nome: "Bahia", url: "/BA" },
                        { nome: "Ceará", url: "/CE" },
                        { nome: "Espírito Santo", url: "/ES" },
                        { nome: "Goiás", url: "/GO" },
                        { nome: "Maranhão", url: "/MA" },
                        { nome: "Mato Grosso", url: "/MT" },
                        { nome: "Mato Grosso do Sul", url: "/MS" },
                        { nome: "Minas Gerais", url: "/MG" },
                        { nome: "Pará", url: "/PA" },
                        { nome: "Paraíba", url: "/PB" },
                        { nome: "Paraná", url: "/PR" },
                        { nome: "Pernambuco", url: "/PE" },
                        { nome: "Piauí", url: "/PI" },
                        { nome: "Rio de Janeiro", url: "/RJ" },
                        { nome: "Rio Grande do Norte", url: "/RN" },
                        { nome: "Rio Grande do Sul", url: "/RS" },
                        { nome: "Rondônia", url: "/RO" },
                        { nome: "Roraima", url: "/RR" },
                        { nome: "Santa Catarina", url: "/SC" },
                        { nome: "São Paulo", url: "/SP" },
                        { nome: "Sergipe", url: "/SE" },
                        { nome: "Tocantins", url: "/TO" },
                    ].find((d) => d.url === ('/'+$route.params.uf).toUpperCase()).nome }}
                </h2>
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
            <app-header-totais
                :uf="$route.params.uf"
                :ano="anoSelecionado"
                :mes="mesSelecionado"
            />
        </div>
        <div class="col-span-12 mt-5">
            <div
                class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6"
            >
                <app-grafico-vl-fob-por-dia
                    :uf="$route.params.uf"
                    :ano="anoSelecionado"
                    :mes="mesSelecionado"
                />
            </div>
        </div>
        <div class="col-span-12 xl:col-span-7 mt-5">
            <!-- ====== Top Card Group Start -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Card item -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
                >
                    <app-grafico-vl-fob-por-pais
                        :uf="$route.params.uf"
                        :ano="anoSelecionado"
                        :mes="mesSelecionado"
                    />
                </div>

                <!-- Card item -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
                >
                    <app-grafico-vl-fob-por-via
                        :uf="$route.params.uf"
                        :ano="anoSelecionado"
                        :mes="mesSelecionado"
                    />
                </div>
            </div>
            <!-- ====== Top Card Group End -->
        </div>
    </div>
</template>
