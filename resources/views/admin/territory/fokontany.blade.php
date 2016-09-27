@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>'Fokontany',
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],

                ['name'=>'Fokontany']
            ]

        ])
        @include('admin.map-template', [
            'title'=>'Fokontany',
            'function'=>'Fokontany',
            'action'=>action('Back\TerritoryController@createFokontany'),
            'placeholder'=>'Fokontany',
            'parent'=>$parent,
            'appart'=>'Commune'
        ])

    </div>



    @endsection
