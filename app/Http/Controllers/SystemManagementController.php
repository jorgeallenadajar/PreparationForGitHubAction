<?php

namespace App\Http\Controllers;

use App\Models\ict_lib_system;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SystemManagementController extends Controller
{




    public function system_management()
    {
        return view("components.ict_syetem_management");
    }


    public function add_system(Request $request)
    {

        $request->merge([
            'user_id' => auth::user()->id,
            'status' => 1,
            'date_created' => Carbon::now(),
        ]);
        ict_lib_system::create($request->all());





    }

    public function get_system_data()
    {

        $data = ict_lib_system::where('status', 1)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '
              <button type="button" data-id=' . $data->id . '  data-system="' . htmlspecialchars($data->system) . '" class="btn btn-info btn_edit">Edit</button>
            <button type="butt on" data-id=' . $data->id . ' class="btn btn-danger btn_delete">Delete</button>
              ';

                return $action;

            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function edit_system(Request $request)
    {

        $system_id = $request->id;
        unset($request['id']);
        ict_lib_system::where('id', $system_id)->update($request->all());

    }
    public function delete_system($id)
    {

        ict_lib_system::where('id', $id)->update([
            'status' => 0,
        ]);
    }


    // public function array()
    // {

    //     $array = [
    //         'name' => 'John Doe',
    //         'age' => 30,
    //         'email' => 'john@example.com',
    //     ];

     
    //     $json = json_encode($array);

        
    //     // $outputArray = json_decode($string, true);
    //     // print_r($outputArray);
    // }

}
