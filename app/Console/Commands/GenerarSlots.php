<?php

namespace App\Console\Commands;

use App\Models\Cancha;
use App\Models\HorarioConfig;
use App\Models\HorarioSlot;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GenerarSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generar-slots {--days=30 : Número de días desde hoy para generar slots}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera automáticamente slots de 30 minutos para todas las canchas según horarios configurados y evita duplicados.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays((int) $this->option('days'));

        $createdSlots = 0;
        $processedCanchas = 0;

        Cancha::chunkById(100, function (Collection $canchas) use ($startDate, $endDate, &$createdSlots, &$processedCanchas) {
            $canchaIds = $canchas->pluck('id');

            $configsByCancha = HorarioConfig::whereIn('cancha_id', $canchaIds)
                ->where('activo', true)
                ->orderBy('cancha_id')
                ->orderBy('dia_semana')
                ->orderBy('hora_inicio')
                ->get()
                ->groupBy('cancha_id');

            foreach ($canchas as $cancha) {
                $dayConfigs = $configsByCancha->get($cancha->id, collect());

                if ($dayConfigs->isEmpty()) {
                    continue;
                }

                $processedCanchas++;

                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    $weekday = $date->dayOfWeek;
                    $possibleWeekdays = [$weekday];

                    if ($weekday === 0) {
                        $possibleWeekdays[] = 7;
                    }

                    $dailyConfigs = collect();
                    foreach ($possibleWeekdays as $possibleWeekday) {
                        $dailyConfigs = $dailyConfigs->merge($dayConfigs->where('dia_semana', $possibleWeekday));
                    }

                    if ($dailyConfigs->isEmpty()) {
                        continue;
                    }

                    foreach ($dailyConfigs as $config) {
                        $slotStart = $date->copy()->setTimeFromTimeString($config->hora_inicio);
                        $slotEndLimit = $date->copy()->setTimeFromTimeString($config->hora_fin);

                        if ($slotStart->gte($slotEndLimit)) {
                            continue;
                        }

                        while ($slotStart->lt($slotEndLimit)) {
                            $slotFinish = $slotStart->copy()->addMinutes(30);

                            if ($slotFinish->gt($slotEndLimit)) {
                                break;
                            }

                            $slot = HorarioSlot::firstOrCreate([
                                'cancha_id' => $cancha->id,
                                'fecha' => $date->toDateString(),
                                'hora_inicio' => $slotStart->format('H:i:s'),
                            ], [
                                'hora_fin' => $slotFinish->format('H:i:s'),
                                'estado' => 'libre',
                            ]);

                            if ($slot->wasRecentlyCreated) {
                                $createdSlots++;
                            }

                            $slotStart->addMinutes(30);
                        }
                    }
                }
            }
        });

        $this->info(sprintf(
            'Slots generados correctamente: %d slot(s) creados. Canchas procesadas: %d. Rango: %s - %s.',
            $createdSlots,
            $processedCanchas,
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d')
        ));

        return 0;
    }
}
