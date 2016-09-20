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
                'action'=>action('Back\TerritoryController@createFokontany'),
                'placeholder'=>'Fokontany',
                'parent'=>$parent,
                'appart'=>'Commune'
            ])

</div>

