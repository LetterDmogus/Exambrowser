<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <header
            class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row"
            >
                <div
                    class="flex-1 rounded-br-lg rounded-bl-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-tl-lg lg:rounded-br-none lg:p-20 dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
                >
                    <h1 class="mb-1 text-2xl font-bold text-[#D32F2F] dark:text-[#FF4433]">Exambro Mobile</h1>
                    <p class="mb-6 text-base text-[#706f6c] dark:text-[#A1A09A]">
                        Sistem Manajemen Ujian Aman (Safe Exam Browser Style) untuk Sekolah.
                    </p>
                    <ul class="mb-8 flex flex-col space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#D32F2F]/10 text-[#D32F2F]">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Manajemen Sesi</h3>
                                <p class="text-[#706f6c] dark:text-[#A1A09A]">Buat sesi ujian dengan Public & Private Key yang unik.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#D32F2F]/10 text-[#D32F2F]">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Monitoring Kecurangan</h3>
                                <p class="text-[#706f6c] dark:text-[#A1A09A]">Pantau aktivitas siswa secara real-time dari aplikasi mobile.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#D32F2F]/10 text-[#D32F2F]">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Keamanan Native</h3>
                                <p class="text-[#706f6c] dark:text-[#A1A09A]">Integrasi startLockTask() dan FLAG_SECURE Android.</p>
                            </div>
                        </li>
                    </ul>
                    <div class="flex gap-3">
                        <Link
                            :href="login()"
                            class="inline-block rounded-md bg-[#D32F2F] px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#B71C1C] transition-colors"
                        >
                            Mulai Monitoring
                        </Link>
                    </div>
                </div>
                <div
                    class="relative -mb-px flex aspect-[335/364] w-full shrink-0 items-center justify-center overflow-hidden rounded-t-lg bg-[#fff2f2] lg:mb-0 lg:-ml-px lg:aspect-auto lg:w-[438px] lg:rounded-t-none lg:rounded-r-lg dark:bg-[#1D0002]"
                >
                    <div class="flex flex-col items-center p-12 text-center">
                        <div class="mb-4 rounded-2xl bg-[#D32F2F] p-6 text-white shadow-xl">
                            <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-[#B71C1C] dark:text-[#FF4433]">Secure Dashboard</h2>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Admin Control Panel</p>
                    </div>
                    <div
                        class="absolute inset-0 rounded-t-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-t-none lg:rounded-r-lg dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
                    ></div>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
