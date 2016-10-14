@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>'District',
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],

                ['name'=>'District']
            ]

        ])

        @include('admin.map-template', [
            'title'=>'District',
            'function'=>'District',
            'action'=>action('Back\TerritoryController@createDistrict'),
            'placeholder'=>'District',
            'parent'=>$parent,
            'appart'=>'Region'
        ])

    </div>

@endsection
