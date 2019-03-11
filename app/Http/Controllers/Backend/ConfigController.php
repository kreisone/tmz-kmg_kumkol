<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ConfigController extends Controller
{
    
	public function index() {

		$count_of_page = DB::table('config')
                            ->select('pagination')
                            ->get();
        $count_of_page = json_decode($count_of_page, true);
        $count_of_page = $count_of_page[0]['pagination'];
		$data['count_of_page'] = $count_of_page;


		return view('backend.auth.config.index', $data);

	}


	public function save(Request $request) {

		$count_of_page = $request->input('count_of_page');

		DB::table('config')
	        ->update([
	        	'pagination' => $count_of_page
        	]);

		return redirect()
    				->route('admin.auth.config.index')
    				->with('config_saved', __('alerts.backend.config.saved'));

	}

}
