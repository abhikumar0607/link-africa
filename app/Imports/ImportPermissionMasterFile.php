<?php

namespace App\Imports;

use App\Models\PermissionMasterFile;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;

class ImportPermissionMasterFile implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function collection(collection $rows)
    {

      

        foreach ($rows as $row) 
        {
        $current_date_time = Carbon::now();
        $service_id= $row['service_id'];
        $circuit_id = $row['circuit_id'];
        $datenew = null;
        if($row['datenew']){
           $datenew = Carbon::parse($row['datenew']);
        }
        $permissions_status = $row['permissions_status'];
        $site_a_lla_submitted = null;
        if($row['site_a_lla_submitted']){
           $site_a_lla_submitted = Carbon::parse($row['site_a_lla_submitted']);
        }
        $site_a_lla_estimated = $row['site_a_lla_estimated'];
        $site_a_lla_received = null;
        if($row['site_a_lla_received']){
           $site_a_lla_received = Carbon::parse($row['site_a_lla_received']);
        }
        $site_b_lla_submitted = null;
        if($row['site_b_lla_submitted']){
           $site_b_lla_submitted = Carbon::parse($row['site_b_lla_submitted']);
        }
        $site_b_lla_estimated = null;
        if($row['site_b_lla_estimated']){
            $site_b_lla_estimated = Carbon::parse($row['site_b_lla_estimated']);
        }
        $site_b_lla_received = null;
        if($row['site_b_lla_received']){
            $site_b_lla_received = Carbon::parse($row['site_b_lla_received']);
        }
        $wayleaves_submitted = null;
        if($row['wayleaves_submitted']){
            $wayleaves_submitted = Carbon::parse($row['wayleaves_submitted']);
        }
        $wayleaves_estimated = $row['wayleaves_estimated'];
        $wayleaves_received = null;
        if($row['wayleaves_received']){
            $wayleaves_received = Carbon::parse($row['wayleaves_received']);
        }
        $wayleaves_status = $row['wayleaves_status'];
        $resource = $row['resource'];
        $wl_planned_submitted_date = null;
        if($row['wl_planned_submitted_date']){
            $wl_planned_submitted_date = Carbon::parse($row['wl_planned_submitted_date']);
        }
        $province = $row['province'];
        $osp_status_permissions = $row['osp_status_permissions'];
        $isp_a_b_status = $row['isp_a_b_status'];
        $existing_wl_ref_no = $row['existing_wl_ref_no'];
        $exepected_wl_received_date = null;
        if($row['exepected_wl_received_date']){
            $exepected_wl_received_date = Carbon::parse($row['exepected_wl_received_date']);
        }
        $total_number_of_responses_oustanding = $row['total_number_of_responses_oustanding'];
        $final_wl_submission_date = null;
        if($row['final_wl_submission_date']){
            $final_wl_submission_date = Carbon::parse($row['final_wl_submission_date']);
        }
        $wl_expiry_date = null;
        if($row['wl_expiry_date']){
            $wl_expiry_date = Carbon::parse($row['wl_expiry_date']);
        }
        $wl_osp_status = $row['wl_osp_status'];
        $stormwater_rou_date_submitted = null;
        if($row['stormwater_rou_date_submitted']){
            $stormwater_rou_date_submitted = Carbon::parse($row['stormwater_rou_date_submitted']);
        }
        $stormwater_rou_date_received = null;
        if($row['stormwater_rou_date_received']){
            $stormwater_rou_date_received = Carbon::parse($row['stormwater_rou_date_received']);
        }
        $stormwater_rou_lead_time = $row['stormwater_rou_lead_time'];
        $sewer_rou_date_submitted = null;
        if($row['sewer_rou_date_submitted']){
            $sewer_rou_date_submitted = Carbon::parse($row['sewer_rou_date_submitted']);
        }
        $sewer_rou_date_received = null;
        if($row['sewer_rou_date_received']){
            $sewer_rou_date_received = Carbon::parse($row['sewer_rou_date_received']);
        }
        $sewer_rou_lead_time = $row['sewer_rou_lead_time'];
        //Meta values
        $telkom_date_submitted = $row['telkom_date_submitted'];
        $telkom_date_received = $row['telkom_date_received'];
        $telkom_lead_time = $row['telkom_lead_time'];
        $sasol_date_submitted = $row['sasol_date_submitted'];
        $sasol_date_received = $row['sasol_date_received'];
        $sasol_lead_time = $row['sasol_lead_time'];
        $transnet_date_submitted = $row['transnet_date_submitted'];
        $transnet_date_received = $row['transnet_date_received'];
        $transnet_lead_time = $row['transnet_lead_time'];
        $neotel_date_submitted = $row['neotel_date_submitted'];
        $neotel_date_received = $row['neotel_date_received'];
        $neotel_lead_time = $row['neotel_lead_time'];
        $dfa_date_submitted = $row['dfa_date_submitted'];
        $dfa_date_received = $row['dfa_date_received'];
        $dfa_lead_time = $row['dfa_lead_time'];
        $mtn_date_submitted = $row['mtn_date_submitted'];
        $mtn_date_received = $row['mtn_date_received'];
        $mtn_lead_time = $row['mtn_lead_time'];
        $sanral_date_submitted = $row['sanral_date_submitted'];
        $sanral_date_received = $row['sanral_date_received'];
        $sanral_lead_time = $row['sanral_lead_time'];
        $dept_of_transport_date_submitted = $row['dept_of_transport_date_submitted'];
        $dept_of_transport_date_received = $row['dept_of_transport_date_received'];
        $dept_of_transport_lead_time = $row['dept_of_transport_lead_time'];
        $water_sanitation_date_submitted = $row['water_sanitation_date_submitted'];
        $water_sanitation_date_received = $row['water_sanitation_date_received'];
        $water_sanitation_lead_time = $row['water_sanitation_lead_time'];
        $ethekwini_transport_date_submitted = $row['ethekwini_transport_date_submitted'];
        $ethekwini_transport_date_received = $row['ethekwini_transport_date_received'];
        $ethekwini_transport_lead_time = $row['ethekwini_transport_lead_time'];
        $roads_date_submitted = $row['roads_date_submitted'];
        $roads_date_received = $row['roads_date_received'];
        $roads_lead_time = $row['roads_lead_time'];
        $electricity_date_submitted = $row['electricity_date_submitted'];
        $electricity_date_received = $row['electricity_date_received'];
        $electricity_lead_time = $row['electricity_lead_time'];
        $coastal_stormwater_catchment_date_submitted = $row['coastal_stormwater_catchment_date_submitted'];
        $coastal_stormwater_catchment_date_received = $row['coastal_stormwater_catchment_date_received'];
        $coastal_stormwater_catchment_lead_time = $row['coastal_stormwater_catchment_lead_time'];
        $development_planning_date_submitted = $row['development_planning_date_submitted'];
        $development_planning_date_received = $row['development_planning_date_received'];
        $development_planning_lead_time = $row['development_planning_lead_time'];
        $traffic_signals_date_submitted = $row['traffic_signals_date_submitted'];
        $traffic_signals_date_received = $row['traffic_signals_date_received'];
        $traffic_signals_lead_time = $row['traffic_signals_lead_time'];
        $enviromental_management_date_submitted = $row['enviromental_management_date_submitted'];
        $enviromental_management_date_received = $row['enviromental_management_date_received'];
        $enviromental_management_lead_time = $row['enviromental_management_lead_time'];
        $transportation_planning_date_submitted = $row['transportation_planning_date_submitted'];
        $transportation_planning_date_received = $row['transportation_planning_date_received'];
        $transportation_planning_lead_time = $row['transportation_planning_lead_time'];
        $technical_services_date_submitted = $row['technical_services_date_submitted'];
        $technical_services_date_received = $row['technical_services_date_received'];
        $technical_services_lead_time = $row['technical_services_lead_time'];
        $sembcorp_siza_water_date_submitted = $row['sembcorp_siza_water_date_submitted'];
        $sembcorp_siza_water_date_received = $row['sembcorp_siza_water_date_received'];
        $sembcorp_siza_water_lead_time = $row['sembcorp_siza_water_lead_time'];
        $legal_services_date_submitted = $row['legal_services_date_submitted'];
        $legal_services_date_received = $row['legal_services_date_received'];
        $legal_services_lead_time = $row['legal_services_lead_time'];
        $eskom_date_submitted = $row['eskom_date_submitted'];
        $eskom_date_received = $row['eskom_date_received'];
        $eskom_lead_time = $row['eskom_lead_time'];
        $parks_date_submitted = $row['parks_date_submitted'];
        $parks_date_received = $row['parks_date_received'];
        $parks_lead_time = $row['parks_lead_time'];
        $site_owner = $row['site_owner'];
        $external_la_wl_num = $row['external_la_wl_num'];
        $permissions_comments = $row['permissions_comments'];
        //$mat = $row['mat'];
         $eku_water_and_sanitation_date_submitted = null;
        if($row['eku_water_and_sanitation_date_submitted']){
            $eku_water_and_sanitation_date_submitted = Carbon::parse($row['eku_water_and_sanitation_date_submitted']);
        }
          $eku_water_and_sanitation_date_received = null;
        if($row['eku_water_and_sanitation_date_received']){
            $eku_water_and_sanitation_date_received = Carbon::parse($row['eku_water_and_sanitation_date_received']);
        }
        $eku_water_and_sanitation_lead_time = $row['eku_water_and_sanitation_lead_time'];
       
         $eku_roads_and_stormwater_date_submitted = null;
        if($row['eku_roads_and_stormwater_date_submitted']){
            $eku_roads_and_stormwater_date_submitted = Carbon::parse($row['eku_roads_and_stormwater_date_submitted']);
        }
          $eku_roads_and_stormwater_date_received = null;
        if($row['eku_roads_and_stormwater_date_received']){
            $eku_roads_and_stormwater_date_received = Carbon::parse($row['eku_roads_and_stormwater_date_received']);
        }
        
         $eku_roads_and_stormwater_lead_time = $row['eku_roads_and_stormwater_lead_time'];
         
         $eku_electricity_date_submitted = null;
        if($row['eku_electricity_date_submitted']){
            $eku_electricity_date_submitted = Carbon::parse($row['eku_electricity_date_submitted']);
        }
         $eku_electricity_date_received = null;
        if($row['eku_electricity_date_received']){
            $eku_electricity_date_received = Carbon::parse($row['eku_electricity_date_received']);
        }
        
        $eku_electricity_lead_time = $row['eku_electricity_lead_time'];
        
         $eku_metro_parks_date_submitted = null;
        if($row['eku_metro_parks_date_submitted']){
            $eku_metro_parks_date_submitted = Carbon::parse($row['eku_metro_parks_date_submitted']);
        }
        
         $eku_metro_parks_date_received = null;
        if($row['eku_metro_parks_date_received']){
            $eku_metro_parks_date_received = Carbon::parse($row['eku_metro_parks_date_received']);
        }
        
         $eku_metro_parks_lead_time = $row['eku_metro_parks_lead_time'];
         
           $eku_ict_department_date_submitted = null;
        if($row['eku_ict_department_date_submitted']){
            $eku_ict_department_date_submitted = Carbon::parse($row['eku_ict_department_date_submitted']);
        }
         
            $eku_ict_department_date_received = null;
        if($row['eku_ict_department_date_received']){
            $eku_ict_department_date_received = Carbon::parse($row['eku_ict_department_date_received']);
        }
        
        $eku_ict_department_lead_time = $row['eku_ict_department_lead_time'];
        
           $eku_eskom_date_submitted = null;
        if($row['eku_eskom_date_submitted']){
            $eku_eskom_date_submitted = Carbon::parse($row['eku_eskom_date_submitted']);
        }
        
          $eku_eskom_date_received = null;
        if($row['eku_eskom_date_received']){
            $eku_eskom_date_received = Carbon::parse($row['eku_eskom_date_received']);
        }
        
        $eku_eskom_lead_time = $row['eku_eskom_lead_time'];
        
          $eku_transnet_date_submitted = null;
        if($row['eku_transnet_date_submitted']){
            $eku_transnet_date_submitted = Carbon::parse($row['eku_transnet_date_submitted']);
        }
        
         $eku_transnet_date_received = null;
        if($row['eku_transnet_date_received']){
            $eku_transnet_date_received = Carbon::parse($row['eku_transnet_date_received']);
        }
        
        $eku_transnet_lead_time = $row['eku_transnet_lead_time'];
        
         $eku_rand_water_date_submitted = null;
        if($row['eku_rand_water_date_submitted']){
            $eku_rand_water_date_submitted = Carbon::parse($row['eku_rand_water_date_submitted']);
        }
        
        $eku_rand_water_date_received = null;
        if($row['eku_rand_water_date_received']){
            $eku_rand_water_date_received = Carbon::parse($row['eku_rand_water_date_received']);
        }
        
        $eku_rand_water_lead_time = $row['eku_rand_water_lead_time'];
        
        $eku_telkom_date_submitted = null;
        if($row['eku_telkom_date_submitted']){
            $eku_telkom_date_submitted = Carbon::parse($row['eku_telkom_date_submitted']);
        }
        
        $eku_telkom_date_received = null;
        if($row['eku_telkom_date_received']){
            $eku_telkom_date_received = Carbon::parse($row['eku_telkom_date_received']);
        }
        
        $eku_telkom_lead_time = $row['eku_telkom_lead_time'];
        
        $eku_neotel_date_submitted = null;
        if($row['eku_neotel_date_submitted']){
            $eku_neotel_date_submitted = Carbon::parse($row['eku_neotel_date_submitted']);
        }
        $eku_neotel_date_received = null;
        if($row['eku_neotel_date_received']){
            $eku_neotel_date_received = Carbon::parse($row['eku_neotel_date_received']);
        }
        $eku_neotel_lead_time = $row['eku_neotel_lead_time'];
        
        $eku_dark_fibre_africa_date_submitted = null;
        if($row['eku_dark_fibre_africa_date_submitted']){
            $eku_dark_fibre_africa_date_submitted = Carbon::parse($row['eku_dark_fibre_africa_date_submitted']);
        }
        
        $eku_dark_fibre_africa_date_received = null;
        if($row['eku_dark_fibre_africa_date_received']){
            $eku_dark_fibre_africa_date_received = Carbon::parse($row['eku_dark_fibre_africa_date_received']);
        }
         $eku_dark_fibre_africa_lead_time = $row['eku_dark_fibre_africa_lead_time'];
         
          $eku_mtn_date_submitted = null;
        if($row['eku_mtn_date_submitted']){
            $eku_mtn_date_submitted = Carbon::parse($row['eku_mtn_date_submitted']);
        }
        
         $eku_mtn_date_received = null;
        if($row['eku_mtn_date_received']){
            $eku_mtn_date_received = Carbon::parse($row['eku_mtn_date_received']);
        }
        $eku_mtn_lead_time = $row['eku_mtn_lead_time'];
        
         $eku_vodacom_date_submitted = null;
        if($row['eku_vodacom_date_submitted']){
            $eku_vodacom_date_submitted = Carbon::parse($row['eku_vodacom_date_submitted']);
        }
        
          $eku_vodacom_date_received = null;
        if($row['eku_vodacom_date_received']){
            $eku_vodacom_date_received = Carbon::parse($row['eku_vodacom_date_received']);
        }
        
         $eku_vodacom_lead_time = $row['eku_vodacom_lead_time'];
         
           $eku_metro_fibre_networx_date_submitted = null;
        if($row['eku_metro_fibre_networx_date_submitted']){
            $eku_metro_fibre_networx_date_submitted = Carbon::parse($row['eku_metro_fibre_networx_date_submitted']);
        }
        
           $eku_metro_fibre_networx_date_received = null;
        if($row['eku_metro_fibre_networx_date_received']){
            $eku_metro_fibre_networx_date_received = Carbon::parse($row['eku_metro_fibre_networx_date_received']);
        }
        
        $eku_metro_fibre_networx_lead_time = $row['eku_metro_fibre_networx_lead_time'];
        
            $coj_sanral_date_submitted = null;
        if(isset($row['coj_sanral_date_submitted'])){
            $coj_sanral_date_submitted = Carbon::parse($row['coj_sanral_date_submitted']);
        }
        
            $coj_sanral_date_received = null;
        if(isset($row['coj_sanral_date_received'])){
            $coj_sanral_date_received = Carbon::parse($row['coj_sanral_date_received']);
        }
        
        $coj_sanral_lead_time = $row['coj_sanral_lead_time'];
        
             $coj_gautrans_date_submitted = null;
       
        
            $coj_gautrans_date_received = null;
        if(isset($row['coj_gautrans_date_received'])){
            $coj_gautrans_date_received = Carbon::parse($row['coj_gautrans_date_received']);
        }

        $coj_gautrans_lead_time = null;
        if(isset($row['coj_gautrans_lead_time'])){
         $coj_gautrans_lead_time = $row['coj_gautrans_lead_time'];
        }
             $coj_prasa_date_submitted = null;
        if(isset($row['coj_prasa_date_submitted'])){
            $coj_prasa_date_submitted = Carbon::parse($row['coj_prasa_date_submitted']);
        }
        
            $coj_prasa_date_received = null;
        if(isset($row['coj_prasa_date_received'])){
            $coj_prasa_date_received = Carbon::parse($row['coj_prasa_date_received']);
        }

        $coj_prasa_lead_time = null;
        if(isset($row['coj_prasa_lead_time'])){
        $coj_prasa_lead_time = $row['coj_prasa_lead_time'];
        }

            $coj_water_date_submitted = null;
        if(isset($row['coj_water_date_submitted'])){
            $coj_water_date_submitted = Carbon::parse($row['coj_water_date_submitted']);
        }
        
           $coj_water_date_received = null;
        if(isset($row['coj_water_date_received'])){
            $coj_water_date_received = Carbon::parse($row['coj_water_date_received']);
        }
        
        $coj_water_lead_time = null;
        if(isset($row['coj_water_lead_time'])){
        $coj_water_lead_time = $row['coj_water_lead_time'];
        }
           $coj_jra_stormwater_date_submitted = null;
        if($row['coj_jra_stormwater_date_submitted']){
            $coj_jra_stormwater_date_submitted = Carbon::parse($row['coj_jra_stormwater_date_submitted']);
        }
        
           $coj_jra_stormwater_date_received = null;
        if($row['coj_jra_stormwater_date_received']){
            $coj_jra_stormwater_date_received = Carbon::parse($row['coj_jra_stormwater_date_received']);
        }
        
        $coj_jra_stormwater_lead_time = $row['coj_jra_stormwater_lead_time'];
        
           $coj_randwater_date_submitted = null;
        if($row['coj_randwater_date_submitted']){
            $coj_randwater_date_submitted = Carbon::parse($row['coj_randwater_date_submitted']);
        }
        
          $coj_randwater_date_received = null;
        if($row['coj_randwater_date_received']){
            $coj_randwater_date_received = Carbon::parse($row['coj_randwater_date_received']);
        }
        
        $coj_randwater_lead_time = $row['coj_randwater_lead_time'];
        
          $coj_city_power_date_submitted = null;
        if($row['coj_city_power_date_submitted']){
            $coj_city_power_date_submitted = Carbon::parse($row['coj_city_power_date_submitted']);
        }
        
         $coj_city_power_date_received = null;
        if($row['coj_city_power_date_received']){
            $coj_city_power_date_received = Carbon::parse($row['coj_city_power_date_received']);
        }
        
         $coj_city_power_lead_time = $row['coj_city_power_lead_time'];
         
         $coj_eskom_date_submitted = null;
        if(isset($row['coj_eskom_date_submitted'])){
            $coj_eskom_date_submitted = Carbon::parse($row['coj_eskom_date_submitted']);
        }
        
         $coj_eskom_date_received = null;
        if(isset($row['coj_eskom_date_received'])){
            $coj_eskom_date_received = Carbon::parse($row['coj_eskom_date_received']);
        }

        $coj_eskom_lead_time = null;
        if(isset($row['coj_eskom_lead_time'])){
          $coj_eskom_lead_time = $row['coj_eskom_lead_time'];
        }
           $coj_citiconnect_date_submitted = null;
        if($row['coj_citiconnect_date_submitted']){
            $coj_citiconnect_date_submitted = Carbon::parse($row['coj_citiconnect_date_submitted']);
        }
        
          $coj_citiconnect_date_received = null;
        if($row['coj_citiconnect_date_received']){
            $coj_citiconnect_date_received = Carbon::parse($row['coj_citiconnect_date_received']);
        }
        
        $coj_citiconnect_lead_time = $row['coj_citiconnect_lead_time'];
        
          $coj_city_parks_date_submitted = null;
        if(isset($row['coj_city_parks_date_submitted'])){
            $coj_city_parks_date_submitted = Carbon::parse($row['coj_city_parks_date_submitted']);
        }
        
          $coj_city_parks_date_received = null;
        if(isset($row['coj_city_parks_date_received'])){
            $coj_city_parks_date_received = Carbon::parse($row['coj_city_parks_date_received']);
        }

        $coj_city_parks_lead_time = null;
        if(isset($row['coj_city_parks_lead_time'])){
        $coj_city_parks_lead_time = $row['coj_city_parks_lead_time'];
        }
          $coj_sasol_gas_date_submitted = null;
        if($row['coj_sasol_gas_date_submitted']){
            $coj_sasol_gas_date_submitted = Carbon::parse($row['coj_sasol_gas_date_submitted']);
        }
          $coj_sasol_gas_date_received = null;
        if($row['coj_sasol_gas_date_received']){
            $coj_sasol_gas_date_received = Carbon::parse($row['coj_sasol_gas_date_received']);
        }
        
         $coj_sasol_gas_lead_time = $row['coj_sasol_gas_lead_time'];
         
           $coj_egoli_gas_date_submitted = null;
        if(isset($row['coj_egoli_gas_date_submitted'])){
            $coj_egoli_gas_date_submitted = Carbon::parse($row['coj_egoli_gas_date_submitted']);
        }
        
            $coj_egoli_gas_date_received = null;
        if(isset($row['coj_egoli_gas_date_received'])){
            $coj_egoli_gas_date_received = Carbon::parse($row['coj_egoli_gas_date_received']);
        }
        $coj_egoli_gas_lead_time = null;
        if(isset($row['coj_egoli_gas_lead_time'])){
         $coj_egoli_gas_lead_time = $row['coj_egoli_gas_lead_time'];
        }
             $coj_transnet_date_submitted = null;
        if(isset($row['coj_transnet_date_submitted'])){
            $coj_transnet_date_submitted = Carbon::parse($row['coj_transnet_date_submitted']);
        }
        
             $coj_transnet_date_received = null;
        if(isset($row['coj_transnet_date_received'])){
            $coj_transnet_date_received = Carbon::parse($row['coj_transnet_date_received']);
        }

        $coj_transnet_lead_time = null;
        if(isset($row['coj_transnet_date_received'])){
         $coj_transnet_lead_time = $row['coj_transnet_lead_time'];
        }
              $coj_dfa_date_submitted = null;
        if($row['coj_dfa_date_submitted']){
            $coj_dfa_date_submitted = Carbon::parse($row['coj_dfa_date_submitted']);
        }
        
             $coj_dfa_date_received = null;
        if(isset($row['coj_dfa_date_received'])){
            $coj_dfa_date_received = Carbon::parse($row['coj_dfa_date_received']);
        }
        $coj_dfa_lead_time = null;
        if(isset($row['coj_dfa_lead_time'])){
        $coj_dfa_lead_time = $row['coj_dfa_lead_time'];
        }
             $coj_neotel_date_submitted = null;
        if($row['coj_neotel_date_submitted']){
            $coj_neotel_date_submitted = Carbon::parse($row['coj_neotel_date_submitted']);
        }
        
              $coj_neotel_date_received = null;
        if($row['coj_neotel_date_received']){
            $coj_neotel_date_received = Carbon::parse($row['coj_neotel_date_received']);
        }
        
         $coj_neotel_lead_time = $row['coj_neotel_lead_time'];
         
               $coj_mtn_date_submitted = null;
        if(isset($row['coj_mtn_date_submitted'])){
            $coj_mtn_date_submitted = Carbon::parse($row['coj_mtn_date_submitted']);
        }
        
              $coj_mtn_date_received = null;
        if(isset($row['coj_mtn_date_received'])){
            $coj_mtn_date_received = Carbon::parse($row['coj_mtn_date_received']);
        }
        $coj_mtn_lead_time = null;
        if(isset($row['coj_mtn_lead_time'])){
        $coj_mtn_lead_time = $row['coj_mtn_lead_time'];
        }
              $coj_telkom_date_submitted = null;
        if($row['coj_telkom_date_submitted']){
            $coj_telkom_date_submitted = Carbon::parse($row['coj_telkom_date_submitted']);
        }
        
              $coj_telkom_date_received = null;
        if($row['coj_telkom_date_received']){
            $coj_telkom_date_received = Carbon::parse($row['coj_telkom_date_received']);
        }
        
         $coj_telkom_lead_time = $row['coj_telkom_lead_time'];

         $coj_total_number = null;
         if(isset($row['coj_total_number'])){
         $coj_total_number = $row['coj_total_number'];
         }
         $eku_total_number = null;
         if(isset($row['eku_total_number'])){
         $eku_total_number = $row['eku_total_number'];
        }
               $eku_sanral_date_submitted = null;
        if($row['eku_sanral_date_submitted']){
            $eku_sanral_date_submitted = Carbon::parse($row['eku_sanral_date_submitted']);
        }
        
              $eku_sanral_date_received = null;
        if($row['eku_sanral_date_received']){
            $eku_sanral_date_received = Carbon::parse($row['eku_sanral_date_received']);
        }
        $eku_sanral_lead_time = $row['eku_sanral_lead_time']; 
                $eku_prasa_date_submitted = null;
        if($row['eku_prasa_date_submitted']){
            $eku_prasa_date_submitted = Carbon::parse($row['eku_prasa_date_submitted']);
        }
                $eku_prasa_date_received = null;
        if($row['eku_prasa_date_received']){
            $eku_prasa_date_received = Carbon::parse($row['eku_prasa_date_received']);
        }
         $eku_prasa_lead_time = $row['eku_prasa_lead_time']; 
         $coj_surburb = $row['coj_surburb']; 
         $coj_region = $row['coj_region']; 
         $coj_street_name = $row['coj_street_name']; 
         $coj_renewal = $row['coj_renewal']; 
         $eku_surburb = $row['eku_surburb']; 
         $eku_region = $row['eku_region']; 
         $eku_street_name = $row['eku_street_name']; 
         $eku_renewal = $row['eku_renewal']; 
        
        
        //Insert query
        $insert_master_file_record = PermissionMasterFile::Where('service_id',$service_id)->Where('circuit_id',$service_id)->whereNull('datenew')->update([
            'datenew'  => $datenew,
            'permissions_status'  => $permissions_status,
            'site_a_lla_submitted'  => $site_a_lla_submitted,
            'site_a_lla_estimated'  => $site_a_lla_estimated,
            'site_a_lla_received'  => $site_a_lla_received,
            'site_b_lla_submitted'  => $site_b_lla_submitted,
            'site_b_lla_estimated'  => $site_b_lla_estimated,
            'site_b_lla_received'  => $site_b_lla_received,
            'wayleaves_submitted'  => $wayleaves_submitted,
            'wayleaves_estimated'  => $wayleaves_estimated,
            'wayleaves_received'  => $wayleaves_received,
            'wayleaves_status'  => $wayleaves_status,
            'resource'  => $resource,
            'wl_planned_submitted_date'  => $wl_planned_submitted_date,
            'province'  => $province,
            'osp_status_permissions'  => $osp_status_permissions,
            'isp_a_b_status'  => $isp_a_b_status,
            'existing_wl_ref_no'  => $existing_wl_ref_no,
            'exepected_wl_received_date'  => $exepected_wl_received_date,
            'total_number_of_responses_oustanding'  => $total_number_of_responses_oustanding,
            'final_wl_submission_date'  => $final_wl_submission_date,
            'wl_expiry_date'  => $wl_expiry_date,
            'wl_osp_status'  => $wl_osp_status,
            'stormwater_rou_date_submitted'  => $stormwater_rou_date_submitted,
            'stormwater_rou_date_received'  => $stormwater_rou_date_received,
            'stormwater_rou_lead_time'  => $stormwater_rou_lead_time,
            'sewer_rou_date_submitted'  => $sewer_rou_date_submitted,
            'sewer_rou_date_received'  => $sewer_rou_date_received,
            'sewer_rou_lead_time'  => $sewer_rou_lead_time,
        	'created_at'  => $current_date_time,
        	'updated_at'  => $current_date_time,
        	"telkom_date_submitted" =>  $telkom_date_submitted, 
            "telkom_date_received" => $telkom_date_received,
            "telkom_lead_time" => $telkom_lead_time,
            "sasol_date_submitted" => $sasol_date_submitted,
            "sasol_date_received" => $sasol_date_received,
            "sasol_lead_time" => $sasol_lead_time,
            "transnet_date_submitted" => $transnet_date_submitted,
            "transnet_date_received" => $transnet_date_received,
            "transnet_lead_time" => $transnet_lead_time,
            "neotel_date_submitted" => $neotel_date_submitted,
            "neotel_date_received" => $neotel_date_received,
            "neotel_lead_time" => $neotel_lead_time,
            "dfa_date_submitted" => $dfa_date_submitted,
            "dfa_date_received" => $dfa_date_received,
            "dfa_lead_time" => $dfa_lead_time,
            "mtn_date_submitted" => $mtn_date_submitted,
            "mtn_date_received" => $mtn_date_received,
            "mtn_lead_time" => $mtn_lead_time,
            "sanral_date_submitted" => $sanral_date_submitted,
            "sanral_date_received" => $sanral_date_received,
            "sanral_lead_time" => $sanral_lead_time,
            "dept_of_transport_date_submitted" => $dept_of_transport_date_submitted,
            "dept_of_transport_date_received" => $dept_of_transport_date_received,
            "dept_of_transport_lead_time" => $dept_of_transport_lead_time,
            "water_sanitation_date_submitted" => $water_sanitation_date_submitted,
            "water_sanitation_date_received" => $water_sanitation_date_received,
            "water_sanitation_lead_time" => $water_sanitation_lead_time,
            "ethekwini_transport_date_submitted" => $ethekwini_transport_date_submitted,
            "ethekwini_transport_date_received" => $ethekwini_transport_date_received,
            "ethekwini_transport_lead_time" => $ethekwini_transport_lead_time,
            "roads_date_submitted" => $roads_date_submitted,
            "roads_date_received" => $roads_date_received,
            "roads_lead_time" => $roads_lead_time,
            "electricity_date_submitted" => $electricity_date_submitted,
            "electricity_date_received" => $electricity_date_received,
            "electricity_lead_time" => $electricity_lead_time,
            "coastal_stormwater_catchment_date_submitted" => $coastal_stormwater_catchment_date_submitted,
            "coastal_stormwater_catchment_date_received" => $coastal_stormwater_catchment_date_received,
            "coastal_stormwater_catchment_lead_time" => $coastal_stormwater_catchment_lead_time,
            "development_planning_date_submitted" => $development_planning_date_submitted,
            "development_planning_date_received" => $development_planning_date_received,
            "development_planning_lead_time" => $development_planning_lead_time,
            "traffic_signals_date_submitted" => $traffic_signals_date_submitted,
            "traffic_signals_date_received" => $traffic_signals_date_received,
            "traffic_signals_lead_time" => $traffic_signals_lead_time,
            "enviromental_management_date_submitted" => $enviromental_management_date_submitted,
            "enviromental_management_date_received" => $enviromental_management_date_received,
            "enviromental_management_lead_time" => $enviromental_management_lead_time,
            "transportation_planning_date_submitted" => $transportation_planning_date_submitted,
            "transportation_planning_date_received" => $transportation_planning_date_received,
            "transportation_planning_lead_time" => $transportation_planning_lead_time,
            "technical_services_date_submitted" => $technical_services_date_submitted,
            "technical_services_date_received" => $technical_services_date_received,
            "technical_services_lead_time" => $technical_services_lead_time,
            "sembcorp_siza_water_date_submitted" => $sembcorp_siza_water_date_submitted,
            "sembcorp_siza_water_date_received" => $sembcorp_siza_water_date_received,
            "sembcorp_siza_water_lead_time" => $sembcorp_siza_water_lead_time,
            "legal_services_date_submitted" => $legal_services_date_submitted,
            "legal_services_date_received" => $legal_services_date_received,
            "legal_services_lead_time" => $legal_services_lead_time,
            "eskom_date_submitted" => $eskom_date_submitted,
            "eskom_date_received" => $eskom_date_received,
            "eskom_lead_time" => $eskom_lead_time,
            "parks_date_submitted" => $parks_date_submitted,
            "parks_date_received" => $parks_date_received,
            "parks_lead_time" => $parks_lead_time,
            "site_owner" => $site_owner,
            "external_la_wl_num" => $external_la_wl_num,
            "permissions_comments" => $permissions_comments,
            //"mat" => $mat
            'eku_water_and_sanitation_date_submitted' => $eku_water_and_sanitation_date_submitted,
            'eku_water_and_sanitation_date_received' => $eku_water_and_sanitation_date_received,
            'eku_water_and_sanitation_lead_time' => $eku_water_and_sanitation_lead_time,
            'eku_roads_and_stormwater_date_submitted' => $eku_roads_and_stormwater_date_submitted,
            'eku_roads_and_stormwater_date_received' => $eku_roads_and_stormwater_date_received,
            'eku_roads_and_stormwater_lead_time' => $eku_roads_and_stormwater_lead_time,
            'eku_electricity_date_submitted' => $eku_electricity_date_submitted,
            'eku_electricity_date_received' => $eku_electricity_date_received,
            'eku_electricity_lead_time' => $eku_electricity_lead_time,
            'eku_metro_parks_date_submitted' => $eku_metro_parks_date_submitted,
            'eku_metro_parks_date_received' => $eku_metro_parks_date_received,
            'eku_metro_parks_lead_time' => $eku_metro_parks_lead_time,
            'eku_ict_department_date_submitted' => $eku_ict_department_date_submitted,
            'eku_ict_department_date_received' => $eku_ict_department_date_received,
            'eku_ict_department_lead_time' => $eku_ict_department_lead_time,
            'eku_eskom_date_submitted' => $eku_eskom_date_submitted,
            'eku_eskom_date_received' => $eku_eskom_date_received,
            'eku_eskom_lead_time' => $eku_eskom_lead_time,
            'eku_transnet_date_submitted' => $eku_transnet_date_submitted,
            'eku_transnet_date_received' => $eku_transnet_date_received,
            'eku_transnet_lead_time' => $eku_transnet_lead_time,
            'eku_rand_water_date_submitted' => $eku_rand_water_date_submitted,
            'eku_rand_water_date_received' => $eku_rand_water_date_received,
            'eku_rand_water_lead_time' => $eku_rand_water_lead_time,
            'eku_telkom_date_submitted' => $eku_telkom_date_submitted,
            'eku_telkom_date_received' => $eku_telkom_date_received,
            'eku_telkom_lead_time' => $eku_telkom_lead_time,
            'eku_neotel_date_submitted' => $eku_neotel_date_submitted,
            'eku_neotel_date_received' => $eku_neotel_date_received,
            'eku_neotel_lead_time' => $eku_neotel_lead_time,
            'eku_dark_fibre_africa_date_submitted' => $eku_dark_fibre_africa_date_submitted,
            'eku_dark_fibre_africa_date_received' => $eku_dark_fibre_africa_date_received,
            'eku_dark_fibre_africa_lead_time' => $eku_dark_fibre_africa_lead_time,
            'eku_mtn_date_submitted' => $eku_mtn_date_submitted,
            'eku_mtn_date_received' => $eku_mtn_date_received,
            'eku_mtn_lead_time' => $eku_mtn_lead_time,
            'eku_vodacom_date_submitted' => $eku_vodacom_date_submitted,
            'eku_vodacom_date_received' => $eku_vodacom_date_received,
            'eku_vodacom_lead_time' => $eku_vodacom_lead_time,
            'eku_metro_fibre_networx_date_submitted' => $eku_metro_fibre_networx_date_submitted,
            'eku_metro_fibre_networx_date_received' => $eku_metro_fibre_networx_date_received,
            'eku_metro_fibre_networx_lead_time' => $eku_metro_fibre_networx_lead_time,
            'coj_sanral_date_submitted' => $coj_sanral_date_submitted,
            'coj_sanral_date_received' => $coj_sanral_date_received,
            'coj_sanral_lead_time' => $coj_sanral_lead_time,
            'coj_gautrans_date_submitted' => $coj_gautrans_date_submitted,
            'coj_gautrans_date_received' => $coj_gautrans_date_received,
            'coj_gautrans_lead_time' => $coj_gautrans_lead_time,
            'coj_prasa_date_submitted' => $coj_prasa_date_submitted,
            'coj_prasa_date_received' => $coj_prasa_date_received,
            'coj_prasa_lead_time' => $coj_prasa_lead_time,
            'coj_water_date_submitted' => $coj_water_date_submitted,
            'coj_water_date_received' => $coj_water_date_received,
            'coj_water_lead_time' => $coj_water_lead_time,
            'coj_jra_stormwater_date_submitted' => $coj_jra_stormwater_date_submitted,
            'coj_jra_stormwater_date_received' => $coj_jra_stormwater_date_received,
            'coj_jra_stormwater_lead_time' => $coj_jra_stormwater_lead_time,
            'coj_randwater_date_submitted' => $coj_randwater_date_submitted,
            'coj_randwater_date_received' => $coj_randwater_date_received,
            'coj_randwater_lead_time' => $coj_randwater_lead_time,
            'coj_city_power_date_submitted' => $coj_city_power_date_submitted,
            'coj_city_power_date_received' => $coj_city_power_date_received,
            'coj_city_power_lead_time' => $coj_city_power_lead_time,
            'coj_eskom_date_submitted' => $coj_eskom_date_submitted,
            'coj_eskom_date_received' => $coj_eskom_date_received,
            'coj_eskom_lead_time' => $coj_eskom_lead_time,
            'coj_citiconnect_date_submitted' => $coj_citiconnect_date_submitted,
            'coj_citiconnect_date_received' => $coj_citiconnect_date_received,
            'coj_citiconnect_lead_time' => $coj_citiconnect_lead_time,
            'coj_city_parks_date_submitted' => $coj_city_parks_date_submitted,
            'coj_city_parks_date_received' => $coj_city_parks_date_received,
            'coj_city_parks_lead_time' => $coj_city_parks_lead_time,
            'coj_sasol_gas_date_submitted' => $coj_sasol_gas_date_submitted,
            'coj_sasol_gas_date_received' => $coj_sasol_gas_date_received,
            'coj_sasol_gas_lead_time' => $coj_sasol_gas_lead_time,
            'coj_egoli_gas_date_submitted' => $coj_egoli_gas_date_submitted,
            'coj_egoli_gas_date_received' => $coj_egoli_gas_date_received,
            'coj_egoli_gas_lead_time' => $coj_egoli_gas_lead_time,
            'coj_transnet_date_submitted' => $coj_transnet_date_submitted,
            'coj_transnet_date_received' => $coj_transnet_date_received,
            'coj_transnet_lead_time' => $coj_transnet_lead_time,
            'coj_dfa_date_submitted' => $coj_dfa_date_submitted,
            'coj_dfa_date_received' => $coj_dfa_date_received,
            'coj_dfa_lead_time' => $coj_dfa_lead_time,
            'coj_neotel_date_submitted' => $coj_neotel_date_submitted,
            'coj_neotel_date_received' => $coj_neotel_date_received,
            'coj_neotel_lead_time' => $coj_neotel_lead_time,
            'coj_mtn_date_submitted' => $coj_mtn_date_submitted,
            'coj_mtn_date_received' => $coj_mtn_date_received,
            'coj_mtn_lead_time' => $coj_mtn_lead_time,
            'coj_telkom_date_submitted' => $coj_telkom_date_submitted,
            'coj_telkom_date_received' => $coj_telkom_date_received,
            'coj_telkom_lead_time' => $coj_telkom_lead_time,
            'coj_total_number' => $coj_total_number,
            'eku_total_number' => $eku_total_number,
            'eku_sanral_date_submitted' => $eku_sanral_date_submitted,
            'eku_sanral_date_received' => $eku_sanral_date_received,
            'eku_sanral_lead_time' => $eku_sanral_lead_time,
            'eku_prasa_date_submitted' => $eku_prasa_date_submitted,
            'eku_prasa_date_received' => $eku_prasa_date_received,
            'eku_prasa_lead_time' => $eku_prasa_lead_time,
            'coj_surburb' => $coj_surburb,
            'coj_region' => $coj_region,
            'coj_street_name' => $coj_street_name,
            'coj_renewal' => $coj_renewal,
            'eku_surburb' => $eku_surburb,
            'eku_region' => $eku_region,
            'eku_street_name' => $eku_street_name,
            'eku_renewal' => $eku_renewal,
            
       ]);
    }
	//print_r($insert_master_file_record);exit;
        //check if record in inserted or not
        if($insert_master_file_record){
           return  $insert_master_file_record;
        }
    }

   
}
