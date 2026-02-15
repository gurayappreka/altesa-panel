<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Company;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Projeler';
    protected static ?string $navigationLabel = 'Projeler';
    protected static ?string $modelLabel = 'Proje';
    protected static ?string $pluralModelLabel = 'Projeler';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Proje Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Proje Kodu')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('PRJ-2024-001'),
                        Forms\Components\TextInput::make('name')
                            ->label('Proje Adı')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('company_id')
                            ->label('Müşteri')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('contact_id')
                            ->label('İlgili Kişi')
                            ->relationship('contact', 'name', fn ($query, $get) => 
                                $query->where('company_id', $get('company_id'))
                            )
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Sınıflandırma')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Proje Tipi')
                            ->options([
                                'engineering' => 'Mühendislik',
                                'manufacturing' => 'İmalat',
                                'installation' => 'Kurulum',
                                'service' => 'Servis',
                                'other' => 'Diğer',
                            ])
                            ->default('engineering')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'draft' => 'Taslak',
                                'planning' => 'Planlama',
                                'in_progress' => 'Devam Ediyor',
                                'on_hold' => 'Beklemede',
                                'completed' => 'Tamamlandı',
                                'cancelled' => 'İptal',
                            ])
                            ->default('draft')
                            ->required(),
                        Forms\Components\Select::make('priority')
                            ->label('Öncelik')
                            ->options([
                                'low' => 'Düşük',
                                'medium' => 'Normal',
                                'high' => 'Yüksek',
                                'critical' => 'Kritik',
                            ])
                            ->default('medium'),
                        Forms\Components\Select::make('manager_id')
                            ->label('Proje Yöneticisi')
                            ->relationship('manager', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Tarihler')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Başlangıç Tarihi'),
                        Forms\Components\DatePicker::make('target_date')
                            ->label('Hedef Bitiş'),
                        Forms\Components\DatePicker::make('actual_end_date')
                            ->label('Gerçek Bitiş'),
                    ])->columns(3),

                Forms\Components\Section::make('Bütçe')
                    ->schema([
                        Forms\Components\TextInput::make('budget')
                            ->label('Bütçe')
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('actual_cost')
                            ->label('Gerçekleşen Maliyet')
                            ->numeric()
                            ->prefix('€')
                            ->disabled(),
                        Forms\Components\Select::make('currency')
                            ->label('Para Birimi')
                            ->options([
                                'EUR' => 'EUR',
                                'USD' => 'USD',
                                'TRY' => 'TRY',
                            ])
                            ->default('EUR'),
                        Forms\Components\TextInput::make('progress')
                            ->label('İlerleme %')
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100),
                    ])->columns(4),

                Forms\Components\Section::make('Açıklama')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Açıklama')
                            ->rows(3),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notlar')
                            ->rows(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kod')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Proje Adı')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(40),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Müşteri')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(30),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tip')
                    ->colors([
                        'info' => 'engineering',
                        'warning' => 'manufacturing',
                        'success' => 'installation',
                        'primary' => 'service',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'engineering' => 'Mühendislik',
                        'manufacturing' => 'İmalat',
                        'installation' => 'Kurulum',
                        'service' => 'Servis',
                        default => 'Diğer',
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Durum')
                    ->colors([
                        'secondary' => 'draft',
                        'info' => 'planning',
                        'warning' => 'in_progress',
                        'danger' => 'on_hold',
                        'success' => 'completed',
                        'gray' => 'cancelled',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'draft' => 'Taslak',
                        'planning' => 'Planlama',
                        'in_progress' => 'Devam',
                        'on_hold' => 'Beklemede',
                        'completed' => 'Tamamlandı',
                        'cancelled' => 'İptal',
                    }),
                Tables\Columns\TextColumn::make('progress')
                    ->label('İlerleme')
                    ->suffix('%')
                    ->sortable()
                    ->color(fn ($state) => match(true) {
                        $state >= 100 => 'success',
                        $state >= 50 => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('manager.name')
                    ->label('Yönetici')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('target_date')
                    ->label('Hedef')
                    ->date('d.m.Y')
                    ->sortable()
                    ->color(fn ($record) => $record->is_overdue ? 'danger' : null),
                Tables\Columns\TextColumn::make('budget')
                    ->label('Bütçe')
                    ->money(fn ($record) => $record->currency ?? 'EUR')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->multiple()
                    ->options([
                        'draft' => 'Taslak',
                        'planning' => 'Planlama',
                        'in_progress' => 'Devam Ediyor',
                        'on_hold' => 'Beklemede',
                        'completed' => 'Tamamlandı',
                        'cancelled' => 'İptal',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tip')
                    ->options([
                        'engineering' => 'Mühendislik',
                        'manufacturing' => 'İmalat',
                        'installation' => 'Kurulum',
                        'service' => 'Servis',
                    ]),
                Tables\Filters\SelectFilter::make('manager_id')
                    ->label('Yönetici')
                    ->relationship('manager', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // PhasesRelationManager::class,
            // TasksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['code', 'name', 'company.name'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'in_progress')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
