declare global {
    interface Window {
        axios: any;
    }
}

import type { User, Role } from './auth';

export interface Region {
    id: number;
    nombre: string;
}

export interface Ciudad {
    id: number;
    nombre: string;
    region_id: number;
}

export interface Distrito {
    id: number;
    nombre: string;
    ciudad_id: number;
}

export interface CentroDeportivo {
    id: number;
    nombre: string;
    descripcion: string;
    direccion: string;
    telefono: string;
    email: string;
    user_id: number;
    region_id: number;
    ciudad_id: number;
    distrito_id: number;
    user: User;
    region: Region;
    ciudad: Ciudad;
    distrito: Distrito;
    canchas: Cancha[];
}

export interface Deporte {
    id: number;
    nombre: string;
}

export interface TipoCancha {
    id: number;
    nombre: string;
}

export interface Cancha {
    id: number;
    nombre: string;
    descripcion: string;
    precio_por_bloque: number;
    max_bloques_reserva: number;
    centro_deportivo_id: number;
    centro_deportivo: CentroDeportivo;
    tipos: TipoCancha[];
    deportes: Deporte[];
}

export interface HorarioSlot {
    id: number;
    cancha_id: number;
    fecha: string;
    hora_inicio: string;
    hora_fin: string;
    estado: 'libre' | 'reservado' | 'bloqueado';
}

export interface Reserva {
    id: number;
    user_id: number;
    cancha_id: number;
    fecha: string;
    total: number;
    estado: 'pendiente' | 'confirmada' | 'cancelada';
    created_at: string;
    updated_at: string;
    user: User;
    cancha: Cancha;
    slots: HorarioSlot[];
}
