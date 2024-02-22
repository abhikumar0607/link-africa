<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\SupportTicket;
use Carbon\Carbon;
class TicketExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $record = SupportTicket::all();
        $all_records = [];
        foreach ($record as $key => $value) {

        $resolution_date = "";
        if($value->resolution_date){
        $resolution_date = Carbon::parse($value->resolution_date)->format('Y-m-d');
        }
            $all_records[] = [
                'id' => $value->id,
                'ticket_id' => $value->ticket_id,
                'user_id' => $value->user_id,
                'description' => $value->description,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'subject' => $value->subject,
                'ticket_closed_date' => $value->ticket_closed_date,
                'ticket_status' => $value->ticket_status,
                'requester' => $value->requester,    
                'requester_email_address' => $value->requester_email_address,  
                'depaertment' => $value->depaertment,  
                'location' => $value->location,  
                'priority' => $value->priority,  
                'impact' => $value->impact,  
                'service' => $value->service,  
                'category' => $value->category,  
                'assignement_group' => $value->assignement_group,  
                'assigne' => $value->assigne,  
                'external_vendor' => $value->external_vendor,
                'external_reference' => $value->external_reference,  
                'resolution_date' => $resolution_date,  
                'resolution_comment' => $value->resolution_comment,    
            ];
           
    }
    return collect($all_records);
    }
    public function headings(): array
    {
        return [
          'Id',
          'Ticket Id',
          'User Id',
          'Description',
          'Status',
          'created_at',
          'Subject',
          'Ticket Closed Date',
          'Ticket Status',
          'Requester',
          'Requester Email Address',
          'Department',
          'Location',
          'Priority',
          'Impact',
          'Service',
          'Category',
          'Assignement Group',
          'Assigne',
          'External Vendor',
          'External Reference',
          'Resolution Date',
          'Resolution Comment',
        ];
    }
}

