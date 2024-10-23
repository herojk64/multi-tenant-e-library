<?php

namespace App\Filament\TenantAdmin\Widgets;

use App\Models\Books;
use Filament\Widgets\ChartWidget;

class PopularBookWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected array $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];


    protected function getData(): array
    {
        $books = Books::with('rating')
            ->select('books.*')
            ->get();

// Prepare data for the chart using the bayesianRating
        return [
            'datasets' => [
                [
                    'data' => $books->map(fn($book) => $book->bayesianRating())->toArray(),
                    'backgroundColor' => $books->map(fn($book,$ind) => $this->colors[$ind])->toArray(),
                ],
            ],
            'labels' => $books->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
