<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class LineItem extends Repeatable
{
    /**  
     * The underlying model the repeatable represents. 
     * 
     * @var class-string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the repeatable.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::hidden(),

            Text::make('Name')->required(),

            Currency::make('Price')
                ->min(1)
                ->step(0.01)
                ->fullWidth()
                ->rules('required', 'numeric', 'gt:cost'),

            Currency::make('Cost')
                ->min(1)
                ->step(0.01)
                ->fullWidth()
                ->rules('required', 'numeric', 'lt:price'),
        ];
    }
}
