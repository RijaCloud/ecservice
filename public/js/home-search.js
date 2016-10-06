$(function() {
    if(NodeList.prototype.forEach === undefined) {
        NodeList.prototype.forEach = Array.prototype.forEach
    }

    var $drop_element = 
        $('<div class="down">' +
        '<ul class="droped">' +
        '<li class="li-down" id="g" data-value="Garage" data-link="sv=garage"><span class="fa fa-globe"></span> Des garages </li>' +
        '<li class="li-down" id="p" data-value="Personnalisation" data-link="sv=personnaliser"><span class="fa fa-globe"></span> Tunning </li>' +
        '<li class="li-down" id="h" data-value="Huile" data-link="sv=huile"><span class="fa fa-globe"></span> De l\'huile </li>' +
        '<li class="li-down" id="a" data-value="Accessoires" data-link="sv=accessory"><span class="fa fa-globe"></span> Des accessoires moto </li>' +
        '<li class="li-down" id="a" data-value="Pieces" data-link="sv=pieces"><span class="fa fa-globe"></span> Des pieces </li>' +
        '<li class="li-down" id="a" data-value="Achat Moto" data-link="sv=vente_moto"><span class="fa fa-globe"></span> Acheter une moto </li>' +
        '</ul>' +
        '</div>')

    $('#mys').on('focus', function() {
        var $drop = $(this).parent().next('.dropdown');
        $drop.attr('aria-open','opened');
        $drop.append($drop_element);
    })

    $('.toggle-input').on('click','.li-down',function (e) {
        e.stopPropagation();
        $('.down').remove()
        $('#mys').val( $(this).attr('data-value'))
    })

});