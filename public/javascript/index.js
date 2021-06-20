$(document).ready(function(){
    var $packs = [];
    var $agriculturalMachinery = [];
    let $i = 0;

    $("#add-pack").on('click', function(){

        $i++;
        $weight = $('#weight').val();

        if($weight >= 10 && $weight <= 20){
            $pack = {'packId' : $i, 'weight' : $weight}
            $packs.push($pack);
            $('#pack-list').append(`<div>Nr paczki:  ${$pack.packId} Waga:  ${$pack.weight} kg</div>`);

            if($packs.length == 40){
                $(this).attr('disabled', true);
            }
        } else {
            alert('Dopuszczalna waga paczki 10-20 kg');
        }

    });

    $('#add-agricultural-machine').on('click', function(){
        $machine = $('#agriculuralMachinery option:selected').text();

        if($agriculturalMachinery.indexOf($machine)=== -1){
            $('#agricultural-machinery-list').append('<h4>' + $machine + '</h4>')
            $agriculturalMachinery.push($machine);
        }
    });

    $('#send-packs').on('click', function(){
        if($packs.length >= 5 && $packs.length <=40 && $agriculturalMachinery.length == 2){
            console.log($packs);
            send($packs, $agriculturalMachinery);
        } else {
            alert('Poprawny załadunek: ciężarówka nr 1 od 5 do 40 paczek. ' +
                'Ciężarówka nr 2: dwie maszyny rolnicze');
        }

    });

    $('#organize-reloading').on('click', function(){
        organize();
        $('.reloading-organize-section').show();
        $(this).attr('disabled', true);
    });

    function send ($packs, $agriculturalMachinery){

        $.ajax({
            type: "POST",
            url: "/truck-loading/set-packs",
            data: {packs: $packs, agriculturalMachinery : $agriculturalMachinery},
            success: function(response){
                $('.truck-loading').hide();
                $('.reloading-section').show();

            }
        });
    }

    function organize (){

        $('#finish').text('Zakończ');
        $.ajax({
            type: "GET",
            url: "/reloading-organize",
            success: function(response){

                $('#totalWeight').text('Łączna waga paczek: ' + response['information']['totalWeight'] + ' kg');
                $('#numbersVehicleNeeded').text('Ilość potrzebnych pojazdów: ' + response['plan']);

                response['vehicles'].forEach(e=>{
                    $vehicleNumber = e['vehicleNumber'];
                    $('#vehicleContent').append('<h5 id="' + $vehicleNumber + '">Nr pojazdu: ' + $vehicleNumber + '</h5>');
                    console.log(e['vehicleNumber']);
                    e['packs'].forEach(e=>{
                        console.log(e);
                        $element = '#vehicleContent h5#' + $vehicleNumber;
                        $($element).append('<h6>Nr paczki: ' +e['packId'] +' Waga: ' + e['weight'] + ' kg</h6>');
                    });
                });
                response['agriculturalMachinery'].forEach(e=>{
                    $('h3#agricultural-machinery-list').append('<h6>' + e +'</h6>');
                });
            }
        });
    }

    $('#finish').on('click', function(){
        window.location.href = '/truck-loading';
    })
});