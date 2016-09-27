@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>ucfirst($place->nom),
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Departement','url'=>route('territory.allDepartement')],
                ['name'=>ucfirst($place->nom)]
            ]

        ])

        @include('admin.map-crud-template', [
            'title'=>ucfirst($place->nom),
            'action'=>action('Back\TerritoryController@updateDepartement',$place->id),
            'placeholder'=>ucfirst($place->nom),
            'parent'=>$parent,
            'value'=>$place,
            'pl'=>$place->region_id,
            'appart'=>'Region'
        ])

    </div>

@endsection