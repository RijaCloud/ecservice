
<div class="content-wrapper">

    @include('admin.content-header', [

        'title'=>'Province',
        'link'=>[

            ['name'=>'Acceuil','url'=>route('admin.index')],
            ['name'=>'Province']
        ]

    ])

    @include('admin.map-template', [
        'title'=>'Province',
        'action'=>action('Back\TerritoryController@createProvince'),
        'placeholder'=>'Province',
        'parent'=>[]
    ])

</div>
