<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopfloorController extends Controller
{
    
	public function index($search = '') {



        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];

        $shopfloor = DB::table('shopfloor')
                    ->orderBy('id', 'asc')
                    ->paginate($count_of_page);
                  
        $data['shopfloor'] = $shopfloor;



    	return view('backend.auth.shopfloor.index', $data);

    }


    public function deleteShopfloor($id) {

    	try {
    		// $exist_shp = DB::table('shopfloor')
	    	// 				->where('id', $id)
	    	// 				->get();
	    	// 				// return $exist_shp;
    		// if (!isset($exist_shp)) {
    		// 	return 1;

		    	DB::table('shopfloor')
		    		->where('id', $id)->delete();
    		
		    	return redirect()
		    				->route('admin.auth.shopfloor.index')
		    				->with('shp_deleted', __('alerts.backend.shopfloor.deleted'));
		    // } else {
    			// return 0;
		    // } 

    	} catch (Exception $e) {
				return redirect()
	    					->route('admin.auth.shopfloor.index')
	    					->with('shp_deleted', __('alerts.backend.shopfloor.error'));
    		// return $e;
    	}

    }



    public function showEditShopfloor($id) {

        $shp = DB::table('shopfloor')
                    ->select(
                        'title'
                    )
                    ->where('id', $id)
                    ->get();
        $shp = json_decode($shp, true);
        $shp = $shp[0];
        $shp['id'] = $id;

        $data['shp'] = $shp;

    	return view('backend.auth.shopfloor.edit', $data);

    }


    public function editShopfloor(Request $request, $id) {

        $title = $request->input('title'); 

        if(!empty($title)) {

            $shp = DB::table('shopfloor')
                        ->where('id', $id)
                        ->update(['title' => $title]);

            return redirect()->route('admin.auth.shopfloor.index')->with('shp_updated', __('alerts.backend.shopfloor.updated'));
        } else {
            return redirect()->route('admin.auth.shopfloor.index')->with('error', __('alerts.backend.shopfloor.error'));            
        }

    }


    public function showAddShopfloor() {
    	
        return view('backend.auth.shopfloor.add');

    }

    public function addShopfloor(Request $request) {

        $title = $request->input('title');
        
        if(!empty($title)) {

            $shp = DB::table('shopfloor')
                        ->insert(
                            ['title' => $title]
                        );

            return redirect()->route('admin.auth.shopfloor.index')->with('shp_added', __('alerts.backend.shopfloor.added'));
        } else {
            
        	return redirect()->route('admin.auth.shopfloor.index')->with('error', __('alerts.backend.shopfloor.error'));
        }

    }


    public function searchShopfloor(Request $request) {

        $search = $request->input('search');
        $count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];
        // return $search;
        $search_shp = DB::table('shopfloor')
                    ->where('title', 'LIKE', '%'.$search.'%')
                    ->get();

        $search_shp = json_decode($search_shp, true);



        
        $count = count($search_shp);

        $page = $request->page;
        $perPage = $count_of_page;
        $offset = ($page-1) * $perPage;

        $arr_item = array_slice($search_shp, $offset, $perPage);
        // from array to object
        $arr_item = json_decode(json_encode($arr_item), FALSE);

        $item_page = new LengthAwarePaginator($arr_item, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        

        $data['shopfloor'] = $item_page;
        // return $data;

        return view('backend.auth.shopfloor.index', $data);
        // return $search_shp;


    }


}
