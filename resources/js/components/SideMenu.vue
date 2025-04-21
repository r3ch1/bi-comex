<script>
import axios from "axios";
import { onMounted, ref, watch } from "vue";
export default {

    setup(props) {
        let itemsEstados = ref([
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
        ]);

        onMounted(() => {

        });

        return {
            itemsEstados,
        };
    },
};
</script>
<template>
    <aside
        :class="
            sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'
        "
        class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 lg:static lg:translate-x-0 dark:border-gray-800 dark:bg-black -translate-x-full"
        @click.outside="sidebarToggle = false"
    >
        <!-- SIDEBAR HEADER -->
        <div
            :class="sidebarToggle ? 'justify-center' : 'justify-between'"
            class="sidebar-header flex items-center gap-2 pt-8 pb-7 justify-between"
        >
            <a href="index.html">
                <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                </span>
            </a>
        </div>
        <!-- SIDEBAR HEADER -->

        <div
            class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear"
        >
            <!-- Sidebar Menu -->
            <nav x-data="{selected: $persist('Dashboard')}">
                <!-- Support Group -->
                <div>
                    <h3
                        class="mb-4 text-xs leading-[20px] text-gray-400 uppercase"
                    >
                        <span
                            class="menu-group-title"
                            :class="sidebarToggle ? 'lg:hidden' : ''"
                        >
                            Estados
                        </span>

                        <svg
                            :class="
                                sidebarToggle ? 'lg:block hidden' : 'hidden'
                            "
                            class="menu-group-icon mx-auto fill-current hidden"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                fill=""
                            ></path>
                        </svg>
                    </h3>

                    <ul class="mb-6 flex flex-col gap-4">
                        <!-- Menu Item Chat -->
                        <li v-for="estado in itemsEstados">
                            <a
                                class="menu-item group menu-item-inactive"
                                :href="estado.url"
                                >{{ estado.nome }}</a
                            >
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </aside>
</template>
