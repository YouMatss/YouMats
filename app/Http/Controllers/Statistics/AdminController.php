<?php

namespace App\Http\Controllers\Statistics;

use App\Helpers\Classes\CollectionPaginate;
use App\Models\Log;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AdminController
{
    /**
     * @return Application|Factory|View
     */
    public function dashboard() {
        $data['subscribed_vendors'] = Vendor::join('subscribes', 'subscribes.vendor_id', 'vendors.id')
            ->whereDate('subscribes.expiry_date', '>', now())->select('vendors.id', 'vendors.name')
            ->groupBy('vendor_id')->get();

        return view('statistics.dashboard')->with($data);
    }

    public function getLogs(Request $request) {
        $data['subscribed_vendors'] = Vendor::join('subscribes', 'subscribes.vendor_id', 'vendors.id')
            ->whereDate('subscribes.expiry_date', '>', now())->select('vendors.id', 'vendors.name')
            ->groupBy('vendor_id')->get();

        $data['logs'] = Log::where('page_type', Vendor::class)
            ->where('page_id', $request->vendor_id)
            ->whereDate('created_at', '>=', $request->date_from)
            ->whereDate('created_at', '<=', $request->date_to)
            ->orderBy('created_at')->get();

        return view('statistics.dashboard')->with($data);
    }

    public function trackIp($ip) {
        $data['logs'] = Log::where('ip', $ip)
            ->orderBy('created_at')->get();
        $data['ip'] = $ip;
        $data['country'] = $data['logs'][0]->country ?? '';
        $data['city'] = $data['logs'][0]->city ?? '';

        return view('statistics.ip')->with($data);
    }
}
