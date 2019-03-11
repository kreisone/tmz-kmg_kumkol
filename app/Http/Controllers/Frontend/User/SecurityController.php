<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SecurityController extends Controller
{
    public function getWorker(Request $request) {

        // HTTP POST-запрос
        $card_number = $request->input('card_number');
    
        $worker = DB::table('workers')
                    ->select(
                        'id',
                        'name',
                        'lastname',
                        'middlename',
                        'id_shopfloor',
                        'avatar'
                    )
                    ->where('card_number', $card_number)
                    ->get();

        // Если сотрудник не найден редирект на главную страницу с уведомлением
        if ($worker->isEmpty()) return redirect()->route('frontend.index')->with('hasnt_worker', 'Сотрудник не найден');

        $worker = json_decode($worker, true);
        $worker = $worker[0];

        // Идентификатор работника
        $id = $worker['id'];
        $id_shopfloor = $worker['id_shopfloor'];

        // Наименование цеха
        $shopfloor = DB::table('shopfloor')
                        ->select(
                            'title'
                        )
                        ->where('id', $id_shopfloor)
                        ->get();
        $shopfloor = json_decode($shopfloor, true);
        $shopfloor = $shopfloor[0];

        // Идентификаторы групп персонала куда входит работник
        $list_of_personnel = DB::table('list_of_personnel_of_worker')
                        ->select(
                            'id_personnel'
                        )
                        ->where('id_worker', $id)
                        ->get();
        $list_of_personnel = json_decode($list_of_personnel, true);


        $list_of_materials = array();
        $personnel_list = array();
        for ($i = 0; $i < count($list_of_personnel); $i++) {


            // Группы персонала, которые входят в определенный цех
            $group_of_personnel = DB::table('group_of_personnel')
                                    ->select(
                                        'title'
                                    )
                                    ->where('id', $list_of_personnel[$i]['id_personnel'])
                                    ->get();
            $group_of_personnel = json_decode($group_of_personnel, true);

            $personnel_list[$i] = $group_of_personnel;  
            

            // Список материалов по группам персонала работника
            $material = DB::table('list_of_materials')
                            ->select(
                                'id_material'
                            )
                            ->where('id_personnel', $list_of_personnel[$i]['id_personnel'])
                            ->get();
            $material = json_decode($material, true);

            $list_of_materials[$i] = $material;

        }



        $materials = array();
        for ($i = 0; $i < count($list_of_materials); $i++) {
            for ($j = 0; $j < count($list_of_materials[$i]); $j++) {

                $material = DB::table('materials')
                                ->select(
                                    'title'
                                )
                                ->where('id', $list_of_materials[$i][$j]['id_material'])
                                ->get();
                $material = json_decode($material, true);

                array_push($materials, $material);
            }
        }

        $arr_mat = array();
        foreach ($materials as $sub_arr) {
            $arr_mat = array_merge($arr_mat, $sub_arr);
        }


        $materials = $arr_mat;
        // return $materials;
        // убираем повторяющиеся материалы
        $materials = array_unique($materials, SORT_REGULAR);
        // return $materials;

        $data['worker'] = $worker;
        $data['shopfloor'] = $shopfloor;
        $data['personnel'] = $personnel_list;
        $data['materials'] = $materials;

        return view('frontend.index', $data);
    
    }
}
