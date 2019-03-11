@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.group_of_personnel.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (session('mat_added'))
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.group_of_personnel.title') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-3 alert alert-success">
                    {{ session('mat_added') }}
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
                <form action="{{ route('admin.auth.group_of_personnel.add_mat_to_group') }}" method="POST" id="add_mat_to_group-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12" id="add_mat_to_grp">
                            <div class="form-group" id="add_mat_to_grp-shopfloor">
                                <label for="shopfloor">Цех</label>
                                <select class="form-control" id="shopfloor" name="shopfloor">
                                    <option>Выбрать...</option>
                                    @foreach ($shopfloor as $shflr)
                                        <option value="{{ $shflr['id'] }}">{{ $shflr['title'] }}</option>
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
        
        $("#shopfloor").on("change", function(e){

            var data = {};
            // id of shopfloor
            data['id'] = $(this).val();
            

            var form_group = document.createElement("div");
            form_group.classList.add('form-group');
            form_group.setAttribute('id', 'add_mat_to_grp-group_of_personnel');

            var label = document.createElement("label");
            label.appendChild(document.createTextNode('Группа персонала'));
            label.setAttribute('for', 'group_of_personnel');
            
            var select = document.createElement("select");
            select.setAttribute('class', 'form-control');
            select.setAttribute('id', 'group_of_personnel');
            select.setAttribute('name', 'group_of_personnel');
            // вешаем обработчик для получения материалов на основе группы персонала
            select.setAttribute('onchange', "getMaterial(group_of_personnel)");

            $.ajax({
                type: "GET",
                url: "{{ route('admin.auth.group_of_personnel.get_group_of_personnel') }}",
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


            if (document.getElementById("add_mat_to_grp-group_of_personnel") == null) {

                $("#add_mat_to_grp").append(form_group);

            } else {

                $("#add_mat_to_grp-group_of_personnel").remove();
                $('div [id^="add_mat_to_grp-material"]').remove();
                $("#add_mat_to_group-btn_save").remove();
                $("#add_mat_to_grp").append(form_group);


            }

        });


        function getMaterial(group_of_personnel) {
            // console.log(group_of_personnel.value);

            var id_group_of_personnel = group_of_personnel.value;
            var data = {};
            data['id_group_of_personnel'] = id_group_of_personnel;


            if ($('div [id^="add_mat_to_grp-material"]').length) {

                $('div [id^="add_mat_to_grp-material"]').remove();

            }



            $.ajax({
                type: "GET",
                url: "{{ route('admin.auth.group_of_personnel.get_material') }}",
                data: data,
                dataType: "json",
                async: false,
                success: function(data) {
                    // console.log(data.all_material);
                    data = data.all_material;

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
                        material.setAttribute('id', 'add_mat_to_grp-material-'+i);


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
                        $("#add_mat_to_grp").append(material);

                    }
                
                }
                // error: function(jqXHR, textStatus, errorThrown) {
                //     alert(errorThrown);
                // }
            });


            if (document.getElementById("add_mat_to_group-btn_save") == null) {
                
                // <div class="row mt-4">
                //             <div class="col">
                //                 <button type="input" class="btn btn-primary">Сохранить</button>
                //             </div>
                //         </div>
                var row_btn = document.createElement('div');
                row_btn.classList.add('row');
                row_btn.classList.add('mt-4');
                row_btn.setAttribute('id', 'add_mat_to_group-btn_save');
                var col = document.createElement('div');
                col.classList.add('col');
                var btn = document.createElement('button');
                btn.setAttribute('type', "input");
                btn.classList.add('btn');
                btn.classList.add('btn-primary');
                btn.innerHTML = "Сохранить";

                col.appendChild(btn);
                row_btn.appendChild(col);

                $("#add_mat_to_group-form").append(row_btn);
            }
            
        };

    </script>
@endsection

