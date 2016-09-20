<div class="content-wrapper">

    @include('admin.content-header', [

        'title'=>'Commune',
        'link'=>[

            ['name'=>'Acceuil','url'=>route('admin.index')],
            ['name'=>'Commune']
        ]

    ])

    @include('admin.map-template', [
                'title'=>'Commune',
                'action'=>action('Back\TerritoryController@createTown'),
                'placeholder'=>'Town',
                'parent'=>$parent,
                'appart'=>'Departement'
    ])

</div>
