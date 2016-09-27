@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>'Region',
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],

                ['name'=>'Region']
            ]

        ])
        @include('admin.map-template', [
            'title'=>'Region',
            'function'=>'country',
            'action'=>action('Back\TerritoryController@createCountry'),
            'placeholder'=>'Region',
            'parent'=>$parent,
            'appart'=>'Province'
        ])


    </div>




    @endsection
