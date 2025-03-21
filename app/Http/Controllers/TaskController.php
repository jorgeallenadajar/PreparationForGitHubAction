<?php

namespace App\Http\Controllers;

use App\Models\tm_task;
use App\Models\tm_task_scope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{




    public function get_task_data()
    {
        $data_arr = [];
        $events = tm_task::where('status', 1)->get();
        // $events = DB::table("events")->get();

        foreach ($events as $index => $event) {
            $data_arr[$index]['event_id'] = $event->id;
            $data_arr[$index]['title'] = $event->task_name;
            $data_arr[$index]['start'] = date("Y-m-d", strtotime($event->start_date));
            $data_arr[$index]['end'] = date("Y-m-d", strtotime($event->end_date));
            $data_arr[$index]['color'] = '#' . substr(uniqid(), -6);
        }
        return response()->json([
            'status' => true,
            'msg' => 'successfully!',
            'data' => $data_arr
        ]);
    }


    public function add_task(Request $request)
    {
        DB::table('events')->insert([
            'start_date' => $request->event_start_date,
            'end_date' => $request->event_end_date,
            'event_name' => $request->event_name,
        ]);
        return [
            'status' => 1
        ];
    }

    public function get_users_data(Request $request)
    {
        $data = User::where('status', 1)
            ->where(DB::raw("CONCAT(fname, ' ', lname)"), 'LIKE', '%' . $request->searchTerm . '%')
            ->limit(400)
            ->get();
        $data_new = [];
        foreach ($data as $dt) {
            $data_new[] = array("id" => $dt->id, "text" => $dt->fname . ' ' . $dt->lname);
        }
        return $data_new;
    }

    public function get_scope_data(Request $request)
    {
        $hmtl = '';
        $sql = tm_task_scope::whereNull('task_id')->where('status', 1)->where('task_token', $request->value_page_token)->get();
        foreach ($sql as $row) {

            $hmtl .= '
            <tr>
            <td>
            ' . htmlspecialchars($row->scope_name) . '
            </td>
            <td>   ' . htmlspecialchars($row->remarks) . '</td>
            <td>
                <button class="btn btn-info"><i class="bi bi-pencil-square"></i></button>
            </td>
            </tr>
            
            
            ';
        }
        return $hmtl;
    }

    // status 1,2 3 -> Pending,On Going, Done
}
