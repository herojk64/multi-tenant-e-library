<?php

namespace App\Filament\TenantAdmin\Resources\SettingsResource\Pages;

use App\Filament\TenantAdmin\Resources\SettingsResource;
use App\Models\Settings;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Notification;

class SettingsPage extends Page
{
    protected static string $resource = SettingsResource::class;

    protected static string $view = 'filament.tenant-admin.resources.settings-resource.pages.settings-page';

    public $site_name;
    public $contact_email;
    public $contact_number;

    public function mount(): void
    {
        // Load existing settings and set them as component properties
        $settings = Settings::all()->keyBy('key');

        $this->site_name = $settings->get('site_name')->value ?? '';
        $this->contact_email = $settings->get('contact_email')->value ?? '';
        $this->contact_number = $settings->get('contact_number')->value ?? '';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Information')
                ->columns([
                    'sm' => 2,
                    'xl' => 2,
                    '2xl' => 8,
                ])
                ->schema([

            TextInput::make('site_name')
                ->label('Site Name')
                ->default($this->site_name)
                ->required()
                ->columnSpan('full'),

            TextInput::make('contact_email')
                ->label('Contact Email')
                ->default($this->contact_email)
                ->required()
                ->columnSpan('full'),

            TextInput::make('contact_number')
                ->label('Contact Number')
                ->default($this->contact_number)
                ->required()
                ->columnSpan('full'),
                    ])
        ];
    }

    protected function getActions(): array
    {
        return [
            ButtonAction::make('save')
                ->label('Save Settings')
                ->action('saveSettings')
                ->color('success'),
        ];
    }

    public function saveSettings(): void
    {
        // Save each setting by key
        Settings::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => $this->site_name]
        );

        Settings::updateOrCreate(
            ['key' => 'contact_email'],
            ['value' => $this->contact_email]
        );

        Settings::updateOrCreate(
            ['key' => 'contact_number'],
            ['value' => $this->contact_number]
        );

    }
}
