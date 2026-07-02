<script setup lang="ts">
import MaterialIcon from '@/components/MaterialIcon.vue';
import { ref } from 'vue';
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineOptions({
    layout: null as unknown as undefined,
});

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
</script>

<template>
    <Head title="Register" />

    <div class="flex min-h-screen w-full flex-col lg:flex-row overflow-hidden bg-[#f6f8f6] dark:bg-[#102216]">
        <!-- Left Side: Sports Lifestyle Image -->
        <div class="relative hidden lg:flex lg:w-1/2 xl:w-7/12 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCpzpbooXb6QFUKhXKqS9wtxpi1OpwlJLPEALBzePU-ugB2F3Pq1BD42x3Vjbmw0AnKh2bVXzWbQ2im8qtAyG5LHVx1cZdmEzEFaQKT7dtnQD33KQahtvX4xdKd3EU7YFa1YWYtgOzpqYGVl8V2t_-FJ-qSe0nWgh0WvdaM0axXp3h04sK3QYqHlw7e3DDIFWEGhuuBkI0i1GM9cmF6lYqrC-r_osdqfk17N4_l8RfGWqFphX7Kw-GkSAneo_JiMNCi7G-l9UlNQPHH");'>
            <div class="absolute inset-0 bg-gradient-to-r from-[#102216]/80 to-transparent flex flex-col justify-end p-20">
                <div class="flex items-center gap-3 mb-6 text-[#13ec5b]">
                    <MaterialIcon name="sports_soccer" class="text-4xl" />
                    <h2 class="text-3xl font-black tracking-tighter">SportCourt</h2>
                </div>
                <h1 class="text-white text-5xl font-black leading-tight max-w-lg mb-4">La cancha que buscas, a un clic de distancia.</h1>
                <p class="text-white/80 text-lg max-w-md font-light">Únete a la mayor red de deportistas y complejos deportivos de la ciudad. Reserva, juega y compite.</p>
            </div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="flex-1 flex flex-col items-center justify-center p-6 sm:p-8 lg:p-12 xl:p-16 bg-[#f6f8f6] dark:bg-[#102216] overflow-y-auto custom-scrollbar">
            <div class="w-full max-w-[480px] space-y-6 lg:space-y-8 py-8 min-h-full">
                <!-- Header Mobile -->
                <div class="flex items-center gap-2 lg:hidden mb-6">
                    <MaterialIcon name="sports_soccer" class="text-[#13ec5b] text-3xl" />
                    <h2 class="text-[#0d1b12] dark:text-white text-xl font-bold tracking-tight">SportCourt</h2>
                </div>
                <div class="space-y-2">
                    <h2 class="text-[#0d1b12] dark:text-white text-3xl lg:text-4xl font-black leading-tight tracking-tight">Crear Nueva Cuenta</h2>
                    <p class="text-[#4c9a66] dark:text-[#13ec5b]/70 text-sm lg:text-base font-normal">Únete a la mayor comunidad deportiva de la región.</p>
                </div>

                <!-- Registration Form -->
                <Form
                    v-bind="store.form()"
                    :reset-on-success="['password', 'password_confirmation']"
                    v-slot="{ errors, processing }"
                    class="space-y-5"
                >
                    <div class="grid grid-cols-1 gap-5">
                        <div class="space-y-2">
                            <label for="name" class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold ml-1">Nombre Completo</label>
                            <div class="relative group">
                                <MaterialIcon name="person" class="absolute left-4 top-1/2 -translate-y-1/2 text-[#4c9a66] dark:text-white/40 group-focus-within:text-[#13ec5b] transition-colors" />
                                <input id="name" name="name" class="w-full h-12 lg:h-14 pl-12 pr-4 rounded-xl border border-[#cfe7d7] dark:border-white/10 bg-white dark:bg-white/5 text-[#0d1b12] dark:text-white focus:ring-2 focus:ring-[#13ec5b] focus:border-transparent transition-all outline-none" placeholder="Ej. Juan Pérez" type="text" required autofocus :tabindex="1" autocomplete="name"/>
                            </div>
                            <InputError :message="errors.name" />
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold ml-1">Correo Electrónico</label>
                            <div class="relative group">
                                <MaterialIcon name="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-[#4c9a66] dark:text-white/40 group-focus-within:text-[#13ec5b] transition-colors" />
                                <input id="email" name="email" class="w-full h-12 lg:h-14 pl-12 pr-4 rounded-xl border border-[#cfe7d7] dark:border-white/10 bg-white dark:bg-white/5 text-[#0d1b12] dark:text-white focus:ring-2 focus:ring-[#13ec5b] focus:border-transparent transition-all outline-none" placeholder="correo@ejemplo.com" type="email" required :tabindex="2" autocomplete="email"/>
                            </div>
                            <InputError :message="errors.email" />
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold ml-1">Contraseña</label>
                            <div class="relative group">
                                <MaterialIcon name="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-[#4c9a66] dark:text-white/40 group-focus-within:text-[#13ec5b] transition-colors" />
                                <input id="password" name="password" class="w-full h-12 lg:h-14 pl-12 pr-12 rounded-xl border border-[#cfe7d7] dark:border-white/10 bg-white dark:bg-white/5 text-[#0d1b12] dark:text-white focus:ring-2 focus:ring-[#13ec5b] focus:border-transparent transition-all outline-none" placeholder="••••••••" :type="showPassword ? 'text' : 'password'" required :tabindex="3" autocomplete="new-password"/>
                                <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#4c9a66] dark:text-white/40 hover:text-slate-600 transition-colors" type="button" tabindex="-1" @click="showPassword = !showPassword">
                                    <MaterialIcon :name="showPassword ? 'visibility_off' : 'visibility'" class="" />
                                </button>
                            </div>
                            <InputError :message="errors.password" />
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold ml-1">Confirmar Contraseña</label>
                            <div class="relative group">
                                <MaterialIcon name="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-[#4c9a66] dark:text-white/40 group-focus-within:text-[#13ec5b] transition-colors" />
                                <input id="password_confirmation" name="password_confirmation" class="w-full h-12 lg:h-14 pl-12 pr-12 rounded-xl border border-[#cfe7d7] dark:border-white/10 bg-white dark:bg-white/5 text-[#0d1b12] dark:text-white focus:ring-2 focus:ring-[#13ec5b] focus:border-transparent transition-all outline-none" placeholder="••••••••" :type="showPasswordConfirmation ? 'text' : 'password'" required :tabindex="4" autocomplete="new-password"/>
                                <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#4c9a66] dark:text-white/40 hover:text-slate-600 transition-colors" type="button" tabindex="-1" @click="showPasswordConfirmation = !showPasswordConfirmation">
                                    <MaterialIcon :name="showPasswordConfirmation ? 'visibility_off' : 'visibility'" class="" />
                                </button>
                            </div>
                            <InputError :message="errors.password_confirmation" />
                        </div>
                    </div>
                    <div class="pt-2 lg:pt-4">
                        <button type="submit" :disabled="processing" :tabindex="5" data-test="register-user-button" class="w-full h-12 lg:h-14 bg-[#13ec5b] hover:bg-[#13ec5b]/90 text-[#0d1b12] font-black rounded-xl shadow-lg shadow-[#13ec5b]/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                            <Spinner v-if="processing" />
                            <span>Crear Cuenta</span>
                            <MaterialIcon name="arrow_forward" class="" v-if="!processing" />
                        </button>
                    </div>
                </Form>
                
                <div class="text-center pt-2">
                    <p class="text-[#4c9a66] dark:text-white/60 text-sm">
                        ¿Ya tienes cuenta? 
                        <TextLink :href="login()" :tabindex="6" class="text-[#0d1b12] dark:text-[#13ec5b] font-bold hover:underline ml-1">Inicia sesión</TextLink>
                    </p>
                </div>

                <div class="flex items-center gap-4 py-4">
                    <div class="h-px flex-1 bg-[#cfe7d7] dark:bg-white/10"></div>
                    <span class="text-xs uppercase font-bold text-[#4c9a66] dark:text-white/40 tracking-widest">O continúa con</span>
                    <div class="h-px flex-1 bg-[#cfe7d7] dark:bg-white/10"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 h-12 rounded-xl border border-[#cfe7d7] dark:border-white/10 hover:bg-[#e7f3eb] dark:hover:bg-white/5 transition-colors">
                        <img alt="Google Logo" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2CWsx2ElEAZk4p_jAdTictCkkWrwYKoMkUAApAZ_-qraalH30q2K6I1ESuxE56KCIAs5s3mkiv0Non7o8GOt5jXXUHAOQ6rXTJta6WnsKNx0j9rVRbAOmH7PInGWoCgesXg1k2DlsbaxmIpNKgXx7aKpD0IPcBllDGKNaLUfZroekEcX6lMP6Y5ABGoYgqi0nQrhXSr3fmidHnKtsFcQ9WEiCw7rwhkjir39lPardEiswdPk0s-8gbZjeMaqQMGfRLtauukQseUr9"/>
                        <span class="text-sm font-semibold">Google</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 h-12 rounded-xl border border-[#cfe7d7] dark:border-white/10 hover:bg-[#e7f3eb] dark:hover:bg-white/5 transition-colors">
                        <img alt="Facebook Logo" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjqj_PO6t0dZKoCi6VS5Q04ED1-8HACn8jFJqg0Fl_vXMNtLoNKv0b_FbJmckdnC1AjHOj8h8OfPhWVasbiVHeRlU1qzUClPfnv0xGM6EZjIsQ_41wvdZjNjBHVHkNI4Qk2pMt0sD8wGeeTNs-Bv2Zs3BKIg2B4b7_mJ640nLm5dQr097yFTrF1nLTp4OYfi3vg5z909niCvZMMQawYmkqOMFWhNjXJ_rYKryy9bOXXN_vzitCyyghslO35rR5ZS8ToxziJ7bq0cYm"/>
                        <span class="text-sm font-semibold">Facebook</span>
                    </button>
                </div>

                <!-- Footer Small Legal -->
                <div class="mt-12 mx-auto text-center text-[#4c9a66] dark:text-white/30 text-[10px] max-w-xs leading-relaxed">
                    Al registrarte, aceptas nuestros <a class="underline hover:text-[#13ec5b] transition-colors" href="#">Términos de Servicio</a> y <a class="underline hover:text-[#13ec5b] transition-colors" href="#">Política de Privacidad</a>.
                </div>
            </div>
        </div>
    </div>
</template>
