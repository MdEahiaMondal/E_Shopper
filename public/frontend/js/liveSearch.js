$(document).ready(function () {

    // if search to the input search field and key up thene it will works
    $(document).on('keyup', '#liveSearch', function () {
        var serchText =$(this).val();
        resultSearchText(serchText);
    });


    function resultSearchText(serchText = '') {
        $.ajax({
            url: liveSearchUrl,
            method: "GET",
            data: {serchText: serchText},
            dataType: "JSON",
            success: function (feedBackResult) {
                if (feedBackResult.success){
                    $("#autocompleteResultShow").html(feedBackResult.success);
                }

                if (feedBackResult.error){
                    $("#autocompleteResultShow").html(feedBackResult.error);
                }

            }

        })
    }

    resultSearchText();
});
