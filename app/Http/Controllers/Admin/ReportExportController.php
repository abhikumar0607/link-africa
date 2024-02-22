<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Exports\ExportProjectAgeingReport; 
use App\Exports\ExportLASaleReport; 
use App\Exports\ExportOpenOrderBookReport; 
use App\Exports\ExportVcReport; 
use App\Exports\ExportServiceDeliveryReport; 
use App\Exports\O2capReportExport; 
use App\Exports\NrcReportExport; 
use App\Exports\ExportMrcReport;
use App\Exports\ExportReportForMoreThanNinetyDays;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use App\Models\PlanningMasterFile;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

use App\Exports\ExportSiteMasterfile;
use App\Exports\ExportPlanningMasterfile;
use App\Exports\ExportPermissionMasterfile;
use App\Exports\ExportBuildMasterfile;
use App\Exports\OrderManagementReport;
use App\Exports\ExportClient;
use App\Exports\ExportAllClient;
use App\Exports\LayerReport;
use App\Exports\MonthlyNewSaleExport;
use App\Exports\FinancialApprovalExport;
use App\Exports\SolidUpdatedExport;
use App\Exports\TotalProjectCostReport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ReportExportController extends Controller
{
    //function for generate project-ageing-report
    public function index(Request $request){
        //count according to date
        $current_date =  Carbon::now()->format('Y-m-d');
        $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
        $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
        $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
        $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');
        
        $current_date_count = SiteMasterFile::where('date_new', '=', $current_date)->count(); 
        $sixteen_sub_days_count = SiteMasterFile::where('date_new', '>', $sixteen_sub_days)->count(); 
        $nintyeen_sub_days_count = SiteMasterFile::where('date_new', '>', $nintyeen_sub_days)->count(); 
        $one_twitty_sub_count = SiteMasterFile::where('date_new', '>', $one_twitty_sub_days)->count(); 
        $more_then_one_twitty_sub_days_count = SiteMasterFile::where('date_new', '<', $more_then_one_twitty_sub_days)->count();  
        
        
      //Count all project status types
      $count_new_sale = SiteMasterFile::where('project_status', 'A) New Sales')->count();
      $count_new_inplanning = SiteMasterFile::where('project_status', 'B) New In-Planning')->count();
      $count_in_planning = SiteMasterFile::where('project_status', 'D) In-Planning')->count();
      $count_d_permissions = SiteMasterFile::where('project_status', 'F) Permissions')->count();
      $count_e_financial_approval = SiteMasterFile::where('project_status', 'H) Financial Approval')->count();
      $count_f_new_build = SiteMasterFile::where('project_status', 'I) New In-Build')->count();
      $count_i_toc_submitted = SiteMasterFile::where('project_status', 'K) TOC P1 Submitted-L2')->count();
      $count_j_toc_recieved = SiteMasterFile::where('project_status', 'L) TOC P2 Received-L2')->count();
      $count_l_cancelled = SiteMasterFile::where('project_status', 'Q) Cancelled')->count();
      $count_m_on_hold = SiteMasterFile::where('project_status', 'R) On-Hold')->count();
      $count_n_complete = SiteMasterFile::where('project_status', 'T) Complete')->count();
      $count_v_terminated = SiteMasterFile::where('project_status', 'U) Terminated')->count();
        
        //count for planning status type
        $count_a_new_sale = PlanningMasterFile::where('planning_status', 'A) New Sales')->count();
        $count_wp1_stage = PlanningMasterFile::where('planning_status', 'B) Wp1 Stage')->count();
        $count_wp2_complition = PlanningMasterFile::where('planning_status', 'C) Wp2 Compilation')->count();
        $count_d1_permissions = PlanningMasterFile::where('planning_status', 'D) Permissions')->count();
        $count_e_financial_requested = PlanningMasterFile::where('planning_status', 'E) Financial Approval Requested')->count();
        $count_wp2_planning = PlanningMasterFile::where('planning_status', 'F) Wp2 Planning Complete')->count();
        $count_f_on_hold = PlanningMasterFile::where('planning_status', 'F) On-Hold')->count();
        $count_i_planning_complete = PlanningMasterFile::where('planning_status', 'I) Planning Complete')->count();
        $count_m_cancelled = PlanningMasterFile::where('planning_status', 'M) Cancelled')->count();
        $count_o_terminate = PlanningMasterFile::where('planning_status', 'O) Terminated')->count();

        $view =  view('admin/report/report-dashboard', compact('current_date_count','sixteen_sub_days_count',
        'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count',
        'count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval',
        'count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled',
        'count_m_on_hold','count_n_complete','count_v_terminated','count_a_new_sale','count_wp1_stage','count_wp2_complition','count_d1_permissions',
        'count_e_financial_requested','count_wp2_planning',
        'count_f_on_hold','count_i_planning_complete','count_m_cancelled','count_m_cancelled','count_o_terminate'));
        return $view; 
    }

    //function for generate financial-approval-report
    public function export_solid_data_report(Request $request){
        return Excel::download(new SolidUpdatedExport($request), 'solid-Record-report.xlsx');
    }

    //function for generate financial-approval-report
    public function export_total_project_cost_report(Request $request){
        return Excel::download(new TotalProjectCostReport($request), 'total-project-cost-report.xlsx');
    }

    //function for generate financial-approval-report
    public function export_financial_approval_report(Request $request){
        return Excel::download(new FinancialApprovalExport($request), 'project-approval-report.xlsx');
    }
    //function for generate project-ageing-report
    public function export_monthly_new_report(Request $request){
        return Excel::download(new MonthlyNewSaleExport($request), 'monthly-new-sale-report.xlsx');
    }
    //function for generate project-ageing-report
    public function export_layer_report(Request $request){
        return Excel::download(new LayerReport($request), 'layer-report.xlsx');
    }
    //function for generate project-ageing-report
    public function export_client_report(Request $request){
        return Excel::download(new ExportAllClient($request), 'client-report.xlsx');
    }
    //function for generate report
    public function export_single_client_report(Request $request){
        return Excel::download(new ExportClient($request), 'client-report.xlsx');
    }
    //function for generate project-ageing-report
    public function export_project_ageint_report(Request $request){
        return Excel::download(new ExportProjectAgeingReport($request), 'project-ageing-report.xlsx');
    }
    //function for generate o2cap-report
    public function export_o2cap_report(Request $request){
        $export = new O2capReportExport; // Replace with your export class
        $filename = 'o2cap-report.xlsx'; // Replace with the desired filename
        $previousFilename = 'o2cap-report.xlsx'; // Previous report filename
        // Check if the previous report file exists and delete it
        $previousPath = public_path('upload/reports/o2cap'.$previousFilename);
        $directory = public_path('upload/reports/o2cap');
        $path = $directory . '/' . $filename;

        // Export the data to a temporary file with the CSV format
        $temp =  public_path('upload\tmp_folder');
        $temporaryFile1 = $temp . '/' . $filename;
       
        // Export the data to a temporary file with the CSV format
        $temporaryFile = tempnam(sys_get_temp_dir(), 'export');
        //$export->store('csv', $temporaryFile);
        
        // Move the temporary file to the desired path
        File::move($temporaryFile, $temporaryFile1);
        
        Excel::store($export, $temporaryFile1);
        

        //public_path("upload/reports/o2cap/".$previousFilename);
        $fileSize = filesize($temporaryFile1);
        if ($fileSize > 0) {
            if (file_exists($previousPath)) {
            if (File::exists($previousPath)) {
                File::delete($previousPath);
            }
            }
        File::move( $temporaryFile1, $path);   
       } else {
        // If the new file has no data, delete the temporary file
        File::delete($temporaryFile1);
      }
    }
    public function download_o2cap_csv(){
        // Define the path to the CSV file in the public folder
        $csvFilePath = public_path('upload/reports/o2cap/o2cap-report.xlsx');
        // Check if the file exists
        if (file_exists($csvFilePath) && filesize($csvFilePath) > 0) {
                // Set the appropriate headers for the response
                $headers = [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="o2cap-report.xlsx"',
                ];
    
                // Serve the file as a download response
                return Response::download($csvFilePath, 'o2cap-report.xlsx', $headers);
            } else {
                // Handle the case where the file doesn't exist
                return redirect()->back()->with('unsuccess', 'Please wait while the file is being generated.');
        }
        
    }

    
     //function for generate order-managment-report
     public function export_order_managment_report(Request $request){
        return Excel::download(new OrderManagementReport($request), 'order-managment-report.xlsx');
    }
    //function for generate nrc-report
    public function export_nrc_report(Request $request){
        return Excel::download(new NrcReportExport($request), 'nrc-report.xlsx');
    }
    //function for generate nrc-report
    public function export_mrc_report(Request $request){
        return Excel::download(new ExportMrcReport($request), 'mrc-report.xlsx');
    }
    //function for generate record older than 90 days
    public function export_older_than_ninety_report(Request $request){
        return Excel::download(new ExportReportForMoreThanNinetyDays($request), 'Record-older-than-90-days-report.xlsx');
    }
    //function for generate La Sale report
    public function export_la_sale_report(Request $request){
        return Excel::download(new ExportLASaleReport($request), 'la-sale-report.xlsx');
    }

    //function for generate open book report
    public function export_open_book_report(Request $request){
        return Excel::download(new ExportOpenOrderBookReport($request), 'open-book-report.xlsx');
    }

    //function for generate open book report
    public function export_vc_report_report(Request $request){
        return Excel::download(new ExportVcReport($request), 'vc-report.xlsx');
    } 
    
    //function for generate service delivery report
    public function export_service_delivery_report(Request $request){
        return Excel::download(new ExportServiceDeliveryReport($request), 'service-delivery-report.xlsx');
    }

    //function for export site master file 
    public function export_site_master_file(Request $request){
        return Excel::download(new ExportSiteMasterfile($request), 'site-master-file.xlsx');
    }

    //function for export planning master file
    public function export_planning_master_file(Request $request){
        return Excel::download(new ExportPlanningMasterfile($request), 'planning-master-file.xlsx');
    }

    //function for export permission master file
    public function export_permission_master_file(Request $request){
        return Excel::download(new ExportPermissionMasterfile($request), 'permission-master-file.xlsx');
    }

    //function for export build master file
    public function export_build_master_file(Request $request){
       return Excel::download(new ExportBuildMasterfile($request), 'build-master-file.xlsx');
    }
}
