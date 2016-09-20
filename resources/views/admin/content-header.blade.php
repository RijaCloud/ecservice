<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $title }}
    </h1>
    <ol class="breadcrumb">

        @if(count($link) > 2)
            @for($i = 0 ; $i < count($link) ; $i++)
                @if($i == 0)
                    <li><a href="{{ $link[$i]['url'] }}"><i class="fa fa-dashboard"></i>{{ $link[$i]['name'] }}</a></li>
                @elseif($i == 1)
                    <li><a href="{{ $link[$i]['url'] }}">{{ $link[$i]['name'] }}</a></li>
                @else
                    <li class="active">{{ $link[$i]['name'] }}</li>
                @endif
            @endfor
        @else
            <li><a href="{{ $link[0]['url'] }}"><i class="fa fa-dashboard"></i>{{ $link[0]['name'] }}</a></li>
            <li class="active">{{ $link[1]['name'] }}</li>
        @endif
    </ol>
</section>