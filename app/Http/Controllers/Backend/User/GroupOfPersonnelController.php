<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupOfPersonnelController extends Controller
{
    public function index($shopfloor = '', $search = '') {

        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];


    	if (!$shopfloor) {
	        $group_of_personnel = DB::table('shopfloor')
	        						->join('group_of_personnel', 'shopfloor.id', '=', 'group_of_personnel.id_shopfloor')
	        						->select('shopfloor.title as shopfloor_title', 'group_of_personnel.title as title', 'group_of_personnel.id as id')
	        						->orderBy('id', 'asc')
	        						->paginate($count_of_page);
	    } else {
			$group_of_personnel = DB::table('shopfloor')
        						->join('group_of_personnel', 'shopfloor.id', '=', 'group_of_personnel.id_shopfloor')
        						->select('shopfloor.title as shopfloor_title', 'group_of_personnel.title as title', 'group_of_personnel.id as id')
        						->where('group_of_personnel.id_shopfloor', $shopfloor)
        						->orderBy('id', 'asc')
        						->paginate($count_of_page);    		
    	}

        
      	$shopfloors = DB::table('shopfloor')
      					->select(
      						'id',
      						'title'
      					)
      					->get();
      	$shopfloors = json_decode($shopfloors, true);



        $data['group_of_personnel'] = $group_of_personnel;
        $data['shopfloors'] = $shopfloors;

        // return $data;

    	return view('backend.auth.group_of_personnel.index', $data);

    }


    public function deleteGroupOfPersonnel($id) {

    	try {
    		
		    	DB::table('group_of_personnel')
		    		->where('id', $id)->delete();
    		
		    	return redirect()
		    				->route('admin.auth.group_of_personnel.index')
		    				->with('grp_deleted', __('alerts.backend.group_of_personnel.deleted'));
		
    	} catch (Exception $e) {
				return redirect()
	    					->route('admin.auth.group_of_personnel.index')
	    					->with('grp_deleted', __('alerts.backend.group_of_personnel.error'));
    		
    	}

    }



    public function showEditGroupOfPersonnel($id) {

    	// current group of personnel
        $grp = DB::table('group_of_personnel')
                    ->select(
                        'title',
                        'id_shopfloor'
                    )
                    ->where('id', $id)
                    ->get();

        $grp = json_decode($grp, true);
        $grp = $grp[0];
        $grp['id'] = $id;

        // current shopfloor
        $shopfloor = DB::table('shopfloor')
        				->select(
        					'title'
        				)
        				->where('id', $grp['id_shopfloor'])
        				->get();
        $shopfloor = json_decode($shopfloor, true);


        // получаем группы персонала и их цеха
        $shopfloors = DB::table('shopfloor')
						->select(
							'id',
							'title'
						)
						->get();
		$shopfloors = json_decode($shopfloors, true);
		// return $shopfloors;


        $data['grp'] = $grp;
        $data['shopfloor'] = $shopfloor;
        $data['shopfloors'] = $shopfloors;

    	return view('backend.auth.group_of_personnel.edit', $data);

    }


    public function editGroupOfPersonnel(Request $request, $id) {

        $id_group_of_personnel = $id; 
        $title_group_of_personnel = $request->input('group_of_personnel'); 
        $id_shopfloor = $request->input('shopfloor'); 
        // return $request;
        if(!empty($title_group_of_personnel) && !empty($id_shopfloor)) {

        	$exist_grp = DB::table('group_of_personnel')
			        		->select(
			        			'id'
			        		)
			        		->where('id_shopfloor', $id_shopfloor)
			        		->where('title', $title_group_of_personnel)
			        		->get();
			$exist_grp = json_decode($exist_grp);
			// если имеется такая же группа персонала в таком цеху
			if ($exist_grp) {
				return redirect()->route('admin.auth.group_of_personnel.index')->with('grp_existed', __('alerts.backend.group_of_personnel.existed'));
			}


            $grp = DB::table('group_of_personnel')
                        ->where('id', $id_group_of_personnel)
                        ->update([
                        	'id_shopfloor' => $id_shopfloor,
                        	'title' => $title_group_of_personnel
                        ]);

            return redirect()->route('admin.auth.group_of_personnel.index')->with('grp_updated', __('alerts.backend.group_of_personnel.updated'));
        } else {
            return redirect()->route('admin.auth.group_of_personnel.index')->with('error', __('alerts.backend.group_of_personnel.error'));            
        }

    }

    public function showAddGroupOfPersonnel() {

    	// получаем группы персонала и их цеха
        $shopfloors = DB::table('shopfloor')
						->select(
							'id',
							'title'
						)
						->get();
		$shopfloors = json_decode($shopfloors, true);

		$data['shopfloors'] = $shopfloors;

    	return view('backend.auth.group_of_personnel.add', $data);

    }


    public function addGroupOfPersonnel(Request $request) {
    	
		$title_group_of_personnel = $request->input('group_of_personnel');
		$id_shopfloor = $request->input('shopfloor');
        
         if(!empty($title_group_of_personnel) && !empty($id_shopfloor)) {

        	$exist_grp = DB::table('group_of_personnel')
			        		->select(
			        			'id'
			        		)
			        		->where('id_shopfloor', $id_shopfloor)
			        		->where('title', $title_group_of_personnel)
			        		->get();
			$exist_grp = json_decode($exist_grp);
			// если имеется такая же группа персонала в таком цеху
			if ($exist_grp) {
				return redirect()->route('admin.auth.group_of_personnel.index')->with('grp_existed', __('alerts.backend.group_of_personnel.existed'));
			}



            $grp = DB::table('group_of_personnel')
                        ->insert([
                        	'title' => $title_group_of_personnel,
                        	'id_shopfloor' => $id_shopfloor

                        ]);

            return redirect()->route('admin.auth.group_of_personnel.index')->with('grp_added', __('alerts.backend.group_of_personnel.added'));
        } else {
            
        	return redirect()->route('admin.auth.group_of_personnel.index')->with('error', __('alerts.backend.group_of_personnel.error'));
        }

    }


    public function searchGroupOfPersonnel(Request $request) {

        $search = $request->input('search');
        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];
        // return $search;
        $search_grp = DB::table('group_of_personnel')
        			->join('shopfloor', 'group_of_personnel.id_shopfloor', '=', 'shopfloor.id')
        			->select('shopfloor.title as shopfloor_title', 'group_of_personnel.title as title', 'group_of_personnel.id as id')
                    ->where('group_of_personnel.title', 'LIKE', '%'.$search.'%')
                    ->orderBy('id', 'asc')
                    ->get();

        $search_grp = array_values(json_decode($search_grp, true));


        $count = count($search_grp);

        $page = $request->page;
        $perPage = $count_of_page;
        $offset = ($page-1) * $perPage;

        $arr_item = array_slice($search_grp, $offset, $perPage);
        // from array to object
        $arr_item = json_decode(json_encode($arr_item), FALSE);

        $item_page = new LengthAwarePaginator($arr_item, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);



        $data['group_of_personnel'] = $item_page;
        // return $data['group_of_personnel'];

        return view('backend.auth.group_of_personnel.index', $data);
        // return $search_mat;


    }


    /*
     * Получение всех цехов
     */
    public function getShopfloor() {

        $shopfloor = DB::table('shopfloor')
				->select(
					'id',
					'title'
				)
				->get();
        $shopfloor = json_decode($shopfloor, true);

        return $shopfloor;

    }


    /*
     * Получение групп персонала, входящих в определенный цех
     */
    public function getGroupOfPersonnel(Request $request) {
    	$id_shopfloor = $request->input('id');

        $group_of_personnel = DB::table('group_of_personnel')
                    ->select(
                    	'id',
                        'title'
                    )
                    ->where('id_shopfloor', $id_shopfloor)
                    ->get();

        $group_of_personnel = json_decode($group_of_personnel, true);

        return $group_of_personnel;

    }


    /*
     * Получение групп персонала, входящих в определенный цех и куда входит сотрудник этого цеха
     */
    public function getGroupOfPersonnelByWorker(Request $request) {
    	$id_shopfloor = $request->input('id_shopfloor');
    	$id_worker = $request->input('id_worker');


        $group_of_personnel = DB::table('list_of_personnel_of_worker')
        						->join('group_of_personnel', 'list_of_personnel_of_worker.id_personnel', '=', 'group_of_personnel.id')
			                    ->select(
			                    	'group_of_personnel.title as title',
			                        'group_of_personnel.id as id'
			                    )
			                    ->where('id_worker', $id_worker)
			                    ->get();

        $group_of_personnel = json_decode($group_of_personnel, true);
        // return $group_of_personnel;

        $all_group_of_personnel = DB::table('group_of_personnel')
				                    ->select(
				                    	'id',
				                        'title'
				                    )
				                    ->where('id_shopfloor', $id_shopfloor)
				                    ->get();

        $all_group_of_personnel = json_decode($all_group_of_personnel, true);



        // выставляем ключ checked
        for ($i = 0; $i < count($group_of_personnel); $i++) {

	        for ($j = 0; $j < count($all_group_of_personnel); $j++) {

		        if (in_array($group_of_personnel[$i]['id'], $all_group_of_personnel[$j])) {
		        	$all_group_of_personnel[$j]['checked'] = true;
		        }
		    }
	    }

	    $data['all_group_of_personnel'] = $all_group_of_personnel;

        return $data;

    }


    /*
     * Получение материалов, относящихся к определенной группе персонала
     */
    public function getMaterial(Request $request) {

    	$id_group_of_personnel = $request->input('id_group_of_personnel');

    	// materials related to the current group of personnel
        $material = DB::table('list_of_materials')
        						->join('materials', 'list_of_materials.id_material', '=', 'materials.id')
			                    ->select(
			                    	'materials.id as id',
			                        'materials.title as title'
			                    )
			                    ->where('id_personnel', $id_group_of_personnel)
			                    ->get();

        $material = json_decode($material, true);


        $all_material = DB::table('materials')
			                    ->select(
			                    	'id',
			                        'title'
			                    )
			                    ->get();

        $all_material = json_decode($all_material, true);


        // выставляем ключ checked
        for ($i = 0; $i < count($material); $i++) {

	        for ($j = 0; $j < count($all_material); $j++) {

		        if (in_array($material[$i]['id'], $all_material[$j])) {
		        	$all_material[$j]['checked'] = true;
		        }
		    }
	    }

	    
        $data["all_material"] = $all_material;

        return $data;


    }




    /*
     * Добавление материала к группе персонала
     */
    public function showAddMaterialToGroup() {
    	// return $this->getMaterial(3);
        $data['shopfloor'] = $this->getShopfloor();

        return view('backend.auth.group_of_personnel.add-material-to-group-of-personnel', $data);
        
    }


    public function addMaterialToGroup(Request $request) {

    	$request = $request->all();
    	$id_group_of_personnel = $request['group_of_personnel'];
    	$shopfloor = $request['shopfloor'];
    	$id_material = array_values(array_slice($request, 3));
    		
    	if (!empty($id_group_of_personnel) && !empty($shopfloor) && !empty($id_material)) {


    		DB::table('list_of_materials')
    			->where('id_personnel', $id_group_of_personnel)
    			->delete();

	    	// return $request;
	    	for ($i = 0; $i < count($id_material); $i++) {

		    	$grp = DB::table('list_of_materials')
	                        ->insert([
	                        	'id_personnel' => $id_group_of_personnel,
	                        	'id_material' => $id_material[$i]
	                        ]);

	        }


         	return redirect()->route('admin.auth.group_of_personnel.add_mat_to_group.show')->with('mat_added', __('alerts.backend.group_of_personnel.action.mat_added_to_group'));
        } else {
            
        	return redirect()->route('admin.auth.group_of_personnel.index')->with('error', __('alerts.backend.group_of_personnel.action.error'));
        }


    }



    /*
     * Получение всех работников
     */
    public function getWorker() {

    	$workers = DB::table('workers')
				->select(
					'id',
					'name',
					'lastname',
					'middlename'
				)
				->get();
        $workers = json_decode($workers, true);

        return $workers;

    }


    /*
     * Добавление сотрудника к группе персонала
     */
    public function showAddWorkerToGroup() {

    	$data['worker'] = $this->getWorker();

        return view('backend.auth.group_of_personnel.add-worker-to-group-of-personnel', $data);

    }


    public function addWorkerToGroup(Request $request) {

    	$request = $request->all();
    	$worker = $request['worker'];
    	$shopfloor = $request['shopfloor'];
    	$id_group_of_personnel = array_values(array_slice($request, 3));
    		
    	if (!empty($id_group_of_personnel) && !empty($shopfloor) && !empty($id_group_of_personnel)) {


    		DB::table('list_of_personnel_of_worker')
    			->where('id_worker', $worker)
    			->delete();

	    	// return $request;
	    	for ($i = 0; $i < count($id_group_of_personnel); $i++) {

		    	$grp = DB::table('list_of_personnel_of_worker')
	                        ->insert([
	                        	'id_worker' => $worker,
	                        	'id_personnel' => $id_group_of_personnel[$i]
	                        ]);

	        }


         	return redirect()->route('admin.auth.group_of_personnel.add_worker_to_group.show')->with('wrk_added', __('alerts.backend.group_of_personnel.action.worker_added_to_group'));
        } else {
            
        	return redirect()->route('admin.auth.group_of_personnel.index')->with('error', __('alerts.backend.group_of_personnel.action.error'));
        }


    }



}	
