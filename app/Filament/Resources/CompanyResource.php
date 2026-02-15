<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $navigationLabel = 'Firmalar';
    protected static ?string $modelLabel = 'Firma';
    protected static ?string $pluralModelLabel = 'Firmalar';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Firma Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Firma Kodu')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('name')
                            ->label('Firma Adı')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('trade_name')
                            ->label('Ticari Unvan')
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('Tip')
                            ->options([
                                'customer' => 'Müşteri',
                                'supplier' => 'Tedarikçi',
                                'both' => 'Müşteri & Tedarikçi',
                            ])
                            ->default('customer')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Vergi Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('tax_office')
                            ->label('Vergi Dairesi')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('tax_number')
                            ->label('Vergi No')
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('İletişim')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefon')
                            ->tel(),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta')
                            ->email(),
                        Forms\Components\TextInput::make('website')
                            ->label('Website')
                            ->url(),
                        Forms\Components\TextInput::make('sector')
                            ->label('Sektör'),
                    ])->columns(2),

                Forms\Components\Section::make('Adres')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label('Adres')
                            ->rows(2),
                        Forms\Components\TextInput::make('city')
                            ->label('Şehir'),
                        Forms\Components\TextInput::make('country')
                            ->label('Ülke')
                            ->default('Türkiye'),
                    ])->columns(3),

                Forms\Components\Section::make('Finansal')
                    ->schema([
                        Forms\Components\TextInput::make('credit_limit')
                            ->label('Kredi Limiti')
                            ->numeric()
                            ->prefix('₺'),
                        Forms\Components\Select::make('currency')
                            ->label('Para Birimi')
                            ->options([
                                'TRY' => 'TRY - Türk Lirası',
                                'EUR' => 'EUR - Euro',
                                'USD' => 'USD - Amerikan Doları',
                                'GBP' => 'GBP - İngiliz Sterlini',
                            ])
                            ->default('TRY'),
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Pasif',
                                'blocked' => 'Blokeli',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Notlar')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Notlar')
                            ->rows(3),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Firma Adı')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tip')
                    ->colors([
                        'primary' => 'customer',
                        'warning' => 'supplier',
                        'success' => 'both',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'customer' => 'Müşteri',
                        'supplier' => 'Tedarikçi',
                        'both' => 'Her İkisi',
                    }),
                Tables\Columns\TextColumn::make('city')
                    ->label('Şehir')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('Ülke')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('projects_count')
                    ->label('Projeler')
                    ->counts('projects')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Durum')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'danger' => 'blocked',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'active' => 'Aktif',
                        'inactive' => 'Pasif',
                        'blocked' => 'Blokeli',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tip')
                    ->options([
                        'customer' => 'Müşteri',
                        'supplier' => 'Tedarikçi',
                        'both' => 'Her İkisi',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Pasif',
                        'blocked' => 'Blokeli',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // ContactsRelationManager::class,
            // ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
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
        return ['code', 'name', 'trade_name', 'tax_number'];
    }
}
