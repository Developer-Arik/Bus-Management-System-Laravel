var seats = [];

function loadSeats(){
    $(".seat-ul").html('');

    function max_num_seat(){
        let x = [];
        for (let index = 0; index < seats.length; index++) {
            const element = seats[index].yaxis;
                        if(element){
                x.push(element);
            }else{
                x = [];
            }
        }

        return x.length!=0 ? Math.max(...x) : 0;
    }
    function max_num_row(){
        let x = [];
        for (let index = 0; index < seats.length; index++) {
            const element = seats[index].xaxis;
            if(element){
                x.push(element);
            }else{
                x = [];
            }
        }

        return x.length!=0 ? Math.max(...x) : 0;
    }

    $(".seat-ul").css(`grid-template-columns`,`repeat(${$("#max_seat").val()},1fr)`);

    if(max_num_seat() < $("#max_seat").attr('min')){
        $("#max_seat").attr('min', max_num_seat());
    }else{
        $("#max_seat").attr('min', max_num_seat())
    }

    for (let index = 1; index <= max_num_row()+1;index++){
        const sl = index;
        for (let index = 1; index<= $("#max_seat").val(); index++){
                let seat = seats.filter((seat) => {
                    return seat.xaxis===sl && seat.yaxis===index
                })[0];
                if(seat!=undefined){
                    $(".seat-ul").append(`<li xAxis="${sl}" yAxis="${index}" seatNo="${seat.seatNo}" class="seat">${seat.seatNo}</div>`);
                }else{
                    $(".seat-ul").append(`<li xAxis="${sl}" yAxis="${index}" class="spacer">+</li>`)
                }
        }
    }

    $("#seat-input").val(JSON.stringify(seats));

    $(".seat").click(function (e) {
        e.preventDefault();

        const seat = seats.filter((seat) => {
            return seat.seatNo===$(this).attr('seatNo');
        })[0];

        if(seats.length>1){
            seats.splice(seats.indexOf(seat),1)
        }else{
            seats = [];
        }

        loadSeats();
    });

    $(".spacer").click(function (e) {
        e.preventDefault();

        $('#addSeatMondal').modal('toggle');
        $("#set-Sit").attr('xaxis',$(this).attr('xaxis'));
        $("#set-Sit").attr('yaxis',$(this).attr('yaxis'));
    });
}

loadSeats();

$("#max_seat").change(function (e) {
    e.preventDefault();
    loadSeats();
});
$("#max_row").change(function (e) {
    e.preventDefault();
    loadSeats();
});

$("#set-Sit").click(function (e) {
    e.preventDefault();
    if($("#add-seat-no").val()!=''){
        let norUnique = seats.filter((seat) => {
            return seat.seatNo===$("#add-seat-no").val();
        }).length;

        if(norUnique>0){
            alert("Already has seat in this seat no");
        }else{
            seats.push({
                "seatNo" : $("#add-seat-no").val(),
                "xaxis" : parseInt($(this).attr('xaxis')),
                "yaxis" : parseInt($(this).attr('yaxis'))
            });
            $("#add-seat-no").val('');
            $('#addSeatMondal').modal('toggle');
            loadSeats();
        }
    }else{
        alert('You Have Must add seat no');
    }
});
