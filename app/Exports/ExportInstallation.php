<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class ExportInstallation implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data = "";

    public function __construct($filter_data)
    {
        $this->data = $filter_data;
    }

    public function collection()
    {
        $this->data = $this->data['filter_data'];

        $column = array(['Customer Code', 'Customer Name', "Project Name", "Team Name", "WorkProfile Name", "Completion Date", "Status('1'=Completed,'0'=Pending')", "District"]);

        $data = DB::table('installations')
            ->leftJoin('customers', 'customers.id', '=', 'installations.customer_id')
            ->leftJoin('projects', 'projects.id', '=', 'installations.project_id')
            ->leftJoin('teams', 'teams.id', '=', 'installations.team_id')
            ->leftJoin('work_profiles', 'work_profiles.id', '=', 'installations.work_profile_id')
            ->select('customers.code as customer_code', 'customers.name as customer_name', 'projects.name as project_name', 'teams.name as team_name', 'work_profiles.name as work_profile_name', 'installations.end_date',  'installations.status', 'customers.district')
            ->where('installations.deleted', '1');
        if (isset($this->data['work_profile_id']) && strlen($this->data['work_profile_id']) != 0) {
            $data = $data->where('installations.work_profile_id', $this->data['work_profile_id']);
        } else {
            if (isset($this->data['work_id']) && strlen($this->data['work_id']) != 0) {
                $data = $data->where('installations.work_profile_id', $this->data['work_id']);
            }
        }
        if (isset($this->data['status']) && strlen($this->data['status']) != 0) {
            $data = $data->where('installations.status', $this->data['status']);
        }
        if (isset($this->data['today']) && strlen($this->data['today']) != 0) {

            $today = GetTodayDate();
            $data = $data->where('installations.end_date', $today);
        }
        $data = $data->get();
        $data = $data->toarray();
        $result = array_merge($column, $data);
        return  collect($result);
    }
}
