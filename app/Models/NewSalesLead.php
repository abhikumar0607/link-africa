<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewSalesLead extends Model
{
    use HasFactory;
    protected $table = 'sale_leads';
    
     protected $fillable = ['date_intiated', 'customer_name', 'kam','segment','province','site_name','lease_term_months','expected_close_month','product','estimated_mrc','expected_invoice_month','sales_stage','estimated_nrc','actual_closing_date','probability','actual_invoice_date','comments'];
}
