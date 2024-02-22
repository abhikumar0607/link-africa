<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin/export/o2cap-report','Admin\ReportExportController@export_o2cap_report');
Route::get('admin/get-solid-record','Admin\SolidDataController@get_solid_sale_data');
Route::get('admin/count-solid-record','Admin\SolidDataController@count_solid_records');

 Route::get('/', function () {
    return view('welcome');
 });

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');

        return "Cleared!";
    });

    Route::get('/comming-soon', function () {
        return view('comming-soon');
    });

    Route::get('/home','HomeController@index');
    //Admin common routing start here
	Route::get('admin-login','Admin\LoginController@index')->name('admin.login');  
	Route::post('/admin-submit', 'Admin\LoginController@dologin')->name('admin.login.submit');
    //Admin common routing end here 

Route::group(['middleware' => 'auth'], function(){
  
       //Admin Access Only
        Route::group(['middleware' => 'admin'], function(){
            //Route::get('admin/get/id','Admin\SiteMasterFileController@remove_u_service_id');
            //Route::get('admin/get/id','Admin\SiteMasterFileController@get_unmacthed_id');

        //delete record
        Route::get('admin/delete-record/{id}','Admin\SiteMasterFileController@delete_record');

        Route::get('admin/dashboard','Admin\DashboardController@index');
        Route::post('/admin-logout', 'Admin\DashboardController@logout')->name('admin.logout');
        //Import Master
        Route::get('admin/master/import-records','Admin\ImportMasterController@index');
        Route::post('admin/master/submit-import-records','Admin\ImportMasterController@submit_import_records')->name('admin.submit.master.import.records');
        //reset paswword
       Route::get('admin/reset/password','Admin\UserManageController@reset_password');
       Route::get('admin/send/email/reset','Admin\UserManageController@check_email');
        // main dashboard
        Route::get('admin/status-dashboard','Admin\DashboardController@main_dashboard');
        Route::get('admin/toc-monthly-dashboard','Admin\DashboardController@toc_monthy_dashboard');
        Route::get('admin/toc-received-monthly-dashboard','Admin\DashboardController@toc_recieved_monthy_dashboard');
        Route::get('admin/monthly-duration-dashboard','Admin\DurationController@monthlY_project_duration');
        Route::get('admin/monthly-kam-name-dashboard','Admin\DurationController@kam_months');
        Route::get('admin/project-status-duration-dashboard','Admin\DurationController@project_status_duration');
        Route::get('admin/big-deal-dashboard','Admin\DashboardController@big_deal_dashboard');
           //attachment
           Route::POST('admin/submit-attachment','Admin\SiteAttachmentController@submit_attachment');
           Route::get('admin/sales-attachment','Admin\SiteAttachmentController@sales_attachment');
           Route::get('admin/planning-attachment','Admin\SiteAttachmentController@planning_attachment');
           Route::get('admin/permission-attachment','Admin\SiteAttachmentController@permission_attachment');
           Route::get('admin/build-attachment','Admin\SiteAttachmentController@build_attachment');
           Route::get('admin/service-delivery-attachment','Admin\SiteAttachmentController@service_delivery_attachment');
        //Sale File
        Route::get('admin/pending-cts/all-list','Admin\SiteMasterFileController@all_pending_cts_all_list');
        Route::get('admin/search-pending-cts','Admin\SiteMasterFileController@search_pending_cts_records');
        Route::get('admin/sale/single-pending-cts/{id}','Admin\SiteMasterFileController@single_pending_cts');
        
        Route::get('admin/sale/dashboard','Admin\SaleDashboardController@index');
        Route::get('admin/sale/home-project-ageing/{any}','Admin\SaleDashboardController@home_project_ageing');
        Route::get('admin/sale/home-project-status/{any}','Admin\SaleDashboardController@home_project_status');
        Route::get('admin/sale/all-list','Admin\SiteMasterFileController@index');
        Route::get('admin/sale/add-new-record','Admin\SiteMasterFileController@add_new_record');
        Route::post('admin/sale/submit-record', 'Admin\SiteMasterFileController@submit_new_record')->name('admin.sale.submit-record');
        Route::get('admin/sale/single-record/{id}','Admin\SiteMasterFileController@single_record');
        Route::post('admin/sale/update-record/{id}', 'Admin\SiteMasterFileController@update_new_record')->where('id', '.*')->name('admin.sale.update-record');
        Route::post('admin/sale/pending/cts/update-record/{id}', 'Admin\SiteMasterFileController@update_pending_cts_record')->name('admin.sale.pending.update-record');
        Route::get('admin/sale/search','Admin\SiteMasterFileController@search_records');
        Route::get('admin/sale/import-records','Admin\ImportSiteMasterController@index');
        Route::post('admin/sale/submit-import-records','Admin\ImportSiteMasterController@submit_import_records')->name('admin.submit.import.records');
        //New sales lead
        Route::get('admin/sale/add-new-sale','Admin\NewSalesLeadController@index');
        Route::post('admin/sale/submit-lead-sale','Admin\NewSalesLeadController@submit_new_record')->name('admin.submit.lead.sale.record');
        Route::get('admin/sale/all-new-sale','Admin\NewSalesLeadController@lead_sales_all_records');
        Route::get('admin/sale-pipeline/single-record/{id}', 'Admin\NewSalesLeadController@single_sales_pipeline_records')->name('admin.sale.pipeline.single-record');
        
        //products
        Route::get('admin/product/add-new-product','Admin\ProductController@index');
        Route::post('admin/product/submit-product','Admin\ProductController@add_product')->name('admin.submit.product.record');
        //Service type
        Route::get('admin/service-type/add-new','Admin\ServiceTypeController@index');
        Route::post('admin/service-type/submit-add-new','Admin\ServiceTypeController@submit_service_type')->name('admin.submit.service.type');
        
        //Site
        Route::get('admin/site/add-new','Admin\SiteController@index');
        Route::post('admin/site/submit-add-new','Admin\SiteController@submit_site')->name('admin.submit.site.a'); 
        Route::post('admin/site/submit-add-new-b','Admin\SiteController@submit_site_b')->name('admin.submit.site.b'); 
        Route::post('admin/site/address-list','Admin\SiteController@address_list_a');  
        Route::post('admin/site/address-list-b','Admin\SiteController@address_list_b'); 
        Route::get('admin/site/edit-page/{id}','Admin\SiteController@view_site_edit')->name('site.edit.page');
        Route::get('admin/site/all-listing','Admin\SiteController@all_site_listing');
        Route::post('admin/site/update-site-b','Admin\SiteController@update_site_b'); 
        Route::post('admin/site/update-site-a','Admin\SiteController@update_site_a'); 
        //region
        Route::post('admin/region/province-list','Admin\RegionController@fetch_province_record');
        Route::post('admin/region/metro-list','Admin\RegionController@fetch_metro_record');  
        Route::post('admin/service-type-detail','Admin\ServiceTypeController@get_service_type');  
        Route::post('admin/get-mttr-sla-options','Admin\ServiceTypeController@get_mttr_sla');  
        //Description
        Route::get('admin/description/add-new','Admin\DescriptionController@index');
        Route::post('admin/description/submit-add-new','Admin\DescriptionController@submit_description')->name('admin.submit.description');
        
        //Customer
        Route::get('admin/customer/add-new','Admin\CustomerController@index');
        Route::post('admin/Customer/submit-add-new','Admin\CustomerController@submit_customer')->name('admin.submit.customer');
        Route::get('admin/all/customer','Admin\CustomerController@get_customer');
        Route::get('admin/customer/delete/{id}','Admin\CustomerController@delete_customer');
        Route::get('admin/all-customer-record','Admin\CustomerController@all_customer_view');
        Route::get('admin/search-customer-record','Admin\CustomerController@search_single_customer_records');
        Route::get('admin/single-customer-view/{id}','Admin\CustomerController@admin_single_customer_view');
        Route::post('admin/submit-customer-comment/{id}','Admin\CustomerController@admin_customer_comment')->name('submit.customer.comment');
        Route::get('admin/client-map','Admin\CustomerController@view_map');

        
        
        //Department Comment
        Route::get('admin/department-comments','Admin\CommentFormController@department_Comments');
        Route::get('admin/single-department-comments/{id}','Admin\CommentFormController@single_record');
        Route::post('admin/department-comment/submit-add-new/','Admin\CommentFormController@submit_new_record')->name('admin.submit.department.comment');
        //Planning File
        Route::get('admin/planning/dashboard','Admin\PlanningDashboardController@index');
        Route::get('admin/planning/home-project-status/{any}','Admin\PlanningDashboardController@home_project_status');
        Route::get('admin/planning/home-planning-status/{any}','Admin\PlanningDashboardController@home_planning_status');
        Route::get('admin/planning/home-project-types/{any}','Admin\PlanningDashboardController@home_project_types');
        Route::get('admin/planning/home-project-ageing/{any}','Admin\PlanningDashboardController@home_project_ageing');
        Route::get('admin/planning/all-list','Admin\PlanningMasterFileController@index');
        Route::get('admin/planning/single-record/{id}','Admin\PlanningMasterFileController@single_record');
        Route::post('admin/planning/update-record/{id}', 'Admin\PlanningMasterFileController@update_record')->name('admin.planning.update-record');
        Route::get('admin/planning/import-records','Admin\ImportPlanningMasterController@index');
        Route::post('admin/planning/submit-import-records','Admin\ImportPlanningMasterController@submit_import_records')->name('admin.planning.submit.import.records');
        Route::get('admin/planning/search','Admin\PlanningMasterFileController@search_records');
		Route::get('admin/planning/total/project/cost','Admin\PlanningMasterFileController@search_total_project_records');
		Route::get('admin/planning/search/material/isp/a','Admin\PlanningMasterFileController@search_material_isp_a_records');
		Route::get('admin/planning/search/material/isp/b','Admin\PlanningMasterFileController@search_material_isp_b_records');
		Route::get('admin/planning/search/material/osp','Admin\PlanningMasterFileController@search_material_osp_records');
		Route::get('admin/planning/search/site/survey','Admin\PlanningMasterFileController@search_site_survey_records');
		Route::get('admin/planning/search/landlord','Admin\PlanningMasterFileController@search_landlord_records');
		Route::get('admin/planning/search/department/comment','Admin\PlanningMasterFileController@search_department_comments');
		Route::get('admin/planning/search/lapop','Admin\PlanningMasterFileController@search_la_pop');
		 
		 
        Route::get('admin/planning/project-status','Admin\PlanningMasterFileController@project_status_list');
        Route::get('admin/planning/planning-status','Admin\PlanningMasterFileController@planning_status_list');
        Route::get('admin/planning/planning-date','Admin\PlanningMasterFileController@planning_date_list');
        Route::get('admin/planning/planning-resource','Admin\PlanningMasterFileController@planning_resources_list');
        Route::get('admin/planning/planning-isp-a','Admin\PlanningMasterFileController@planning_isp_a_list');
        Route::get('admin/planning/planning-isp-b','Admin\PlanningMasterFileController@planning_isp_b_list');
        Route::get('admin/planning/planning-total-project-cost','Admin\PlanningMasterFileController@planning_total_project_cost_list');
        Route::get('admin/planning/planning-material-service-isp-a','Admin\PlanningMasterFileController@planning_material_service_isp_a_list');
        Route::get('admin/planning/planning-material-service-isp-b','Admin\PlanningMasterFileController@planning_material_service_isp_b_list');
        Route::get('admin/planning/planning-material-service-osp','Admin\PlanningMasterFileController@planning_material_service_osp_list');
        Route::get('admin/planning/planning-department-comment','Admin\PlanningMasterFileController@planning_department_comment_list');
        Route::get('admin/planning/project-status-single','Admin\PlanningMasterFileController@planning_status_single_record');
        Route::get('admin/planning/site-survey-list','Admin\PlanningMasterFileController@site_survey_all_list');
        Route::get('admin/planning/site-survey/{circuit_id}','Admin\PlanningMasterFileController@site_survey_record');
        Route::get('admin/planning/landlord-approval-list','Admin\PlanningMasterFileController@landlord_approval_all_list');
        Route::get('admin/planning/landlord-approval/{id}','Admin\PlanningMasterFileController@landlord_approval_record');
        Route::post('admin/planning/site-survey-update-record/{id}', 'Admin\PlanningMasterFileController@site_survey_update')->name('admin.planning.site.survey.update-record');
        Route::post('admin/planning/landlord-approval-update-record/{id}', 'Admin\PlanningMasterFileController@landlord_approval_update')->name('admin.planning.landlord.approval.update-record');
        Route::get('admin/planning/project-status/{id}','Admin\PlanningMasterFileController@planning_project_status_single');
        Route::get('admin/planning/planning-status/{id}','Admin\PlanningMasterFileController@planning_status_single');
        Route::get('admin/planning/planning-dates/{id}','Admin\PlanningMasterFileController@planning_dates_single');
        Route::get('admin/planning/planning-resource/{id}','Admin\PlanningMasterFileController@planning_resource_single');
        Route::get('admin/planning/planning-isp-a/{id}','Admin\PlanningMasterFileController@planning_isp_a_single');
        Route::get('admin/planning/planning-isp-b/{id}','Admin\PlanningMasterFileController@planning_isp_b_single');
        Route::get('admin/planning/planning-total-project-cost/{id}','Admin\PlanningMasterFileController@planning_total_project_cost_single');
        Route::get('admin/planning/planning-material-service-isp-a/{id}','Admin\PlanningMasterFileController@planning_material_service_isp_a_single');
        Route::get('admin/planning/planning-material-service-isp-a-add-new','Admin\PlanningMasterFileController@planning_material_service_isp_a_add_new');
        Route::get('admin/planning/planning-material-price','Admin\PlanningMasterFileController@planning_material_price');
        Route::get('admin/planning/planning-material-service-isp-b/{id}','Admin\PlanningMasterFileController@planning_material_service_isp_b_single');
        Route::get('admin/planning/planning-material-service-osp/{id}','Admin\PlanningMasterFileController@planning_material_service_osp_single');
        Route::get('admin/planning/planning-department-comment-single/{id}','Admin\PlanningMasterFileController@planning_department_comment_single');
        Route::POST('admin/planning/planning-status-update/{circuit_id}','Admin\PlanningMasterFileController@update_planning_status')->where('circuit_id', '.*')->name('admin.planning.planning.status.update');
        Route::POST('admin/planning/planning-totalcost-update/{id}','Admin\PlanningMasterFileController@update_total_project_cost_data')->name('admin.planning.total.cost.update');
        
        Route::POST('admin/planning/planning-material-isp-a-update/{id}','Admin\PlanningMasterFileController@update_material_isp_a')->name('admin.planning.material.ispa.update');

        Route::POST('admin/planning/planning-material-isp-b-update/{id}','Admin\PlanningMasterFileController@update_material_isp_b')->name('admin.planning.material.ispb.update');

        Route::POST('admin/planning/planning-material-osp-update/{id}','Admin\PlanningMasterFileController@update_material_osp')->name('admin.planning.material.osp.update');

        Route::POST('admin/planning/planning-landlord-approval-update/{circuit_id}','Admin\LandlordApprovalController@landlord_approval_update')->name('admin.planning.landlord.approval.update');
        //Import
        Route::get('admin/planning/planning-material-import','Admin\ImportPlanningMaterialController@index');
        Route::post('admin/planning/submit-import-material-records','Admin\ImportPlanningMaterialController@submit_import_records')->name('admin.planning.submit.import.material.records');
        Route::get('admin/planning/planning-material-osp-import','Admin\ImportPlanningMaterialOspController@index');
        Route::post('admin/planning/submit-import-material-osp-records','Admin\ImportPlanningMaterialOspController@submit_import_records')->name('admin.planning.submit.import.material-osp.records');
        Route::get('admin/planning/planning-material-isp-a-import','Admin\ImportPlanningMaterialIspAController@index');
        Route::post('admin/planning/submit-import-material-isp-a-records','Admin\ImportPlanningMaterialIspAController@submit_import_records')->name('admin.planning.submit.import.material-isp-a.records');
        Route::get('admin/planning/planning-material-isp-b-import','Admin\ImportPlanningMaterialIspBController@index');
        Route::post('admin/planning/submit-import-material-isp-b-records','Admin\ImportPlanningMaterialIspBController@submit_import_records')->name('admin.planning.submit.import.material-isp-b.records');
        //la pop
        Route::get('admin/planning/la-pop/add-new','Admin\LapopController@index');
        Route::post('admin/planning/la-pop/submit-new-record','Admin\LapopController@submit_new_record')->name('admin.submit.la.pop.record');
        Route::get('admin/planning/la-pop/all-record','Admin\LapopController@show_all_list');
        Route::get('admin/planning/la-pop/single-record/{pop_id}','Admin\LapopController@single_record');
        Route::post('admin/planning/la-pop/update-record/{pop_id}', 'Admin\LapopController@update_record')->name('admin.planning.la.pop.update-record');
        //Permissions File
        Route::get('admin/permission/dashboard','Admin\PermissionDashboardController@index');
        Route::get('admin/permission/home-project-status/{any}','Admin\PermissionDashboardController@home_project_status');
        Route::get('admin/permission/home-permission-status/{any}','Admin\PermissionDashboardController@home_permission_status');
        Route::get('admin/permission/home-wayleaves-status/{any}','Admin\PermissionDashboardController@home_wayleaves_status');
        Route::get('admin/permission/home-project-ageing/{any}','Admin\PermissionDashboardController@home_project_ageing');
        Route::get('admin/permission/all-list','Admin\PermissionMasterFileController@index'); 
        Route::get('admin/permission/single-record/{id}','Admin\PermissionMasterFileController@single_record');
        Route::post('admin/permission/update-record/{id}', 'Admin\PermissionMasterFileController@update_new_record')->name('admin.permission.update-record');
        Route::get('admin/permission/import-records','Admin\ImportPermissionMasterController@index');
        Route::post('admin/permission/submit-import-records','Admin\ImportPermissionMasterController@submit_import_records')->name('admin.permission.submit.import.records');
        Route::get('admin/permission/project-status','Admin\PermissionMasterFileController@permission_project_page');
        Route::get('admin/permission/permission-status','Admin\PermissionMasterFileController@permission_status_page');
        Route::get('admin/permission/permission-site-a','Admin\PermissionMasterFileController@permission_site_a_page');
        Route::get('admin/permission/permission-site-b','Admin\PermissionMasterFileController@permission_site_b_page');
        Route::get('admin/permission/permission-wayleaves-status','Admin\PermissionMasterFileController@permission_wayleaves_status');
        Route::get('admin/permission/permission-department-comment','Admin\PermissionMasterFileController@permission_department_comments');
        Route::get('admin/permission/permission-project-comment','Admin\PermissionMasterFileController@permission_project_comments');
        Route::get('admin/permission/permission-status-single/{id}','Admin\PermissionMasterFileController@permission_status_single_record');
        Route::get('admin/permission/permission-site-a-single/{id}','Admin\PermissionMasterFileController@permission_site_a_single_record');
        Route::get('admin/permission/permission-site-b-single/{id}','Admin\PermissionMasterFileController@permission_site_b_single_record');
        Route::get('admin/permission/permission-wayleaves-status-single/{id}','Admin\PermissionMasterFileController@permission_wayleaves_status_single');
        Route::get('admin/permission/permission-department-comment-single/{id}','Admin\PermissionMasterFileController@permission_department_comment_single');
        Route::POST('admin/permission/permission-status-update/{circuit_id}','Admin\PermissionMasterFileController@update_permission_status')->where('circuit_id', '.*')->name('permission.status.update');
        Route::POST('admin/permission/permission-wayleaves-update{id}','Admin\PermissionMasterFileController@update_wayleaves_single_permission')->name('permission.wayleaves.status.update');
        Route::get('admin/permission/search','Admin\PermissionMasterFileController@search_records');
		Route::get('admin/permission/search/wayleaves/status','Admin\PermissionMasterFileController@search_wayleaves_records');
		Route::get('admin/permission/search/department/comment','Admin\PermissionMasterFileController@search_department_records');
        //Build File
        Route::get('admin/build/dashboard','Admin\BuildDashboardController@index');
        Route::get('admin/build/home-project-status/{any}','Admin\BuildDashboardController@home_project_status');
        Route::get('admin/build/home-build-status/{any}','Admin\BuildDashboardController@home_build_status');
        Route::get('admin/build/home-project-ageing/{any}','Admin\BuildDashboardController@home_project_ageing');
        Route::get('admin/build/home-build-toc-status/{any}','Admin\BuildDashboardController@home_build_toc_status');
        Route::get('admin/build/all-list','Admin\BuildMasterFileController@index'); 
        Route::get('admin/build/single-record/{id}','Admin\BuildMasterFileController@single_record');
        Route::post('admin/build/update-record/{id}', 'Admin\BuildMasterFileController@update_new_record')->where('id', '.*')->name('admin.build.update-record');
        Route::get('admin/build/import-records','Admin\ImportBuildMasterController@index');
        Route::post('admin/build/submit-import-records','Admin\ImportBuildMasterController@submit_import_records')->name('admin.build.submit.import.records');
        Route::get('admin/build/build-status-page','Admin\BuildMasterFileController@build_status_page');
        Route::get('admin/build/build-date-page','Admin\BuildMasterFileController@build_date_page');
        Route::get('admin/build/build-osp-resources','Admin\BuildMasterFileController@build_osp_resources');
        Route::get('admin/build/build-isp-a-resources','Admin\BuildMasterFileController@build_isp_a_resources');
        Route::get('admin/build/build-isp-b-resources','Admin\BuildMasterFileController@build_isp_b_resources');
        Route::get('admin/build/build-po-vo-resources','Admin\BuildMasterFileController@build_po_vo_resources');
        Route::get('admin/build/build-complete','Admin\BuildMasterFileController@build_complete');
        Route::get('admin/build/as-build-otoc','Admin\BuildMasterFileController@as_build_otoc');
        Route::get('admin/build/build-status-single/{id}','Admin\BuildMasterFileController@single_build_status_record');
        Route::get('admin/build/build-date-single/{id}','Admin\BuildMasterFileController@single_build_date_record');
        Route::get('admin/build/build-osp-resources-single/{id}','Admin\BuildMasterFileController@single_build_osp_resources');
        Route::get('admin/build/build-isp-a-resources-single/{id}','Admin\BuildMasterFileController@single_build_isp_a_resources');
        Route::get('admin/build/build-isp-b-resources-single/{id}','Admin\BuildMasterFileController@single_build_isp_b_resources');
        Route::get('admin/build/build-po-vo-status-single/{id}','Admin\BuildMasterFileController@single_build_po_vo_status');
        Route::get('admin/build/build-complete-single/{id}','Admin\BuildMasterFileController@single_build_complete');
        Route::get('admin/build/as-build-otoc-single/{id}','Admin\BuildMasterFileController@single_as_build_otoc');
        Route::get('admin/build/project-cost','Admin\BuildMasterFileController@project_cost');
        Route::get('admin/build/project-cost-single/{id}','Admin\BuildMasterFileController@project_cost_single');
        Route::get('admin/build/material-service-isp-a','Admin\BuildMasterFileController@material_service_isp_a');
        Route::get('admin/build/material-service-isp-a-single/{id}','Admin\BuildMasterFileController@material_service_isp_a_single');
        Route::get('admin/build/material-service-isp-b','Admin\BuildMasterFileController@material_service_isp_b');
        Route::get('admin/build/material-service-isp-b-single/{id}','Admin\BuildMasterFileController@material_service_isp_b_single');
        Route::get('admin/build/material-service-isp-osp','Admin\BuildMasterFileController@material_service_isp_osp');
        Route::get('admin/build/material-service-isp-osp-single/{id}','Admin\BuildMasterFileController@material_service_isp_osp_single');
        Route::get('admin/build/department-comment','Admin\BuildMasterFileController@build_department_comment');
        Route::get('admin/build/department-comment-single/{id}','Admin\BuildMasterFileController@build_department_comment_single');
        Route::POST('admin/build/build-status-update/{circuit_id}','Admin\BuildMasterFileController@update_build_status')->name('admin.build.build.status.update');
        Route::get('admin/build/search','Admin\BuildMasterFileController@search_records');
		Route::get('admin/build/search/project/cost','Admin\BuildMasterFileController@search_project_records');
		Route::get('admin/build/search/material-isp-a','Admin\BuildMasterFileController@search_material_isp_a_records');
		Route::get('admin/build/search/material-isp-b','Admin\BuildMasterFileController@search_material_isp_b_records');
		Route::get('admin/build/search/material-osp','Admin\BuildMasterFileController@search_material_osp_records');
		Route::get('admin/build/search/department/comment','Admin\BuildMasterFileController@search_department_comment_records');
		Route::POST('admin/build/build-department-comment-update/{circuit_id}','Admin\BuildMasterFileController@update_department_comment_build')->name('admin.build.build.comment.update');
        Route::POST('admin/build/project-cost/{circuit_id}','Admin\BuildMasterFileController@update_project_cost')->name('admin.build.update.project.cost');
        // support dashboard
        Route::get('support/dashboard','Support\HomeController@index');
        Route::get('single-ticket/{id}','Support\HomeController@ticket');
        Route::get('chat-logs','Support\HomeController@chat_logs');
        Route::get('tickets','Support\HomeController@ticket_list');
        route::post('submit-new-ticket','Support\HomeController@add_new_ticket')->name('submit.new.ticket'); 
        route::post('ticket-reply','Support\HomeController@reply_ticket')->name('submit.ticket.reply');
        Route::get('sumit-close-ticket/{id}','Support\HomeController@close_ticket');
        Route::get('/load-latest-messages', 'Support\MessagesController@getLoadLatestMessages');
        Route::get('/search-users', 'Support\MessagesController@search_users');
        Route::post('/send', 'Support\MessagesController@postSendMessage');
        Route::get('/fetch-old-messages', 'Support\MessagesController@getOldMessages'); 
        Route::get('/support/chat', 'Support\MessagesController@chat_page'); 
        Route::get('/support/hardware-software-requirement', 'Support\HomeController@hardware_form'); 
        Route::post('/support/submit-software-transform', 'Support\HomeController@submit_hard_and_software_form')->name('submit.software.form');
        Route::post('/support/update-software-transform', 'Support\HomeController@update_hard_and_software_form')->name('update.software.form');
        Route::get('/support/single-software-hardware/{id}', 'Support\HomeController@single_software_hardware_form'); 
        Route::get('/support/asset-transform', 'Support\HomeController@assest_transform_form'); 
        Route::get('/support/single-asset-transform/{id}', 'Support\HomeController@single_assest_transform_form'); 
        Route::post('/support/update-asset-transform', 'Support\HomeController@update_assest_transform_form')->name('update.assest.form'); 
        Route::post('/support/submit-asset-transform', 'Support\HomeController@submit_assest_transform_form')->name('submit.assest.form'); 
        Route::get('/support/asset-transform-listing', 'Support\HomeController@assest_transform_all_listing'); 
        Route::get('/support/hardware-software-listing', 'Support\HomeController@hardware_software_listing'); 
        // service delivery status
        Route::get('admin/service-delivery/dashboard','Admin\ServiceDeliveryController@index');
        Route::get('admin/service-delivery/home-project-ageing/{any}','Admin\ServiceDeliveryController@home_project_ageing');
        Route::get('admin/service-delivery/home-project-status/{any}','Admin\ServiceDeliveryController@home_project_status');
        Route::get('admin/service-delivery/sd-table-view','Admin\ServiceDeliveryController@sd_table_view');
        Route::get('admin/service-delivery/sd-table-single/{id}','Admin\ServiceDeliveryController@sd_table_single_view');
        Route::get('admin/service-delivery/single-record/{id}','Admin\ServiceDeliveryController@single_record');
        Route::get('admin/service-delivery/project-status','Admin\ServiceDeliveryController@project_status');
        Route::get('admin/service-delivery/project-status-single/{id}','Admin\ServiceDeliveryController@single_project_status');
        Route::get('admin/service-delivery/department-comment','Admin\ServiceDeliveryController@department_comment_view');
        Route::get('admin/service-delivery/department-comment-single/{id}','Admin\ServiceDeliveryController@department_comment_single');
        Route::get('admin/service-delivery/project-comment','Admin\ServiceDeliveryController@project_comment_view');
        Route::get('admin/service-delivery/project-comment-single/{id}','Admin\ServiceDeliveryController@project_comment_single');
        Route::POST('admin/service-delivery/status-update/{circuit_id}','Admin\ServiceDeliveryController@update_service_delivery_status')->where('circuit_id', '.*')->name('service.delivery.status.update');
        Route::get('admin/service-delivery/search','Admin\ServiceDeliveryController@search_records');
		Route::get('admin/service-delivery/department/search','Admin\ServiceDeliveryController@search_department_records');

        //site survey status 
        Route::POST('admin/planning/site-survey-update/{id}','Admin\SiteSurveyStatusController@site_survey_update')->name('admin.planning.site.survey.update');
        //regions
        Route::get('admin/region/import-records','Admin\ImportRegionController@index');
        Route::post('admin/region/submit-import-records','Admin\ImportRegionController@submit_import_records')->name('admin.submit.region.import.records');
        //client ring
        Route::get('admin/sale/client-ring','Admin\ClientRingController@index');
        Route::post('admin/sale/submit-client-records','Admin\ClientRingController@submit_service_type')->name('admin.submit.client.ring.records');
        Route::post('admin/sale/client-ring-list','Admin\ClientRingController@get_client_ring');



        //User Management 
        Route::get('admin/user-management/add-new','Admin\UserManageController@index');
        Route::post('admin/user-management/submit-add-new','Admin\UserManageController@submit_add_new')->name('admin.user-management.submit-add-new');
        Route::get('admin/user-management/all-users','Admin\UserManageController@all_user_list');
        Route::get('admin/user-management/single-user/{id}','Admin\UserManageController@single_user');
        Route::post('admin/user-management/update-user','Admin\UserManageController@update_user')->name('admin.user-management.update-user');
        Route::get('admin/user-management/delete-user/{id}','Admin\UserManageController@delete_user');
        Route::get('admin/user/search','Admin\UserManageController@search_records');
        Route::get('admin/user-management/add-new-client','Admin\UserManageController@view_client_page');
        Route::post('admin/user-management/submit-new-client','Admin\UserManageController@submit_user_client')->name('admin.user-management.submit-new-client');

        //History Management 
        Route::get('admin/history-management/dashboard','Admin\HistoryManageController@index');
        Route::get('admin/history-management/history-list','Admin\HistoryManageController@history_list_record');
        Route::get('admin/history-management/search','Admin\HistoryManageController@search_history')->name('history.management.search');

        //Report Export
        Route::get('admin/export/dashboard','Admin\ReportExportController@index');
        Route::get('admin/export/nrc-report','Admin\ReportExportController@export_nrc_report');
        Route::get('admin/export/mrc-report','Admin\ReportExportController@export_mrc_report');
        Route::get('admin/export/older-records-report','Admin\ReportExportController@export_older_than_ninety_report');
        Route::get('admin/export/project-ageing','Admin\ReportExportController@export_project_ageint_report');
        Route::get('admin/export/la-sale-report','Admin\ReportExportController@export_la_sale_report');
        Route::get('admin/export/open-book-report','Admin\ReportExportController@export_open_book_report');
        Route::get('admin/export/vs-report','Admin\ReportExportController@export_vc_report_report'); 
        Route::get('admin/export/service-delivery-export','Admin\ReportExportController@export_service_delivery_report'); 
        Route::get('admin/export/site-master-file','Admin\ReportExportController@export_site_master_file');
        Route::get('admin/export/planning-master-file','Admin\ReportExportController@export_planning_master_file');
        Route::get('admin/export/permission-master-file','Admin\ReportExportController@export_permission_master_file');
        Route::get('admin/export/build-master-file','Admin\ReportExportController@export_build_master_file');
        Route::get('admin/export/enable-comming-soon','Admin\CommingSoonController@enable_comming_soon');
        Route::get('admin/export/disable-comming-soon','Admin\CommingSoonController@disable_comming_soon'); 
		Route::get('admin/export/users','Admin\UserManageController@export_user');
		Route::get('admin/export/ticket','Support\HomeController@export_ticket');
		Route::get('admin/export/order-management-report','Admin\ReportExportController@export_order_managment_report');
        Route::get('admin/export/client-report','Admin\ReportExportController@export_client_report');
        Route::get('admin/export/layer-report','Admin\ReportExportController@export_layer_report');
        Route::get('admin/export/monthly-new-sale-report','Admin\ReportExportController@export_monthly_new_report');

 
        Route::get('admin/export/o2cap-report-download','Admin\ReportExportController@download_o2cap_csv');
        Route::get('admin/export/prjoect-approval-report-download','Admin\ReportExportController@export_financial_approval_report');
        Route::get('admin/export/solid-data-report','Admin\ReportExportController@export_solid_data_report');
        Route::get('admin/export/total-project-cost-report','Admin\ReportExportController@export_total_project_cost_report');
       

        //dropdown management
        //Route::get('admin/kam-name/add-new','Admin\KamNameController@index');
        Route::Post('admin/kam-name/submit','Admin\KamNameController@submit_kam_name');
        Route::get('admin/dropdown-management/kam-all-list','Admin\KamNameController@all_kam_name');
        Route::get('admin/kam-name/delete/{id}','Admin\KamNameController@delete_kam_name');
        Route::get('admin/dropdown-management/order-all-list','Admin\DropdownManagementController@all_order_name');
        Route::Post('admin/order-name/submit','Admin\DropdownManagementController@submit_order_name');
        Route::get('admin/order-name/delete/{id}','Admin\DropdownManagementController@delete_order_name');
        Route::get('admin/dropdown-management/all-network-list','Admin\DropdownManagementController@all_network_type');
        Route::Post('admin/network-type/submit','Admin\DropdownManagementController@submit_network_type');
        Route::get('admin/network-type/delete/{id}','Admin\DropdownManagementController@delete_network_type');
		Route::get('admin/dropdown-management/all-third-party-provider-list','Admin\DropdownManagementController@all_third_party_provider_list');
		Route::Post('admin/third-party-provider/submit','Admin\DropdownManagementController@submit_thrd_party_provider');
		Route::get('admin/thrd-party-provider/delete/{id}','Admin\DropdownManagementController@delete_third_party_provider');
		Route::get('admin/dropdown-management/all-lease-term-in-month-list','Admin\DropdownManagementController@all_lease_term_in_month_list');
		Route::Post('admin/lease-term-in-month/submit','Admin\DropdownManagementController@submit_lease_term_in_month');
		Route::get('admin/lease-term-in-month/delete/{id}','Admin\DropdownManagementController@delete_lease_term_in_month');
		Route::get('admin/dropdown-management/all-return-to-sale-list','Admin\DropdownManagementController@all_return_to_sale_list');
		Route::Post('admin/return-to-sale/submit','Admin\DropdownManagementController@submit_return_to_sale');
		Route::get('admin/return-to-sale/delete/{id}','Admin\DropdownManagementController@delete_return_to_sale');
		Route::get('admin/dropdown-management/all-strand-list','Admin\DropdownManagementController@all_strands_list');
		Route::Post('admin/strands/submit','Admin\DropdownManagementController@submit_strands');
		Route::get('admin/strands/delete/{id}','Admin\DropdownManagementController@delete_strands');
		Route::get('admin/dropdown-management/all-rate-mbit-s-list','Admin\DropdownManagementController@all_rate_mbit_s_list');
		Route::Post('admin/rate-mbit-s/submit','Admin\DropdownManagementController@submit_rate_mbit_s');
		Route::get('admin/rate-mbit-s/delete/{id}','Admin\DropdownManagementController@delete_rate_mbit_s');
		Route::get('admin/dropdown-management/all-project-type-list','Admin\DropdownManagementController@all_project_type_list');
		Route::Post('admin/project-type/submit','Admin\DropdownManagementController@submit_project_type');
		Route::get('admin/project-type/delete/{id}','Admin\DropdownManagementController@delete_project_type');
		Route::get('admin/dropdown-management/all-planning-status-list','Admin\DropdownManagementController@all_planning_status_list');
		Route::Post('admin/planning-status/submit','Admin\DropdownManagementController@submit_planning_status');
		Route::get('admin/planning-status/delete/{id}','Admin\DropdownManagementController@delete_planning_status');
		Route::get('admin/dropdown-management/all-osp-status-planning-list','Admin\DropdownManagementController@all_osp_status_planning_list');
		Route::Post('admin/osp-status-planning/submit','Admin\DropdownManagementController@submit_osp_planning_status');
		Route::get('admin/osp-planning-status/delete/{id}','Admin\DropdownManagementController@delete_osp_planning_status');
		Route::get('admin/dropdown-management/all-site-status-list','Admin\DropdownManagementController@all_site_status_list');
		Route::Post('admin/site-status/submit','Admin\DropdownManagementController@submit_site_status');
		Route::get('admin/site-status/delete/{id}','Admin\DropdownManagementController@delete_site_status');
		Route::get('admin/dropdown-management/all-osp-planner-list','Admin\DropdownManagementController@all_osp_planner_list');
		Route::Post('admin/osp-planner/submit','Admin\DropdownManagementController@submit_osp_planner');
		Route::get('admin/osp-planner/delete/{id}','Admin\DropdownManagementController@delete_osp_planners');
		Route::get('admin/dropdown-management/all-isp-planner-list','Admin\DropdownManagementController@all_isp_planner_list');
		Route::Post('admin/isp-planner/submit','Admin\DropdownManagementController@submit_isp_planner');
		Route::get('admin/isp-planner/delete/{id}','Admin\DropdownManagementController@delete_isp_planners');
		Route::get('admin/dropdown-management/all-surveyors-list','Admin\DropdownManagementController@all_surveyors_list');
		Route::Post('admin/surveyors/submit','Admin\DropdownManagementController@submit_surveyors');
		Route::get('admin/surveyors/delete/{id}','Admin\DropdownManagementController@delete_surveyors');
		Route::get('admin/dropdown-management/all-site-survey-list','Admin\DropdownManagementController@all_site_survey_status_list');
		Route::Post('admin/site-survey/submit','Admin\DropdownManagementController@submit_site_survey_status');
		Route::get('admin/site-survey-status/delete/{id}','Admin\DropdownManagementController@delete_site_survey_status');
		Route::get('admin/dropdown-management/all-landlord-status-list','Admin\DropdownManagementController@all_landlord_status_list');
		Route::Post('admin/landlord-status/submit','Admin\DropdownManagementController@submit_landlord_status');
		Route::get('admin/landlord-status/delete/{id}','Admin\DropdownManagementController@delete_landlord_status');
		Route::get('admin/dropdown-management/all-permission-status-list','Admin\DropdownManagementController@all_permission_status_list');
		Route::Post('admin/permission-status/submit','Admin\DropdownManagementController@submit_permission_status');
		Route::get('admin/permission-status/delete/{id}','Admin\DropdownManagementController@delete_permission_status');
		Route::get('admin/dropdown-management/all-wayleaves-status-list','Admin\DropdownManagementController@all_wayleaves_status_list');
		Route::Post('admin/wayleaves-status/submit','Admin\DropdownManagementController@submit_wayleaves_status');
		Route::get('admin/wayleaves-status/delete/{id}','Admin\DropdownManagementController@delete_wayleaves_status');
		Route::get('admin/dropdown-management/all-resources-list','Admin\DropdownManagementController@all_resources_list');
		Route::Post('admin/resources/submit','Admin\DropdownManagementController@submit_resources');
		Route::get('admin/resources/delete/{id}','Admin\DropdownManagementController@delete_resources');
		Route::get('admin/dropdown-management/all-build-status-list','Admin\DropdownManagementController@all_build_status_list');
		Route::Post('admin/build-status/submit','Admin\DropdownManagementController@submit_build_status');
		Route::get('admin/build-status/delete/{id}','Admin\DropdownManagementController@delete_build_status');
		Route::get('admin/dropdown-management/all-build-osp-status-list','Admin\DropdownManagementController@all_build_osp_status_list');
		Route::Post('admin/build-osp-status/submit','Admin\DropdownManagementController@submit_build_osp_status');
		Route::get('admin/build-osp-status/delete/{id}','Admin\DropdownManagementController@delete_build_osp_status');
		Route::get('admin/dropdown-management/all-service-delivery-status-list','Admin\DropdownManagementController@all_service_delivery_status_list');
		Route::Post('admin/service-delivery-status/submit','Admin\DropdownManagementController@submit_service_delivery_status');
		Route::get('admin/service-delivery-status/delete/{id}','Admin\DropdownManagementController@delete_service_delivery_status');
        Route::get('admin/dropdown-management/sd-status-list','Admin\DropdownManagementController@all_sd_status_list');
        Route::Post('admin/sd-status/submit','Admin\DropdownManagementController@submit_sd_status_status');
        Route::get('admin/sd-status/delete/{id}','Admin\DropdownManagementController@delete_sd_status');
        Route::get('admin/dropdown-management/years-list','Admin\DropdownManagementController@all_year_list');
        Route::Post('admin/years/submit','Admin\DropdownManagementController@submit_years');
        Route::get('admin/year/delete/{id}','Admin\DropdownManagementController@delete_year');
        Route::get('admin/dropdown-management/week-list','Admin\DropdownManagementController@all_week_list');
        Route::Post('admin/week/submit','Admin\DropdownManagementController@submit_weeks');
        Route::get('admin/week/delete/{id}','Admin\DropdownManagementController@delete_week');
        Route::get('admin/dropdown-management/comment-list','Admin\DropdownManagementController@all_comment_list');
        Route::Post('admin/comment/submit','Admin\DropdownManagementController@submit_comments');
        Route::get('admin/comment/delete/{id}','Admin\DropdownManagementController@delete_comment');
        Route::get('admin/dropdown-management/resource-team-list','Admin\DropdownManagementController@all_resource_team_list');
        Route::Post('admin/resource-team/submit','Admin\DropdownManagementController@submit_resource_team');
        Route::get('admin/resource-team/delete/{id}','Admin\DropdownManagementController@delete_resource_team');

        //layer
        Route::get('admin/layer/all-list','Admin\LayerController@all_list');
        Route::get('admin/single/layer-detail/{id}','Admin\LayerController@single_layer_form');
        Route::post('admin/update/layer-detail/{circuit_id}','Admin\LayerController@submit_layer')->where('circuit_id', '.*')->name('update.layer.detail');
        Route::get('admin/search-layer/record','Admin\LayerController@search_layer_records');
        Route::get('admin/layer-attachment','Admin\SiteAttachmentController@layer_attachment');

        //finacial
        Route::get('admin/single-financial/{id}','Admin\financialController@single_financial');
        Route::get('admin/financial-all-list','Admin\financialController@all_list');
        Route::post('admin/update/financial-detail/{circuit_id}','Admin\financialController@submit_finacial')->where('circuit_id', '.*')->name('update.financial.detail');
        Route::get('admin/financial-attachment/{id}','Admin\SiteAttachmentController@financial_attachment');
        Route::get('admin/delete/attachment/{id}','Admin\SiteAttachmentController@delete_attachment');
        Route::get('admin/search-financial/record','Admin\financialController@search_financial_records');
        Route::get('admin/send-email','Admin\financialController@send_email');

        //download attachment
        Route::get('admin/download-attachment/{attachmentid}','Admin\SiteAttachmentController@download_planning_attachment');
    });

    Route::group(['middleware' => 'customer'], function(){
        Route::get('admin/customer/detail','Admin\CustomerController@customer_view');
        Route::get('admin/single-customer/detail/{id}','Admin\CustomerController@single_customer_view');
        Route::post('admin/update-customer/comment/{id}','Admin\CustomerController@customer_comment')->name('update.custumer.comment');
        Route::get('admin/customer/record','Admin\CustomerController@search_customer_records');
        Route::get('admin/export/single-client-report','Admin\ReportExportController@export_single_client_report');
        Route::get('customer-map','Admin\CustomerController@view_customer_map');
    }); 
}); 

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
