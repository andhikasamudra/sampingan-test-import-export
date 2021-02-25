<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    protected $table = 'disbursements';

    protected $fillable = [
        'business_unit_id',
        'project_id',
        'costcenter_id',
        'company_id',
        'amount',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'email',
        'email_cc',
        'email_bcc',
        'submitter',
        'batch'
    ];

    public function business_unit()
    {
        return $this->belongsTo(BusinessUnit::class, 'business_unit_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function costcenter()
    {
        return $this->belongsTo(CostCenter::class, 'costcenter_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
