
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
            'action'=>action('Back\TerritoryController@updateTown',$place->id),
            'placeholder'=>ucfirst($place->nom),
            'parent'=>$parent,
            'value'=>$place,
            'pl'=>$place->departement_id
        ])

    </div>
