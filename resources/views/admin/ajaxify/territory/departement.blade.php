
<div class="content-wrapper">

    @include('admin.content-header', [

        'title'=>'Departement',
        'link'=>[

            ['name'=>'Acceuil','url'=>route('admin.index')],
            ['name'=>'Region']
        ]

    ])
    @include('admin.map-template', [
                'title'=>'Departement',
                'action'=>action('Back\TerritoryController@createDepartement'),
                'placeholder'=>'Departement',
                'parent'=>$parent,
                'appart'=>'Region'
            ])
</div>
