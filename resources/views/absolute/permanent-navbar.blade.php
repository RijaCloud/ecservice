<div class="permanentNavbarTop">
    <div class="navbar-fixed-top greenwalk" id="header-fixed">
        <div class="wrapper">
            <div class="leftNav">
                <div class="logo">
                    <a href="/" id="logo">EveryCycle</a>
                </div>
                <div class="area-input">
                    <form action="/search" method="get" id="search">
                        <div class="inputSearch inputWithDropdown">
                            <span class="input-holder">
                                <input type="text" name="sv" id="searchBar" autocomplete="off" placeholder="Je recherche" max-length="200">
                            </span>
                            <div class="dropdown clearfix" id="todroplist">
                                <div class="list"></div>
                            </div>
                        </div>
                        <div class="selectSearch setInput">
                            <input type="text" name="sfk" id="nearSfk" placeholder="Fokontany" max-length="200">
                            <div class="dropdown clearfix" id="fknlist"></div>
                        </div>
                        <button class="btn-submit" type="submit">
                            <span class="glyphicon glyphicon-search "></span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="rightNav" id="navRight">
                <ul class="right-perform">
                    <li><a href="#" class="perform">Recherche avancée</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script>
    $(function() {
       $('.perform').on('click', function(e) {
           e.preventDefault();
           var $elem = $('#topRight');
           var $top = $('#fixedRight');
           if($elem.attr('data-moved') == "false") {
               $elem.attr('data-moved',"true");
               $elem.removeClass('slideDown');
               $top.removeClass("slideDown");
           } else {
               $elem.attr('data-moved',"false");
               $elem.addClass('slideDown');
               $top.addClass('slideDown');
           }
       })
    });
</script>