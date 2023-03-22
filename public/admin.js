$("#SearchBuses").click(function(e){
    e.preventDefault();
    const btn = $(this);

    $("#append-trips").html(``);
    $("#ntf").hide();
    $("#loading").show();

    btn.attr("disabled", true);
    btn.addClass('disabled');

    const dt = new Date($('#doj').val().replaceAll('/','-'));
    const Data = {
        from : $("#PointFrom").val(),
        to : $("#PointTo").val(),
        doj : dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()
    };
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/load-trip",
        data: Data,
        dataType: "JSON",
        success: function (response) {
            btn.removeAttr("disabled", true);
            btn.removeClass('disabled');
            $("#loading").hide();
            for (let index = 0; index < response.length; index++) {
                const element = response[index];
                $('#append-trips').append(`
                    <tr>
                        <th>${index+1}</th>
                        <th>${element.departure}</th>
                        <th>${element.destination}</th>
                        <th>${element.departure_time}</th>
                        <th>${element.bus.name}</th>
                        <th>${element.bus.seats.seat_count}</th>
                        <th>${element.fare}</th>
                        <th>
                            <a target="blank" href="/admin/book/${element.id}/${Data.doj}" class="seat-viewbox-toggle btn btn-primary shadow-none rounded-0">Book Seat</a>
                        </th>
                    </tr>
                `);
            }
        },
        error: function (err){
            console.log(err);
            btn.removeAttr("disabled", true);
            btn.removeClass('disabled');
            $("#loading").hide();
            $("#ntf").show();
        }
    });
});
