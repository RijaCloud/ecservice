<ul class="list-group" id="group">
    @if(count($thatPlace) != 0)
        @foreach($thatPlace as $p)
            <li class="list-group-item shade-list marked" data-lng="{{ isset($p->longitude) ? $p->longitude : $p->lieu['longitude']}}" data-lat="{{ isset($p->latitude) ? $p->latitude : $p->lieu['latitude']}}" data-name="{{ isset($p->string_lieu) ? $p->string_lieu : $p->lieu['string_lieu']}}">
                <div class="group-content">
                    <h5><strong>{{ (isset($p->string_lieu)) ? $p->string_lieu : $p->lieu['string_lieu'] }}</strong> </h5>
                    <span class="content-address"></span>
                    <div class="clearfix"></div>
                    <p itemscope class="content-details">
                        {{ (isset($p->description)) ? $p->description : $p->lieu['description'] }}
                    </p>
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