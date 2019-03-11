<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class StatisticsController extends Controller
{

    public function index(Request $request) {


    	$fields = array('shopfloor.id as shopfloor_id',
	    						'shopfloor.title as shopfloor_title',
	    						'group_of_personnel.title as group_for_personnel_title',
	    						'group_of_personnel.id as group_for_personnel_id',
	    						'materials.title as materials_title',
	    						'workers.name as name',
	    						'workers.lastname as lastname',
	    						'workers.middlename as middlename');
    	$item = '';
    	if ($request->input('shopfloor')) {

	    	$id_shopfloor = $request->input('shopfloor');

	    	// у каждого работника должна быть пренадлежность к цеху, группе работников и иметь список материалов для проноса, иначе запрос будет не полным (поля таблицы бд должна быть связана по вышеперечисленным пунктам)
	    	$shopfloor = DB::table('shopfloor')
	    					->join(
	    						'group_of_personnel',
	    						'shopfloor.id', '=', 'group_of_personnel.id_shopfloor'
	    					)
	    					->join(
	    						'list_of_materials',
	    						'group_of_personnel.id', '=', 'list_of_materials.id_personnel'
	    					)
	    					->join(
	    						'materials',
	    						'list_of_materials.id_material', '=', 'materials.id'
	    					)
	    					->join(
	    						'list_of_personnel_of_worker',
	    						'group_of_personnel.id', '=', 'list_of_personnel_of_worker.id_personnel'
	    					)
	    					->join(
	    						'workers',
	    						'list_of_personnel_of_worker.id_worker', '=', 'workers.id'
	    					)
	    					->select($fields)
	    					->where('shopfloor.id', $id_shopfloor)
	    					->get();
	    	$item = json_decode($shopfloor, true);
	    	// return $shopfloor;
			$item = $this->createAppropriateArray($item, $request);

			
			// return $item;


	    	// return $item;
	    } elseif ($request->input('group_of_personnel')) {

	    	$group_of_personnel_id = $request->input('group_of_personnel');


	    	$group_of_personnel = DB::table('group_of_personnel')
	    					->join(
	    						'shopfloor',
	    						'group_of_personnel.id_shopfloor', '=', 'shopfloor.id'
	    					)
	    					->join(
	    						'list_of_materials',
	    						'group_of_personnel.id', '=', 'list_of_materials.id_personnel'
	    					)
	    					->join(
	    						'materials',
	    						'list_of_materials.id_material', '=', 'materials.id'
	    					)
	    					->join(
	    						'list_of_personnel_of_worker',
	    						'group_of_personnel.id', '=', 'list_of_personnel_of_worker.id_personnel'
	    					)
	    					->join(
	    						'workers',
	    						'list_of_personnel_of_worker.id_worker', '=', 'workers.id'
	    					)
	    					->select($fields)
	    					->where('group_of_personnel.id', $group_of_personnel_id)
	    					->get();
	    	$item = json_decode($group_of_personnel, true);
	    	// return $item;
	    	// return 'group_of_personnel - '.$item;


	    	$item = $this->createAppropriateArray($item, $request);
	    	

	    	// return $item;



	    } elseif ($request->input('worker')) {

	    	$id_worker = $request->input('worker');

	    	
	    	$worker = DB::table('workers')
	    					->join(
	    						'list_of_personnel_of_worker',
	    						'workers.id', '=', 'list_of_personnel_of_worker.id_worker'
	    					)	
	    					->join(
	    						'group_of_personnel',
	    						'list_of_personnel_of_worker.id_personnel', '=', 'group_of_personnel.id'
	    					)
	    					->join(
	    						'shopfloor',
	    						'group_of_personnel.id_shopfloor', '=', 'shopfloor.id'
	    					)
	    					->join(
	    						'list_of_materials',
	    						'group_of_personnel.id', '=', 'list_of_materials.id_personnel'
	    					)
	    					->join(
	    						'materials',
	    						'list_of_materials.id_material', '=', 'materials.id'
	    					)
	    					->select($fields)
	    					->where('workers.id', $id_worker)
	    					->get();
	    	$item = json_decode($worker, true);
	    	// return $item;
	    	// return 'group_of_personnel - '.$item;


	    	$item = $this->createAppropriateArray($item, $request);
	    	

	    	// return $item;

    		
    	}


    	// Getting data

    	$shopfloor = DB::table('shopfloor')
    					->select(
    						'id',
    						'title'
    					)
    					->get();
    	$shopfloor = json_decode($shopfloor, true);




    	$worker = DB::table('workers')
    					->select(
    						'id',
    						'name',
    						'lastname',
    						'middlename'
    					)
    					->get();
    	$worker = json_decode($worker, true);



    	$group_of_personnel = DB::table('group_of_personnel')
    					->join('shopfloor', 'group_of_personnel.id_shopfloor', '=', 'shopfloor.id')
    					->select(
    						'group_of_personnel.id as id',
    						'group_of_personnel.title as title',
    						'shopfloor.title as shopfloor_title'
    					)
    					->get();
    	$group_of_personnel = json_decode($group_of_personnel, true);



    	$data['shopfloor'] = $shopfloor;
    	$data['worker'] = $worker;
    	$data['group_of_personnel'] = $group_of_personnel;
    	if ($item) $data['item'] = $item;
    	else $data['item'] = '';

    	return view('backend.auth.statistics.index', $data);

    }


    /*
     * Формирует соответствующий массив определенного формата для отчета
     */
    private function createAppropriateArray($item, $request) {

    	$count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];

    	$stat_row = array();
		// return $item;	    	
		$mat = array();	
		$k = 0;
    	foreach ($item as $itm) {
    			// return $itm;
			$sub_stat_row = array();	 
			$sub_stat_row['materials'] = array();   		
			$sub_stat_row['shopfloor_id']              = '';
			$sub_stat_row['shopfloor_title']           = '';
			$sub_stat_row['group_for_personnel_title'] = '';
			$sub_stat_row['group_for_personnel_id']    = '';
			$sub_stat_row['name']                      = '';
			$sub_stat_row['lastname']                  = '';
			$sub_stat_row['middlename']                = '';

    		for ($i = 0; $i < count($item); $i++) {

	    		if (
					in_array($itm['shopfloor_id'], $item[$i]) && 
					in_array($itm['shopfloor_title'], $item[$i]) && 
					in_array($itm['group_for_personnel_title'], $item[$i]) && 
					in_array($itm['group_for_personnel_id'], $item[$i]) && 
					in_array($itm['name'], $item[$i]) && 
					in_array($itm['lastname'], $item[$i]) && 
					in_array($itm['middlename'], $item[$i])
	    		) {
	    			
	    			if (isset($sub_stat_row['shopfloor_id'])) {
			    			if (
								in_array($itm['shopfloor_id'], $sub_stat_row) && 
								in_array($itm['shopfloor_title'], $sub_stat_row) && 
								in_array($itm['group_for_personnel_title'], $sub_stat_row) && 
								in_array($itm['group_for_personnel_id'], $sub_stat_row) && 
								in_array($itm['name'], $sub_stat_row) && 
								in_array($itm['lastname'], $sub_stat_row) && 
								in_array($itm['middlename'], $sub_stat_row)
				    		) {

			    				continue;

			    			}
			    	}

					if (
						$sub_stat_row['shopfloor_id']              == '' &&
						$sub_stat_row['shopfloor_title']           == '' &&
						$sub_stat_row['group_for_personnel_title'] == '' &&
						$sub_stat_row['group_for_personnel_id']    == '' &&
						$sub_stat_row['name']                      == '' &&
						$sub_stat_row['lastname']                  == '' &&
						$sub_stat_row['middlename']                == ''
					) {

						$sub_stat_row['shopfloor_id']              = $itm['shopfloor_id'];
						$sub_stat_row['shopfloor_title']           = $itm['shopfloor_title'];
						$sub_stat_row['group_for_personnel_title'] = $itm['group_for_personnel_title'];
						$sub_stat_row['group_for_personnel_id']    = $itm['group_for_personnel_id'];
						$sub_stat_row['name']                      = $itm['name'];
						$sub_stat_row['lastname']                  = $itm['lastname'];
						$sub_stat_row['middlename']                = $itm['middlename'];


					}	

					    // добавляем материалы в массив с id группы персонала 
						$mat[$k] = array();
						array_push($mat[$k], $itm['group_for_personnel_id']);
						array_push($mat[$k], $itm['materials_title']);

	    		}

	    	}

	    	$k++;
	    	array_push($stat_row, $sub_stat_row);

    	}
    	// return $mat;

    	for ($i = 0; $i < count($mat); $i++) {
    		
    		for ($j = 0; $j < count($mat); $j++) {

    			if (
    				$mat[$i][0] == $mat[$j][0] &&
    				$stat_row[$i]['group_for_personnel_id'] == $mat[$j][0] 
    			) {

    				$stat_row[$i]['materials'][$j] = $mat[$j][1]; 

    			}

    			$stat_row[$i]['materials'] = array_unique($stat_row[$i]['materials'], SORT_REGULAR);
    		}
    	}


    	$stat_row = array_values(array_unique($stat_row, SORT_REGULAR));
	    	// return $stat_row;


    	// Manual paginating
    	$count = count($stat_row);

		$page = $request->page;
		$perPage = $count_of_page;
		// $perPage = 1;
		$offset = ($page-1) * $perPage;

		$arr_item = array_slice($stat_row, $offset, $perPage);

		$item_page = new LengthAwarePaginator($arr_item, $count, $perPage, $page, [
			'path' => $request->url(),
			'query' => $request->query(),
		]);

    	return $item_page;
    }

}
