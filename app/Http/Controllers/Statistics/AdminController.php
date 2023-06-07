<?php

namespace App\Http\Controllers\Statistics;

use App\Models\Category;
use App\Models\Log;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController
{
    public function getLogs(Request $request) {
        $data['vendors'] = Vendor::whereActive(true)->get();
        $data['categories'] = Category::all();

//        $data['visits'] = $query->where('type', 'visit')->count();
//        $data['calls'] = $query->where('type', 'call')->count();
//        $data['chats'] = $query->where('type', 'chat')->count();
//        $data['emails'] = $query->where('type', 'email')->count();
        return view('statistics.dashboard')->with($data);
    }

    public function getLogsAjax(Request $request) {
        if ($request->ajax()) {
            parse_str(html_entity_decode($request->parameters), $parameters);

            $data = $this->methodToGetLogs($parameters);
            return DataTables::of($data)
                ->setTotalRecords($data->count())
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a>
                                <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function methodToGetLogs($request) {
        if($request['vendor_id']) {
            $products_ids = $this->get_products_ids('vendor', $request['vendor_id']);
            $query = Log::/*with([
                'page' => function($q) {
                    $q->pluck('name');
                }
            ])->*/where(function ($q) use ($request, $products_ids) {
                 $q->where(function ($q1) use ($request) {
                    $q1->where([
                        'page_type' => Vendor::class,
                        'page_id' => $request['vendor_id']
                    ]);
                })->orWhere(function ($q2) use ($products_ids) {
                    $q2->where('page_type', Product::class)
                        ->whereIn('page_id', $products_ids);
                });
            });
        }
        if($request['category_id']) {
            $products_ids = $this->get_products_ids('category', $request['category_id']);
            $query = Log::where(function ($q) use ($request, $products_ids) {
                $q->where(function ($q1) use ($request) {
                    $q1->where([
                        'page_type' => Category::class,
                        'page_id' => $request['category_id']
                    ]);
                })->orWhere(function ($q2) use ($products_ids) {
                    $q2->where('page_type', Product::class)
                        ->whereIn('page_id', $products_ids);
                });
            });
        }

        if($request['date_from'])
            $query->whereDate('created_at', '>=', $request['date_from']);

        if($request['date_to'])
            $query->whereDate('created_at', '<=', $request['date_to']);

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function trackIp($ip) {
        $data['logs'] = Log::where('ip', $ip)
            ->orderBy('created_at')->get();
        $data['ip'] = $ip;
        $data['country'] = $data['logs'][0]->country ?? '';
        $data['city'] = $data['logs'][0]->city ?? '';

        return view('statistics.ip')->with($data);
    }

    /**
     * @param $type
     * @param $model_id
     * @return mixed
     */
    private function get_products_ids($type, $model_id) {
        $type = ($type == 'category') ? 'category_id' : 'vendor_id';
        return Product::where($type, $model_id)->pluck('id');
    }
}
