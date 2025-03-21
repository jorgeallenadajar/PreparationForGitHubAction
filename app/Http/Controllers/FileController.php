<?php

namespace App\Http\Controllers;

use App\Models\ict_lib_files;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\ict_lib_system;
use App\Models\ict_lib_category;

class FileController extends Controller
{
    public function file_management()
    {

        return view('components.ict_lib_file_management');
    }

    public function get_categories_data(Request $request)
    {


        $data = ict_lib_category::where('status', 1)
            ->where('category', 'LIKE', '%' . $request->searchTerm . '%')
            ->limit(400)->get();
        $data_new = [];
        foreach ($data as $dt) {
            $data_new[] = array("id" => $dt->id, "text" => $dt->category);
        }
        return $data_new;
    }


    public function get_systems_data(Request $request)
    {
        $data = ict_lib_system::where("status", 1)
            ->where('system', 'LIKE', '%' . $request->searchTerm . '%')
            ->limit(400)->get();
        $data_new = [];
        foreach ($data as $dt) {
            $data_new[] = array("id" => $dt->id, "text" => $dt->system);
        }
        return $data_new;
    }



    public function upload_file(Request $request)
    {


        foreach ($request->file('filers') as $item) {
            if (!$item->isValid()) {
                return back()->withErrors(['filers' => 'One or more files are invalid']);
            }
            $ext = $item->getClientOriginalExtension();
            $fname = $item->getClientOriginalName();
            $year = Carbon::now()->year;
            $format_name = now()->format('YmdHis') . '_' . mt_rand('1111', '9999');
            $request->merge([
                'user_id' => Auth::user()->id,
                'year' => $year,
                'file_name' => $format_name . '.' . $ext,
                'orig_file_name' => $fname,
                'status' => 1,
                'date_created' => Carbon::now(),
                
            ]);
            $data = $request->except(['filers']);
            ict_lib_files::create($data);
            $item->move('system_file/' . $year . '/', $format_name . '.' . $ext);
        }
    }
    public function get_files_data()
    {
        $data = ict_lib_files::with(['get_user', 'get_category', 'get_system'])->where('status', 1)->get();


        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $path = 'system_file/' . $data->year . '/' . $data->file_name;
                $url = dynamic_file($path);
                return '
                <center>
                   <a href="' . $url . '" target="_blank" class="">' . htmlspecialchars($data->orig_file_name) . '</a>
                </center>
                        ';

            })
            ->addColumn('act_btn', function ($data) {


                return '
                
         <button type="button" data-id=' . $data->id . ' class="btn btn-danger btn_delete">Delete</button>
                ';


            })
            ->addColumn('uploader', function ($data) {

                return $data['get_user']['fname'] . ' ' . $data['get_user']['lname'];


            })
            ->rawColumns(['action','act_btn'])
            ->make(true);


    }

}
