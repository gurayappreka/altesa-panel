<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Project;
use App\Models\Installation;
use App\Models\ServiceTicket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Aktif Projeler', Project::where('status', 'in_progress')->count())
                ->description('Devam eden projeler')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Müşteriler', Company::customers()->active()->count())
                ->description('Aktif müşteri sayısı')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('success'),

            Stat::make('Saha Kurulumları', Installation::active()->count())
                ->description('Devam eden kurulumlar')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info'),

            Stat::make('Açık Talepler', ServiceTicket::whereNotIn('status', ['closed', 'cancelled'])->count())
                ->description('Bekleyen servis talepleri')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('danger'),
        ];
    }
}
