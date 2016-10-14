<ul class="list-group" id="group">
    @if(count($place) != 0)
        @foreach($place as $p)
            <li class="list-group-item shade-list marked" data-id="{{ $p->id }}" data-lng="{{ isset($p->longitude) ? $p->longitude : $p->lieu['longitude']}}" data-lat="{{ isset($p->latitude) ? $p->latitude : $p->lieu['latitude']}}" data-name="{{ isset($p->string_lieu) ? $p->string_lieu : $p->lieu['string_lieu']}}">
                <div class="group-content">
                    <h5><strong>{{ (isset($p->string_lieu)) ? $p->string_lieu : $p->lieu['string_lieu'] }}</strong> </h5>
                    <span class="content-address"></span>
                    <div class="clearfix"></div>
                    <p itemscope class="content-details">
                        {{ (isset($p->description)) ? $p->description : $p->lieu['description'] }}
                    </p>
                    <div class="listicon">
                        <ul>
                            <li @if(!$p->garage) display="none" @endif> <img src="{{ asset('img/garage2.png') }}" alt="Garage"> </li>
                            <li @if(!$p->personnalisation) display="none" @endif> <img src="{{ asset('img/repair.png') }}" alt="Tunning"> </li>
                            <li @if(!$p->accessoires) display="none" @endif> <img src="{{ asset('img/repair.png') }}" alt="Vendeur Accessoires"> </li>
                            <li @if(!$p->pieces) display="none" @endif> <img src="{{ asset('img/repair.png') }}" alt="Vendeur Pieces"> </li>
                            <li @if(!$p->vente_moto) display="none" @endif> <img src="{{ asset('img/bike2.png') }}" alt="Vendeur Moto"> </li>
                            <li @if(!$p->huiles) display="none" @endif> <img src="{{ asset('img/oil.png') }}" alt="Vendeur Huiles"> </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endforeach
    @else
        <li class="list-group-item shade-list">
            <div class="group-content">
                Aucun résultat
            </div>
        </li>
    @endif
</ul>