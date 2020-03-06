<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class FinalLead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\FinalLead';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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

            Text::make('FL ID', 'fl_id')
                ->sortable()
                ->rules('max:255', 'required'),

            Text::make('Project Name', 'project_name')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Project ID', 'project_id')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Website URL', 'website')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('DA', 'da')->min(1)->max(99)->step(01)
                ->sortable()
                ->rules('required'),

            Number::make('Editorial Fee', 'editorial_fee')
                ->min(1)->max(10000)->step(0.10000)
                ->sortable()
                ->rules('required'),

            Text::make('Condition', 'condition')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:final_leads,email')
                ->updateRules('unique:final_leads,email,{{resourceId}}'),

            Text::make('Link Insert Fee', 'link_insert_fee')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Category', 'category')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsToMany::make('Tags'),


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
        return [];
    }
}
