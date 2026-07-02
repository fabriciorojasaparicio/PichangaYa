<script setup lang="ts">
import MaterialIcon from '@/components/MaterialIcon.vue';
import { ref } from 'vue';
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: null as unknown as undefined,
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();

const showPassword = ref(false);
</script>

<template>
    <Head title="Log in" />

    <div class="flex min-h-screen">
        <!-- Left Side: Visual/Hero Section (Desktop Only) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-[#102216]">
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-cover bg-center" data-alt="Modern indoor soccer court with bright lighting" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCJJQxN_Mp2AQyAhStBvUhBks8MeuwC2ZFINpHBckLbEQJhhYVxnNYrE8Yxo7AYyZsI5lTgiCVwxbAX57OgvCbMiIr51Efztl2HvDhTHKf3y6EZ1cTrT1dVAtkS9Qf5SBTyQ3XcmXRWLedMMQX301ohJ5lwFT8xaxwT8I3y2rPwUtF92AuE9MjUymK1ijaz5yThvMdJoC3ZfABPDdxo_QNm0Y2oYOQOQlP_fiai0_c9lCKR0RlKbscshObzaBaoARifeP1cw-96BA2Q');">
                </div>
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#102216] via-[#102216]/40 to-transparent"></div>
            </div>
            <div class="relative z-10 flex flex-col justify-end p-20 w-full">
                <div class="flex items-center gap-3 mb-8 text-white">
                    <MaterialIcon name="sports_soccer" class="text-[#13ec5b] text-4xl" />
                    <span class="text-2xl font-bold tracking-tight">SportReserve</span>
                </div>
                <h1 class="text-white text-5xl font-black leading-tight tracking-tight mb-4">
                    Reserva tu pasión,<br/>juega sin límites
                </h1>
                <p class="text-white/80 text-lg max-w-md">
                    Accede a la mejor plataforma de gestión de canchas deportivas en tiempo real.
                </p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8 lg:p-12 xl:p-16 bg-[#f6f8f6] dark:bg-[#102216] overflow-y-auto">
            <div class="w-full max-w-[440px] flex flex-col py-8 min-h-full">
                
                <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <!-- Logo for mobile -->
                <div class="lg:hidden flex items-center gap-2 mb-6 text-[#102216] dark:text-white">
                    <MaterialIcon name="sports_soccer" class="text-[#13ec5b] text-3xl" />
                    <span class="text-xl font-bold tracking-tight">SportReserve</span>
                </div>

                <div class="mb-6 lg:mb-8">
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-[#0d1b12] dark:text-white mb-2">Bienvenido de nuevo</h2>
                    <p class="text-sm lg:text-base text-slate-500 dark:text-slate-400">Ingresa tus credenciales para acceder a tu cuenta.</p>
                </div>

                <Form
                    v-bind="store.form()"
                    :reset-on-success="['password']"
                    v-slot="{ errors, processing }"
                    class="flex flex-col gap-5"
                >
                    <!-- Email Field -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#0d1b12] dark:text-white" for="email">Correo Electrónico</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <MaterialIcon name="mail" class="text-slate-400 group-focus-within:text-[#13ec5b] transition-colors" />
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="email"
                                placeholder="ejemplo@correo.com"
                                class="w-full h-12 lg:h-14 pl-12 pr-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-2 focus:ring-[#13ec5b] focus:border-[#13ec5b] text-[#0d1b12] dark:text-white transition-all outline-none"
                            />
                        </div>
                        <InputError :message="errors.email" />
                    </div>

                    <!-- Password Field -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#0d1b12] dark:text-white" for="password">Contraseña</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <MaterialIcon name="lock" class="text-slate-400 group-focus-within:text-[#13ec5b] transition-colors" />
                            </div>
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                :tabindex="2"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full h-12 lg:h-14 pl-12 pr-12 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-2 focus:ring-[#13ec5b] focus:border-[#13ec5b] text-[#0d1b12] dark:text-white transition-all outline-none"
                            />
                            <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors" type="button" tabindex="-1" @click="showPassword = !showPassword">
                                <MaterialIcon :name="showPassword ? 'visibility_off' : 'visibility'" class="" />
                            </button>
                        </div>
                        <InputError :message="errors.password" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between py-1">
                        <label class="flex items-center gap-2 cursor-pointer group" for="remember">
                            <div class="relative">
                                <input id="remember" name="remember" class="peer hidden" type="checkbox" :tabindex="3" />
                                <div class="w-5 h-5 border-2 border-slate-300 dark:border-slate-700 rounded-md peer-checked:bg-[#13ec5b] peer-checked:border-[#13ec5b] flex items-center justify-center transition-all">
                                    <MaterialIcon name="check" class="text-[#0d1b12] text-[16px] hidden peer-checked:block" />
                                </div>
                            </div>
                            <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Recordarme</span>
                        </label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm font-semibold text-[#13ec5b] hover:underline underline-offset-4"
                            :tabindex="5"
                        >
                            ¿Olvidaste tu contraseña?
                        </TextLink>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="processing"
                        :tabindex="4"
                        class="w-full h-12 lg:h-14 mt-2 bg-[#13ec5b] hover:brightness-105 active:scale-[0.98] transition-all text-[#0d1b12] font-bold text-base rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-[#13ec5b]/20 disabled:opacity-50 disabled:cursor-not-allowed"
                        data-test="login-button"
                    >
                        <Spinner v-if="processing" />
                        <span>Iniciar Sesión</span>
                        <MaterialIcon name="arrow_forward" class="" v-if="!processing" />
                    </button>

                    <!-- Divider -->
                    <div class="relative flex items-center py-4">
                        <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
                        <span class="flex-shrink mx-4 text-xs font-medium text-slate-400 uppercase tracking-widest">o continúa con</span>
                        <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
                    </div>

                    <!-- Social Logins -->
                    <div class="grid grid-cols-2 gap-4">
                        <button class="flex items-center justify-center gap-2 h-12 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" type="button">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.23.81-.61z" fill="#FBBC05"></path>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                            </svg>
                            <span class="text-sm font-semibold dark:text-white">Google</span>
                        </button>
                        <button class="flex items-center justify-center gap-2 h-12 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" type="button">
                            <svg class="w-6 h-6 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                            </svg>
                            <span class="text-sm font-semibold dark:text-white">Facebook</span>
                        </button>
                    </div>

                    <!-- Footer Link -->
                    <div class="mt-6 text-center" v-if="canRegister">
                        <p class="text-slate-500 dark:text-slate-400 text-sm">
                            ¿No tienes cuenta? 
                            <TextLink :href="register()" :tabindex="6" class="text-[#13ec5b] font-bold hover:underline underline-offset-4 ml-1">
                                Registrarse gratis
                            </TextLink>
                        </p>
                    </div>
                </Form>

                <!-- Small legal footer -->
                <div class="mt-auto pt-6 flex gap-4 text-[10px] text-slate-400 font-medium uppercase tracking-tighter justify-center">
                    <a class="hover:text-[#13ec5b] transition-colors" href="#">Términos</a>
                    <a class="hover:text-[#13ec5b] transition-colors" href="#">Privacidad</a>
                    <a class="hover:text-[#13ec5b] transition-colors" href="#">Soporte</a>
                </div>
            </div>
        </div>
    </div>
</template>
