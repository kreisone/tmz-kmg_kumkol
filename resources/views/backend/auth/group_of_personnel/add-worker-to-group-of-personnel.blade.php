@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.group_of_personnel.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('wrk_added'))
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-3 alert alert-success">
                    {{ session('wrk_added') }}
                </div>
            @elseif (session('error'))
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-3 alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @else
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div>
            @endif

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <form action="{{ route('admin.auth.group_of_personnel.add_worker_to_group') }}" method="POST" id="add_worker_to_group-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12" id="add_wrk_to_grp">
                            <div class="form-group" id="add_wrk_to_grp-worker">
                                <label for="worker">Сотрудники</label>
                                <select class="form-control" id="worker" name="worker">
                                    <option>Выбрать...</option>
                                    @foreach ($worker as $wrk)
                                        <option value="{{ $wrk['id'] }}">{{ $wrk['lastname'] }} {{ $wrk['name'] }} {{ $wrk['middlename'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    
                </form>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@section('additional-js')
    <script type="text/javascript">
        
        $("#worker").on("change", function(e){

            var data = {};
            // id of worker
            data['id'] = $(this).val();
            

            var form_group = document.createElement("div");
            form_group.classList.add('form-group');
            form_group.setAttribute('id', 'add_wrk_to_grp-shopfloor');

            var label = document.createElement("label");
            label.appendChild(document.createTextNode('Цеха'));
            label.setAttribute('for', 'shopfloor');
            
            var select = document.createElement("select");
            select.setAttribute('class', 'form-control');
            select.setAttribute('id', 'shopfloor');
            select.setAttribute('name', 'shopfloor');
            // вешаем обработчик для получения материалов на основе группы персонала
            select.setAttribute('onchange', "getGroupOfPersonnel(shopfloor, "+data['id']+")");

            $.ajax({
                type: "GET",
                url: "{{ route('admin.auth.group_of_personnel.get_shopfloor') }}",
                data: data,
                dataType: "json",
                async: false,
                success: function(data) {
                    // console.log(data[0]['id']);

                    var option1 = document.createElement('option');
                    option1.appendChild(document.createTextNode("Выбрать..."));
                    select.appendChild(option1);
                    
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement('option');
                        option.appendChild(document.createTextNode(data[i]['title']));
                        option.value = data[i]['id'];
                        select.appendChild(option);

                    }
                    


                }
                // error: function(jqXHR, textStatus, errorThrown) {
                //     alert(errorThrown);
                // }
            });

            form_group.appendChild(label);
            form_group.appendChild(select);


            if (document.getElementById("add_wrk_to_grp-shopfloor") == null) {

                $("#add_wrk_to_grp").append(form_group);

            } else {

                $("#add_wrk_to_grp-shopfloor").remove();
                $('div [id^="add_wrk_to_grp-group_of_personnel"]').remove();
                $("#add_worker_to_group-btn_save").remove();
                $("#add_wrk_to_grp").append(form_group);


            }

        });


        function getGroupOfPersonnel(shopfloor, id_worker) {
            // console.log(shopfloor.value);

            var shopfloor = shopfloor.value;
            var data = {};
            data['id_shopfloor'] = shopfloor;
            data['id_worker'] = id_worker;


            if ($('div [id^="add_wrk_to_grp-group_of_personnel"]').length) {

                $('div [id^="add_wrk_to_grp-group_of_personnel"]').remove();

            }



            $.ajax({
                type: "GET",
                url: "{{ route('admin.auth.group_of_personnel.get_group_of_personnel_by_worker') }}",
                data: data,
                dataType: "json",
                async: false,
                success: function(data) {
                    // console.log(data);
                    data = data.all_group_of_personnel;
                    // data = data.all_material;

                    // <div class="row">
                    //             <div class="col-sm-4">
                    //                 <div class="form-check">
                    //                   <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    //                   <label class="form-check-label" for="defaultCheck1">
                    //                     Анализатор металлов X-MET5000 (в комплекте , в кейсе)
                    //                   </label>
                    //                 </div>
                    //             </div>
                    //             <div class="col-sm-4">
                    //                 <div class="form-check">
                    //                   <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    //                   <label class="form-check-label" for="defaultCheck1">
                    //                     Default checkbox
                    //                   </label>
                    //                 </div>
                    //             </div>
                    //             <div class="col-sm-4">
                    //                 <div class="form-check">
                    //                   <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    //                   <label class="form-check-label" for="defaultCheck1">
                    //                     Default checkbox
                    //                   </label>
                    //                 </div>
                    //             </div>
                                
                    //         </div>

                    var count = 0;

                    for (var i = 0; i < data.length/3; i++) {
                        var material = document.createElement('div');
                        material.classList.add('row');
                        material.setAttribute('id', 'add_wrk_to_grp-group_of_personnel-'+i);

                      

                        for (var j = 0; j < 3; j++) {

                            if (data[count + j] == undefined) break;

                            var col = document.createElement('div')
                            col.classList.add('col-sm-4');

                            var form_check = document.createElement('div');
                            form_check.classList.add('form-check');

                            var form_check_input = document.createElement('input');
                            form_check_input.classList.add('form-check-input');
                            form_check_input.setAttribute('type', 'checkbox');
                            form_check_input.setAttribute('value', data[count + j]['id']);
                            form_check_input.setAttribute('name', "mat-check-"+data[count + j]['id']);
                            form_check_input.setAttribute('id', "mat-check-"+data[count + j]['id']);

                            if (data[count + j]['checked'] == true) {

                                form_check_input.setAttribute('checked', data[count + j]['checked']);
                            }

                            var label = document.createElement('label');
                            label.classList.add("form-check-label");
                            label.setAttribute('for', "mat-check-"+data[count + j]['id']);
                            label.innerHTML = data[count + j]['title'];

                            form_check.appendChild(form_check_input);
                            form_check.appendChild(label);
                            col.appendChild(form_check);
                            material.appendChild(col);

                        }

                        count += 3;
                        $("#add_wrk_to_grp").append(material);

                    }
                
                }
                // error: function(jqXHR, textStatus, errorThrown) {
                //     alert(errorThrown);
                // }
            });


            if (document.getElementById("add_worker_to_group-btn_save") == null) {
                
                // <div class="row mt-4">
                //             <div class="col">
                //                 <button type="input" class="btn btn-primary">Сохранить</button>
                //             </div>
                //         </div>
                var row_btn = document.createElement('div');
                row_btn.classList.add('row');
                row_btn.classList.add('mt-4');
                row_btn.setAttribute('id', 'add_worker_to_group-btn_save');
                var col = document.createElement('div');
                col.classList.add('col');
                var btn = document.createElement('button');
                btn.setAttribute('type', "input");
                btn.classList.add('btn');
                btn.classList.add('btn-primary');
                btn.innerHTML = "Сохранить";

                col.appendChild(btn);
                row_btn.appendChild(col);

                $("#add_worker_to_group-form").append(row_btn);
            }
            
        };

    </script>
@endsection

