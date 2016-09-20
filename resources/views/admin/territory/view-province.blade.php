@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>ucfirst($place->nom),
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>ucfirst($place->nom)]
            ]

        ])

        @include('admin.map-crud-template', [
            'title'=>ucfirst($place->nom),
            'action'=>action('Back\TerritoryController@updateProvince',$place->id),
            'placeholder'=>ucfirst($place->nom),
            'value'=>$place,
            'parent'=>[],
        ])

    </div>

@endsection
