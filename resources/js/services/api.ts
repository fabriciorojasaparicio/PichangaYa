import axios from 'axios';
import type { CentroDeportivo, Cancha, HorarioSlot, Reserva } from '@/types/reservas';

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
});

// Add CSRF token to requests
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    api.defaults.headers.common['X-CSRF-TOKEN'] = (token as HTMLMetaElement).content;
}

export const centrosApi = {
    getAll: () => api.get<CentroDeportivo[]>('/centros'),
    getById: (id: number) => api.get<CentroDeportivo>(`/centros/${id}`),
};

export const canchasApi = {
    getById: (id: number) => api.get<Cancha>(`/canchas/${id}`),
    getSlots: (id: number, fecha: string) => api.get<HorarioSlot[]>(`/canchas/${id}/slots`, { params: { fecha } }),
};

export const reservasApi = {
    create: (data: { cancha_id: number; slots: number[] }) => api.post('/reservar', data),
    getMyReservations: () => api.get<Reserva[]>('/mis-reservas'),
};

export default api;
