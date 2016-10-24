<div class="permanentNavbarTop">
    <div class="navbar-fixed-top greenwalk" id="header-fixed">
        <div class="wrapper">
            <div class="leftNav">
                <div class="logo">
                    <a href="/" id="logo">WheelsMada</a>
                </div>
            </div>
            <div class="rightNav" id="navRight">
                    <button id="advanced"> Recherche avancée </button>

                <!--
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
             -->
            </div>
            <div class="floating-container slideRight">

                <div class="content-fixed-top animated" id="topRight">
                    <span class="top-content">
                        Les resultats ne vous conviennent-ils pas ? <br>
                        Vous avez la possibilité de filtrer les resultats par :
                    </span>
                    <form action="/"  autocomplete="off" method="get" id="territorySpecification" class="territory-display">
                        <label for="display">Par:</label>
                        <ul id="display" class="display-t">
                            <li><input type="radio" id="input-1"  name="input" value="fokontany">Fokontany</li>
                            <li><input type="radio" id="input-2"  name="input" value="district">District</li>
                            <li><input type="radio" id="input-3" name="input" value="region">R&eacute;gion</li>

                        </ul>
                        <div class="form-group hidden s-result" id="hidden">
                            <input type="text" name="s" id="s" class="form-control" autocomplete="off">
                            <div class="result hidden">

                            </div>
                        </div>

                        <div class="form-group hidden" id="actif">
                            <h5> Details : </h5>
                            <div>

                                <input type="checkbox"  id="garage" name="sv-g">
                                <label for="garage">Garage moto</label>
                            </div>

                            <div>

                                <input type="checkbox"  id="accessory" name="sv-a">
                                <label for="accessory">Accessoires moto</label>
                            </div>

                            <div>

                                <input type="checkbox"  id="pieces" name="sv-p">
                                <label for="pieces">Pieces moto</label>
                            </div>

                            <div>

                                <input type="checkbox"  id="huile" name="sv-h">
                                <label for="huile">Huile moto</label>
                            </div>

                            <div>

                                <input type="checkbox"  id="tuning" name="sv-per">
                                <label for="tuning">Tuning</label>
                            </div>

                        </div>
                        <div class="form-group hidden" id="btn">
                            <button class="btn btn-success">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="clearfix"></div>
<script>

    var chosen = false;

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
        $('#advanced').on('click', function(e) {
            e.preventDefault()
            if($('.floating-container').hasClass('slideLeft')) {
                $('.floating-container').removeClass('slideLeft').addClass('slideRight')
                chosen = true;
            } else {
                $('.floating-container').removeClass('slideRight').addClass('slideLeft')
                chosen = false;
            }
        })
    });

</script>