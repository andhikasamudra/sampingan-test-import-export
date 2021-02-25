<?php

namespace App\Http\Controllers;

use App\Exports\DisbursementExport;
use App\Imports\DisbursementImport;
use App\Models\BusinessUnit;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\Disbursement;
use App\Models\Project;
use App\Utils\Initials;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = Disbursement::groupBy('batch')
            ->orderBy('batch', 'desc')
            ->select('batch')
            ->paginate(15);
        $count_number = $this->getPageCountNumber($request->page);
        return view("pages.index", compact('data', 'count_number'));
    }

    public function upload(Request $request)
    {
        $data = Excel::toArray(new DisbursementImport, $request->file('file'))[0];
        unset($data[0]);
        $batch = Disbursement::orderBy('id', 'desc')->first();
        if (empty($batch)) {
            $batch = 1;
        } else {
            $batch = $batch->batch + 1;
        }
        foreach ($data as $item) {
            $project = $this->getOrCreateProject($item[11]);
            $costcenter = CostCenter::where('type_of_cost', $item[12])->first();
            $business_unit = BusinessUnit::where("name", $item[9])->where("sub_name", $item[10])->first();
            $company = $this->getOrCreateCompany($item[13]);


            Disbursement::create([
                'business_unit_id' => $business_unit->id,
                'project_id' => $project->id,
                'costcenter_id' => $costcenter->id,
                'company_id' => $company->id,
                'amount' => $item[1],
                'bank_name' => $item[2],
                'bank_account_name' => $item[3],
                'bank_account_number' => $item[4],
                'email' => $item[5],
                'email_cc' => $item[6],
                'email_bcc' => $item[7],
                'submitter' => $item[8],
                'batch' => $batch
            ]);
        }

        return redirect()->back()->with(["message" => "Input Stored"]);
    }

    public function getOrCreateProject($project_name): Project
    {
        $project = Project::where("name", $project_name)->first();

        if (empty($project)) {
            $project = new Project();
            $project->name = $project_name;
            $project->guid = Str::uuid();
            $project->slug = Str::slug($project_name);
            $project->save();
        }

        return $project;
    }

    public function getOrCreateCompany($company_name): Company
    {
        $company = Company::where("name", $company_name)->first();

        if (empty($company)) {
            $company = new Company();
            $company->name = $company_name;
            $company->code = Initials::generate($company_name);
            $company->save();

            $company->code = $company->code . $company->id;
            $company->save();
        }

        return $company;
    }

    public function download(Request $request)
    {
        $filename = "Download_batch_" . $request->batch . ".xlsx";
        return Excel::download(new DisbursementExport($request->batch), $filename);
    }
}
