<?php

namespace App\Http\Controllers;

use App\Models\ict_lib_category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller
{

    public function category_management()
    {


        return view("components.ict_lib_category_management");
    }

    public function add_category(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'category' => [
                    'required',
                    'min:5',
                    'max:50',
                    'unique:ict_lib_categories,category',

                ],
                // 'sample' => ['required', 'min:10', 'max:50']
            ],
            [
                'category.unique' => 'Kargado na to',
                // 'sample.required' => 'Kargado na to sobra'
            ]

        );

        if ($validated->fails()) {
            return ['errors' => $validated->errors()];
        }




        // if ($validated->fails()) {
        //     return ['errors' => ['category' => [$validated->errors()->first('category')]]];
        // }






        $request->merge([
            'user_id' => Auth::user()->id,
            'status' => 1,
            'date_created' => Carbon::now(),
        ]);
        $category = ict_lib_category::create($request->all());
        return ['success' => 'Sucessfully Inserted'];
    }

    public function categories_data()
    {


        $data = ict_lib_category::where('status', 1)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '
              <button type="button" data-id=' . $data->id . '  data-category="' . htmlspecialchars($data->category) . '" class="btn btn-info btn_edit">Edit</button>
            <button type="butt on" data-id=' . $data->id . ' class="btn btn-danger btn_delete">Delete</button>
              ';
                return $action;

            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function edit_category(Request $request)
    {
        $category_id = $request->id;

        $validated = Validator::make(
            $request->all(),
            [
                'category' => [
                    'required',
                    'min:5',


                ],

            ],


        );

        if ($validated->fails()) {
            return ['errors' => $validated->errors()];
        }



        unset($request['id']);
        $data = ict_lib_category::where('id', $category_id)->update($request->all());
        return ['success' => 'Sucessfully Edited'];
    }

    public function delete_category($id)
    {
        ict_lib_category::where('id', $id)->update([
            'status' => 0
        ]);
    }




}
