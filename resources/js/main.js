    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getUnique(array) {
        var uniqueArray = [];
        for (i = 0; i < array.length; i++) {
            if (uniqueArray.indexOf(array[i]) === -1) {
                uniqueArray.push(array[i]);
            }
        }
        return uniqueArray;
    }

  

    window.setTimeout(function () {
        $(".alert:not(.non-fade)").delay(2000).fadeOut(1000);
    });

    $('[data-toggle="tooltip"]').tooltip();
    function unique(list) {
        var result = [];
        $.each(list, function (i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }
    

    function isEmptyOrSpaces(str){
        return !str === null || !str.trim().length>0;
    }

    $(document.body).tooltip({ selector: "[title]" });

    // new AutoNumeric('.js-auto-numeric', {
    //     currencySymbol : ' ',
    //     decimalCharacter : '.',
    //     digitGroupSeparator : ',',
    // });