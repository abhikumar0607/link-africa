@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.main-dashboard.dashboard-header')
            <div class="col-md-3">
            <form class="year-filter" action="{{url('admin/monthly-kam-name-dashboard')}}" method="GET" role="search">
             <div class="form-group">
                <select class="form-control" name="year">
                  <option value="" selected="">Please Select Year</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
              </select>
             </div>
             <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-submt">Submit</button>
            </div>
           </form>
           </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="project-data">
     <div class="container-fluid">
      <div class="table-html-desgin">
        <?php //echo "<pre>";print_r($all_kam_name_records);exit; ?>
         <table>
             <thead>
               <tr>
                 <th class="dash-class" scope="col">Kam Name</th>
                 <th scope="col" class="tree-tre"> 
                   <span>Jan</span>                 
                 </th>
                 <th scope="col" class="tree-tre info" >
                   <span>Feb</span>
                 </th>
                 <th scope="col" class="tree-tre info">
                     <span>March</span>
                </th>
                  <th scope="col" class="tree-tre info">
                     <span>April</span>
                </th>
                  <th scope="col" class="tree-tre info">
                     <span>May</span>
                </th>
                  <th scope="col" class="tree-tre info">
                     <span>June</span>
                </th>
                  <th scope="col" class="tree-tre info">
                     <span>July</span>
                </th>
                <th scope="col" class="tree-tre info">
                     <span>August</span>
                </th>
                <th scope="col" class="tree-tre info">
                     <span>September</span>
                </th>
                <th scope="col" class="tree-tre info">
                     <span>October</span>
                </th>
                <th scope="col" class="tree-tre info">
                     <span>November</span>
                </th>
                <th scope="col" class="tree-tre info">
                     <span>December</span>
                </th>
                 <th class="dash-class" scope="col">Grand Total</th>
               </tr>
             </thead>
             <tbody>
             <?php 
             $totalSum = 0;
             $result4442 = 0;
             $totals = array();
             foreach($all_kam_name_records as $kam_name){  
                $kamName = $kam_name['kam_name'];
                $sum = 0;
                foreach($kam_name as $key => $value){
                    if ($key !== 'kam_name') {
                        if (!isset($totals[$key])) {
                            $totals[$key] = 0;
                        }
                        $totals[$key] += $value['po_mrc'];
                    } 
                    
                }

                $monthlySum = 0;

                // Loop through the months (jan_data, feb_data, etc.)
                foreach (['jan_data', 'feb_data', 'march_data', 'april_data', 'may_data', 'june_data', 'july_data','aug_data','sep_data','oct_data','nov_data'] as $month) {
                    $monthlySum += $kam_name[$month]['po_mrc'];
                   // print_r($month);
                }

                $result444 = $monthlySum;
                $result4442 += $monthlySum;
               //exit;
              
             ?>
             <tr>
                 <th data-label="Account">{{ $kam_name['kam_name'] }}</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['jan_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['jan_data']['jan_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['feb_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['feb_data']['feb_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['march_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['march_data']['march_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['april_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['april_data']['april_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['may_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['may_data']['may_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['june_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['june_data']['june_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['july_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['july_data']['july_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['aug_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['aug_data']['aug_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['sep_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['sep_data']['sep_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['oct_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['oct_data']['oct_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['nov_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['nov_data']['nov_count'] }})</strong><em></em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($kam_name['dec_data']['po_mrc'], 2) }}<strong>&nbsp;({{ $kam_name['dec_data']['dec_count'] }})</strong><em></em></span></td>
                 <td data-label="Due Date"><?php echo number_format($result444, 2); ?></td>
               </tr>
             <tr>
           <?php } 
           
           // print_r($result)?>

            <td scope="row" data-label="Acount" class="something-rong"><strong>Grand Total</strong></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['jan_data'], 2)?></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['feb_data'], 2)?></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['march_data'], 2)?></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['april_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['may_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['june_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['july_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['aug_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['sep_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['oct_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['nov_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($totals['dec_data'], 2)?></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($result4442, 2) ?></td>
           </tr>     
             </tbody>
           </table>
         
         </div>
        </div>
    </section>
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection