<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ledger;
use Illuminate\Support\Facades\DB;

class LedgerController extends Controller
{

    public function index(Request $request)
    {
       
        $ledgerName = $request->input('ledger_name');
        $groupName = $request->input('group_name');
        $subGroupName = $request->input('sub_group_name');
        $apVersion = $request->input('ap_version');

        $query = DB::table('master.ledgers as l1')
            ->leftJoin('master.ledgers as l2', 'l1.parent_id', '=', 'l2.id')
            ->leftJoin('master.ledgers as l3', 'l2.parent_id', '=', 'l3.id')
            ->select(
                'l1.*',
                'l1.ledger_name as ledger_name',
                'l1.ap_version as ap_version',
                'l1.is_ledger as is_ledger',
                'l1.parent_id as ledger_parent_id',
                'l2.id as sub_group_id',
                'l2.ledger_name as sub_group_name',
                'l2.parent_id as sub_group_parent_id',
                'l3.id as group_id',
                'l3.ledger_name as group_name'
            )
            ->where('l1.is_ledger', true)
            ->orderBy('group_name')
            ->orderBy('sub_group_name')
           ->orderBy('ledger_name');

        if (!empty($ledgerName)) {
            $query->where('l1.ledger_name', 'ILIKE', '%' . $ledgerName . '%');
        }

        if (!empty($subGroupName)) {
            $query->where('l2.ledger_name', 'ILIKE', '%' . $subGroupName . '%');
        }

        if (!empty($groupName)) {
            $query->where('l3.ledger_name', 'ILIKE', '%' . $groupName . '%');
        }

        if (!empty($apVersion)) {
            $query->where('l1.ap_version', $apVersion);
        }

        $ledgers = $query->paginate(10);

        $ledgers->appends([
            'ledger_name' => $ledgerName,
            'group_name' => $groupName,
            'sub_group_name' => $subGroupName,
            'ap_version' => $apVersion,
        ]);

        return view('ledger.index', compact('ledgers'));
    }
}
