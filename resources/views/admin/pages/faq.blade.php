@extends('admin.master')
@section('body')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
        <span class="breadcrumb-item active">Faq</span>
    </nav>
    <div class="modal fade" id="addNewFaq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 40%;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title fs-5">Add Faq</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <input class="form-control" placeholder="Title" type="text" id="add-faq-title">
              <label class="text-danger" for="add-faq-title" id="aft"></label>
              <div class="py-1"></div>
              <textarea rows="8" class="form-control" placeholder="Description" id="add-faq-description"></textarea>
              <label class="text-danger" for="add-faq-description" id="afd"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="set-new" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal-faqs">
        @for ($i = 0; $i < sizeof($faqs); $i++)
            <div id="edit-faq-{{ $faqs[$i]->id }}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 40%;">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Edit Faq : </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <input class="form-control" placeholder="Title" type="text" id="edit-faq-title-{{ $faqs[$i]->id }}" value="{{ $faqs[$i]->title }}">
                    <label class="text-danger" for="edit-faq-title-{{ $faqs[$i]->id }}"></label>
                    <div class="py-1"></div>
                    <textarea rows="8" class="form-control" placeholder="Description" id="edit-faq-description-{{ $faqs[$i]->id }}">{{ $faqs[$i]->description }}</textarea>
                    <label class="text-danger" for="edit-faq-description-{{ $faqs[$i]->id }}"></label>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-changes" faqId="{{ $faqs[$i]->id }}">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="modal-views">
        @for ($i = 0; $i < sizeof($faqs); $i++)
            <div class="modal fade view-faq" id="view-faq-{{ $faqs[$i]->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 40%;">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title fs-5" >Faq Title : {{ $faqs[$i]->title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <input class="form-control readonly" placeholder="Title" type="text" readonly>
                            <div class="py-1"></div>
                            <textarea rows="8" class="form-control readonly" placeholder="{{ $faqs[$i]->description }}" readonly></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewFaq">
                    Add New
                </button>
            </h6>
            <p class="mg-b-20 mg-sm-b-30"></p>
            <div class="table-responsive">
            <table class="table mg-b-0">
                <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < sizeof($faqs); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $faqs[$i]->title }}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#view-faq-{{ $faqs[$i]->id }}">View Details</button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#edit-faq-{{ $faqs[$i]->id }}">Edit Details</button>
                                <button class="btn btn-danger delete-item" itemId="{{ $faqs[$i]->id }}">Delete</button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr("token")
        }
    });

    $("#set-new").click(function (e) {
        e.preventDefault();
        const data = {
            title : $("#add-faq-title").val(),
            description : $("#add-faq-description").val()
        };

        console.log(data);

        $.ajax({
            type: "POST",
            url: "http://localhost:8000/admin/faq/create",
            data: data,
            dataType: "JSON",
            success: function (response){
                console.log(response);
                $('tbody').html('');
                $('.modal-views').html('');
                $('.modal-faqs').html('');
                for (let index = 0; index < response.all.length; index++) {
                    const element = response.all[index];
                    $('.modal-faqs').append(`
                    <div id="edit-faq-${element.id}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 40%;">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Edit Faq : </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <input class="form-control" placeholder="Title" type="text" id="edit-faq-title-${element.id}" value="${element.title}">
                            <label class="text-danger" for="edit-faq-title-${element.id}"></label>
                            <div class="py-1"></div>
                            <textarea rows="8" class="form-control" placeholder="Description" id="edit-faq-description-${element.id}">${element.description}</textarea>
                            <label class="text-danger" for="edit-faq-description-${element.id}"></label>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary edit-changes" faqId="${element.id}">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>`);
                    $('tbody').append(`<tr>
                            <td>${index+1}</td>
                            <td>${element.title}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#view-faq-${element.id}">View Details</button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#edit-faq-${element.id}">Edit Details</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>`);
                    $(".modal-views").append(`<div class="modal fade view-faq" id="view-faq-${element.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 40%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title fs-5">Faq Title : ${element.title}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" placeholder="${element.title}" type="text">
                                    <div class="py-1"></div>
                                    <textarea rows="8" class="form-control readonly" placeholder="${element.description}" readonly></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>`);
                }
                $('#addNewFaq').modal('toggle');
            },
            error : function (err){
                if(err.responseJSON.errors.title){
                    $("#aft").html(err.responseJSON.errors.title[0]);
                }else{
                    $("#aft").html('');
                }
                if(err.responseJSON.errors.description){
                    $("#afd").html(err.responseJSON.errors.description[0]);
                }else{
                    $("#afd").html('');
                }
            }
        });
    });

    $(".edit-changes").click(function (e) {
        e.preventDefault();

        const scduleId = $(this).attr('faqId');

        const data = {
            id : scduleId,
            title : $("#edit-faq-title-"+scduleId).val(),
            description : $("#edit-faq-description-"+scduleId).val()
        };

        $.ajax({
            type: "POST",
            url: "http://localhost:8000/admin/faq/edit",
            data: data,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $('tbody').html('');
                $('.modal-views').html('');
                for (let index = 0; index < response.all.length; index++) {
                    const element = response.all[index];
                    $('tbody').append(`<tr>
                            <td>${index+1}</td>
                            <td>${element.title}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#view-faq-${element.id}">View Details</button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#edit-faq-${element.id}">Edit Details</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>`);
                    $(".modal-views").append(`<div class="modal fade view-faq" id="view-faq-${element.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 40%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title fs-5">Faq Title : ${element.title}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" placeholder="${element.title}" type="text">
                                    <div class="py-1"></div>
                                    <textarea rows="8" class="form-control readonly" placeholder="${element.description}" readonly></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>`);
                }
                $('#edit-faq-'+scduleId).modal('toggle');
            },
            error : function (err){
                if(err.responseJSON.errors.title){
                    $(`label[for=edit-faq-title-${scduleId}]`).html(err.responseJSON.errors.title[0]);
                }else{
                    $(`label[for=edit-faq-title-${scduleId}]`).html('');
                }
                if(err.responseJSON.errors.description){
                    $(`label[for=edit-faq-description-${scduleId}]`).html(err.responseJSON.errors.description[0]);
                }else{
                    $(`label[for=edit-faq-description-${scduleId}]`).html('');
                }
            }
        });
    });

    $('.delete-item').click(function (e) {
        e.preventDefault();
        const itemId = $(this).attr('itemId');
        console.log('xxx');

        $.ajax({
            type: "POST",
            url: "http://localhost:8000/admin/faq/delete",
            data: {
                id : itemId
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $('tbody').html('');
                $('.modal-views').html('');
                for (let index = 0; index < response.all.length; index++) {
                    const element = response.all[index];
                    $('tbody').append(`<tr>
                            <td>${index+1}</td>
                            <td>${element.title}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#view-faq-${element.id}">View Details</button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#edit-faq-${element.id}">Edit Details</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>`);
                    $(".modal-views").append(`<div class="modal fade view-faq" id="view-faq-${element.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 40%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title fs-5">Faq Title : ${element.title}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" placeholder="${element.title}" type="text">
                                    <div class="py-1"></div>
                                    <textarea rows="8" class="form-control readonly" placeholder="${element.description}" readonly></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>`);
                }
            }
        });
    });
</script>
@endsection
