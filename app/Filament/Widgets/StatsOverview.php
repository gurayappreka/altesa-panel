<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $projectCount = 0;
        $companyCount = 0;

        try {
            $projectCount = Project::where('status', 'in_progress')->count();
        } catch (\Exception $e) {}

        try {
            $companyCount = Company::where('type', 'customer')->where('status', 'active')->count();
        } catch (\Exception $e) {}

        return [
            Stat::make('Aktif Projeler', $projectCount)
                ->description('Devam eden projeler')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),

            Stat::make('Müşteriler', $companyCount)
                ->description('Aktif müşteri sayısı')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('success'),

            Stat::make('Kullanıcılar', \App\Models\User::count())
                ->description('Toplam kullanıcı')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
