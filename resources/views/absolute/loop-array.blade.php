<ul class="list-group" id="group">
    <?php $counter = 0 ?>
    @if(count($place) != 0)
        @foreach($place as $p)

            <li class="list-group-item shade-list marked"
                data-id="{{ $p->id }}"
                data-lng="{{ isset($p->longitude) ? $p->longitude : $p->lieu['longitude']}}"
                data-lat="{{ isset($p->latitude) ? $p->latitude : $p->lieu['latitude']}}"
                data-name="{{ isset($p->string_lieu) ? $p->string_lieu : $p->lieu['string_lieu']}}"
                data-tel="{{ isset($p->telephone) ? $p->telephone : $p->lieu['telephone']}}"
                data-address="{{ isset($p->address) ? $p->address : $p->lieu['address']}}"
                data-img=" <?php  $img = (isset($p->string_lieu)) ? $p->string_lieu : $p->lieu['string_lieu'] ?>
            <?php if(file_exists(public_path('infoImage/'.$img.'medium.png'))): ?>
                    {{ asset('infoImage/'.$img.'small.png') }}
            <?php else:?>
                    {{ asset('img/default.png') }}
            <?php endif; ?>
            ">
                <div class="group-content">
                    <h4 ><strong>{{ (isset($p->string_lieu)) ? $p->string_lieu : $p->lieu['string_lieu'] }}</strong> </h4>
                     <?php if($p->address || $p->lieu['address']): ?> <span  class="content-address"><h5>Adresse:</h5>   <strong>{{ (isset($p->address)) ? "".$p->address.""   : "".$p->lieu['address']."" }}</strong> </span> <?php endif; ?>
                     <?php if($p->telephone || $p->lieu['telephone'] || !is_null($p->telephone) || !is_null($p->lieu['telephone']) ): ?>   <span  class="content-telephone"><h5>Contact:</h5>  <strong>{{ (isset($p->telephone)) ? "".$p->telephone.""   : "".$p->lieu['telephone']."" }}</strong> </span> <?php endif; ?>
                    <div class="clearfix"></div>
                    <div itemscope class="content-details row">
                    <div class="col-md-8">
                        <h5>Description:</h5>
                        <p class="">
                            {{ (isset($p->description)) ? $p->description : $p->lieu['description'] }}
                        </p>
                        <div class="listicon">
                            <h5>Details:</h5>
                            <ul>
                                <li @if($p->garage === 0 ) class="hidden" @endif> <img src="{{ asset('img/car-shed.png') }}" alt="Garage"> </li>
                                <li @if($p->personnalisation === 0 ) class="hidden" @endif> <img src="{{ asset('img/hammer-and-wrench.png') }}" alt="Tunning"> </li>
                                <li @if($p->accessoires === 0 ) class="hidden" @endif> <img src="{{ asset('img/motorcyclist-helmet-side-view.png') }}" alt="Vendeur Accessoires"> </li>
                                <li @if($p->pieces === 0 ) class="hidden" @endif> <img src="{{ asset('img/exhaust-pipe.png') }}" alt="Vendeur Pieces"> </li>
                                <li @if($p->vente_moto === 0 ) class="hidden" @endif> <img src="{{ asset('img/motorcycle-of-big-size-black-silhouette.png') }}" alt="Vendeur Moto"> </li>
                                <li @if($p->huiles === 0 ) class="hidden" @endif> <img src="{{ asset('img/oil.png') }}" alt="Vendeur Huiles"> </li>
                            </ul>
                        </div>
                    </div>

                    <div class="img-responsive col-md-4">
                        <?php  $img = (isset($p->string_lieu)) ? $p->string_lieu : $p->lieu['string_lieu'] ?>
                        <?php if(file_exists(public_path('infoImage/'.$img.'medium.png'))): ?>
                        <img src="{{ asset('infoImage/'.$img.'medium.png') }}" alt="{{ $img }}">
                        <?php else:?>
                        <img src="{{ asset('img/default.png') }}" alt="{{ $p->$img }}">
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </li>
            <?php $counter++ ?>
            <?php if($counter == count($place) ) $page = (isset($p->id)) ? $p->id : $p->lieu['id']  ?>
        @endforeach

            
    @else
        <li class="list-group-item shade-list">
            <div class="group-content">
                Aucun résultat
            </div>
        </li>
    @endif
</ul>

<div class="hidden" id="load">
    Recherche de plus de résultat en cours ...
</div>
<div class="list-group-item shade-list hidden link-more" id="error">
    Une erreur interne est survenue
</div>

@if(count($place) != 0)

    <div class="list-group-item shade-list  link-more">
        <a href="#" data-href="{{ Request::fullUrl() }}&_token={{ csrf_token() }}&more=10&page={{ $page }}" class="link" id="more"> Afficher plus de résultats</a>
    </div>

@endif
