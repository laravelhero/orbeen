<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Trix;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Laravel\Nova\Http\Requests\NovaRequest;

class Lead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Lead';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'website';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'lead_id', 'user_id', 'created_at', 'da', 'email', 'website'
    ];

    public function title()
    {
        return 'Website: ' . $this->website . ' - DA: ' . $this->da;
    }

    public function subtitle()
    {
        return 'Email: ' . $this->email . ' - Date: ' . $this->created_at;
    }
    /*you can see only your created post*/
    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     return $query->where('user_id', $request->user()->id);
    // }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()
                ->hideFromIndex(),

            Text::make('Lead ID', 'lead_id')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:leads,lead_id')
                ->updateRules('unique:leads,email,{{resourceId}}'),

            BelongsTo::make('Author', 'user', 'App\Nova\User')
                ->sortable()
                ->rules('required', 'max:255'),


            DateTime::make('Date', 'created_at')
                ->withMeta([
                    'value' => now()->format('Y-m-d H:i:s')
                ])
                ->hideWhenCreating()
                ->hideFromIndex(),

            Text::make('Website')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:leads,email')
                ->updateRules('unique:leads,email,{{resourceId}}'),

            Text::make('DA', 'da')
                ->sortable()
                ->rules('required', 'max:255'),

            Trix::make('Note')
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
