<?php

namespace App\Exports;

use App\Http\Requests\Request;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ExportCustomer implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(Request $request)
    {
        $column = array(["Project Id", "Project Name",  'Customer ID', 'Customer Name', "School Code", "District", "Principal Name", "Mobile"]);


        $data = DB::table('customers')
            ->leftJoin('projects', 'projects.id', '=', 'customers.project_id')
            ->select('customers.project_id', 'projects.name as project_name', 'customers.id as customer_id', 'customers.name as customer_name', 'customers.code', 'customers.district', 'customers.principal_name', 'customers.mobile')
            ->where('customers.deleted', '1');
            if(isset($request->work_profile_id) && strlen($request->work_profile_id))
            $data->get();
        $data = $data->toarray();
        $result = array_merge($column, $data);
        return  collect($result);

        // return Customer::all();
    }
}
