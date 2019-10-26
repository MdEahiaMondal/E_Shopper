$(document).ready(function () {

    var min = parseInt( $("#miniPrice").val() );
    var max = parseInt( $("#maxprice").val() );

    var getSliderElement = $("#priceSlider");

    getSliderElement.slider({
        range:true,
        min:min,
        max:max,
        values:[min, max],
        slide: function (event, ui) {
            $("#minimumPrice").val(ui.values[0]);
            $("#maximumPrice").val(ui.values[1]);
        }
    });

    $("#minimumPrice").val(getSliderElement.slider('values',0) );
    $("#maximumPrice").val(getSliderElement.slider('values',1) );

});

/*
$(".priceRangeForm").on('submit', function (event) {
    event.preventDefault();

    $.ajax({
       url: getpriceRangehUrl,
        method: "get",
        data: $(this).serialize(),
        success: function (data) {
           var minimumPrice = data.minimumPrice;
           var maximumPrice = data.maximumPrice;
            window.location.replace(priceDataUrl,[minimumPrice,maximumPrice]);
        }
    });

});*/
