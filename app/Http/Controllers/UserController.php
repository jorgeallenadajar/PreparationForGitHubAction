<?php

namespace App\Http\Controllers;

use App\Models\ict_lib_category;
use App\Models\ict_lib_department;
use App\Models\ict_lib_files;
use App\Models\ict_lib_position;
use App\Models\ict_lib_system;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class UserController extends Controller
{

    public function user_management()
    {
        return view("components.ict_lib_user_management");
    }

    public function ict_lib_dashboard()
    {
        $systems = ict_lib_system::where('status', 1)->count();
        $category = ict_lib_category::where('status', 1)->count();
        $files = ict_lib_files::where('status', 1)->count();
        $user = User::where('status', 1)->count();

        return view("components.ict_lib_dashboard", compact(['systems', 'category', 'user', 'files']));
    }
    public function get_department(Request $request)
    {
        $data = ict_lib_department::where('status', 1)
            ->where('department', 'LIKE', '%' . $request->searchTerm . '%')
            ->limit(400)->get();
        $data_new = [];
        foreach ($data as $dt) {
            $data_new[] = array("id" => $dt->id, "text" => $dt->department);
        }
        return $data_new;
    }

    public function get_position(Request $request)
    {
        $data = ict_lib_position::where('status', 1)
            ->where('position', 'LIKE', '%' . $request->searchTerm . '%')
            ->limit(400)->get();
        $data_new = [];
        foreach ($data as $dt) {
            $data_new[] = array("id" => $dt->id, "text" => $dt->position);
        }
        return $data_new;
    }

    public function get_users()
    {
        $data = User::with(['company', 'get_systems', 'get_department', 'get_position'])->where('status', 1)->get();

        return DataTables::of($data)
            ->addColumn('full_name', function ($data) {
                return $data->fname . ' ' . $data->lname;
            })

            ->addColumn('action', function ($data) {
                $action = '
              <button type="button" data-id=' . $data->id . '  class="btn btn-info btn_edit">Edit</button>
            <button type="butt on" data-id=' . $data->id . ' class="btn btn-danger btn_delete">Delete</button>
              ';

                return $action;

            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function add_users(Request $request)
    {
        $response = [];
        $user_val = User::where('username', $request->username)->where('status', 1)->first();
        if ($user_val) {
            $response = [
                'status' => 0,
                'message' => 'There is an existing Username please try again'
            ];
            return json_encode($response);
        }

       


        $request->merge([
            'comp_id' => 1,
            'status' => 1,
            'date_created' => Carbon::now(),
            'password' => rock_my_world($request->password, 'encrypt')
        ]);

        User::create($request->all());
        $response = [
            'status' => 1,
            'message' => 'User Is Successfully Added'
        ];

        return json_encode($response);

    }


    public function retrieve_user($id)
    {
        $user = User::with(['company', 'get_systems', 'get_department', 'get_position'])->where('id', $id)->first();
        $userArray = $user->toArray();
        $userArray['orig_pass'] = rock_my_world($user->password, 'decrypt');
        return json_encode($userArray);


    }

    public function delete_user($id)
    {
        User::where('id', $id)->update(['status' => 0]);
    }



    public function edit_users(Request $request)
    {

        $validation = User::whereNot('id', $request->id)
            ->where('username', $request->username)
            ->first();
        if ($validation) {
            $response = [
                'status' => 0,
                'message' => 'There is an existing Username, please try again'
            ];
            return json_encode($response);
        }

        $request->merge([
            'password' => rock_my_world($request->password, 'encrypt')
        ]);

        $userId = $request->id;
        unset($request['id']);
        User::where('id', $userId)->update($request->all());

        $response = [
            'status' => 1,
            'message' => 'User Is Successfully Updated'
        ];

        return json_encode($response);
    }



    //8 min ->string only letters with numbers


    // public function upload(Request $request)
    // {
    //     $user_id = Session::get('xuser_id');


    //     foreach ($request->file('filers') as $item) {
    //         $ext = $item->getClientOriginalExtension();
    //         $fname = $item->getClientOriginalName();
    //         $year = Carbon::now()->year;
    //         $format_name = now()->format('YmdHis') . '_' . mt_rand('1111', '9999');
    //         // $new_file = new files();
    //         // $new_file->item_id = $request->itemers_id;
    //         // $new_file->file_name =   $format_name . '.' . $ext;
    //         // $new_file->orig_name = $fname;
    //         // $new_file->save();
    //         $insert = DB::table('mr_supp_documents')->insert([
    //             "user_id" => $user_id,
    //             "mr_id" => $request->itemers_id,
    //             "filename" => $format_name . '.' . $ext,
    //             "folder" => $year,
    //             "date_created" => Carbon::now(),
    //             "status" => 1
    //         ]);
    //         $item->move('supp_files/' . $year . '/', $format_name . '.' . $ext);
    //     }



    // $('#uploads').click(function() {
    //     var filers = $('#filers')[0].files;
    //     var items_id = $('#item_id_id').val();
    //     filerop = []
    //     var forms = new FormData();
    //     for (let i = 0; i < filers.length; i++) {
    //         forms.append('filers[]', filers[i]);
    //         filerop.push(filers[i]);
    //     }
    //     if (filerop.length == 0) {
    //         return alert('Please Upload file');
    //     }
    //     forms.append('_token', "{{ csrf_token() }}");
    //     forms.append('itemers_id', items_id);

    //     console.log(items_id);
    //     $.ajax({
    //         url: "{{ route('uploads') }}",
    //         type: "POST",
    //         processData: false,
    //         contentType: false,
    //         data: forms,
    //         success: function(e) {
    //             $('#filers').val('');
    //             alertify.success('Successfully Uploaded')
    //             $('#tbl_file').DataTable().ajax.reload();




    //         }
    //     });





    // });




}
