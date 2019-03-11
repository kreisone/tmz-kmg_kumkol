<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class MaterialController extends Controller
{

    public function index() {



        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];

        $materials = DB::table('materials')
                    ->orderBy('id', 'asc')
                    ->paginate($count_of_page);
                    
        $data['materials'] = $materials;

        // return $data;

    	return view('backend.auth.material.index', $data);

    }


    public function deleteMaterial($id) {

    	try {
    		// $exist_mat = DB::table('materials')
	    	// 				->where('id', $id)
	    	// 				->get();
	    	// 				// return $exist_mat;
    		// if (!isset($exist_mat)) {
    		// 	return 1;

		    	DB::table('materials')
		    		->where('id', $id)->delete();
    		
		    	return redirect()
		    				->route('admin.auth.material.index')
		    				->with('mat_deleted', __('alerts.backend.materials.deleted'));
		    // } else {
    			// return 0;
		    // } 

    	} catch (Exception $e) {
				return redirect()
	    					->route('admin.auth.material.index')
	    					->with('mat_deleted', __('alerts.backend.materials.error'));
    		// return $e;
    	}

    }



    public function showEditMaterial($id) {

        $mat = DB::table('materials')
                    ->select(
                        'title'
                    )
                    ->where('id', $id)
                    ->get();
        $mat = json_decode($mat, true);
        $mat = $mat[0];
        $mat['id'] = $id;

        $data['mat'] = $mat;

    	return view('backend.auth.material.edit', $data);

    }


    public function editMaterial(Request $request, $id) {

        $title = $request->input('title'); 

        if(!empty($title)) {

            $mat = DB::table('materials')
                        ->where('id', $id)
                        ->update(['title' => $title]);

            return redirect()->route('admin.auth.material.index')->with('mat_updated', __('alerts.backend.materials.updated'));
        } else {
            return redirect()->route('admin.auth.material.index')->with('error', __('alerts.backend.materials.error'));            
        }

    }


    public function showAddMaterial() {

        return view('backend.auth.material.add');

    }

    public function addMaterial(Request $request) {

        $title = $request->input('title');
        
        if(!empty($title)) {

            $mat = DB::table('materials')
                        ->insert(
                            ['title' => $title]
                        );

            return redirect()->route('admin.auth.material.index')->with('mat_added', __('alerts.backend.materials.added'));
        } else {
            
        	return redirect()->route('admin.auth.material.index')->with('error', __('alerts.backend.materials.error'));
        }

    }


    public function searchMaterial(Request $request) {

        $search = $request->input('search');
        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];
        // // return $search;
        // $search_mat = DB::table('materials')
        //             ->where('title', 'LIKE', '%'.$search.'%')
        //             ->paginate($count_of_page);


        $search_mat = DB::table('materials')
                    ->where('title', 'LIKE', '%'.$search.'%')
                    ->get();

        $search_mat = array_values(json_decode($search_mat, true));



        $count = count($search_mat);

        $page = $request->page;
        $perPage = $count_of_page;
        $offset = ($page-1) * $perPage;

        $arr_item = array_slice($search_mat, $offset, $perPage);
        // from array to object
        $arr_item = json_decode(json_encode($arr_item), FALSE);

        $item_page = new LengthAwarePaginator($arr_item, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);




        $data['materials'] = $item_page;
        // return $data;

        return view('backend.auth.material.index', $data);
        // return $search_mat;


    }


    

}
