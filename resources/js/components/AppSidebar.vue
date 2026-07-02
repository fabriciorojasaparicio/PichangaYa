<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { CalendarCheck, MapPinned, LayoutGrid, Calendar, Map, List, FileText, Home } from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import * as propietarioRoutes from '@/routes/propietario';
import * as adminRoutes from '@/routes/admin';
import type { NavItem } from '@/types';

const page = usePage();

const userRole = computed(() => page.props.auth?.user?.role?.nombre ?? undefined);
const dashboardUrl = computed(() => {
    if (userRole.value === 'propietario') {
        return propietarioRoutes.dashboard().url;
    }

    if (userRole.value === 'admin') {
        return adminRoutes.dashboard().url;
    }

    return dashboard().url;
});

const mainNavItems = computed<NavItem[]>(() => {
    if (userRole.value === 'propietario') {
        return [
            { title: 'Inicio', href: '/propietario/dashboard', icon: Home },
            { title: 'Agenda', href: '/propietario/agenda', icon: Calendar },
            { title: 'Mis Centros', href: '/propietario/centros', icon: Map },
            { title: 'Centro Canchas', href: '/propietario/canchas', icon: List },
            { title: 'Reportes', href: '/propietario/reportes', icon: FileText },
        ];
    } else if (userRole.value === 'admin') {
        return [
            { title: 'Dashboard', href: '/admin', icon: LayoutGrid },
            // Add other admin routes here later
        ];
    }

    // Default to cliente
    return [
        { title: 'Dashboard', href: dashboardUrl.value, icon: LayoutGrid },
        { title: 'Centros', href: '/centros', icon: MapPinned },
    ];
});

const footerNavItems: NavItem[] = [
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboardUrl">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
