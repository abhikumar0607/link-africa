<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Exports\UsersExport;
use Excel;
use App\Models\User;
use App\Models\Customer;
use Carbon\Carbon;

class UserManageController extends Controller
{
    //Function for show add new user
    public function index(){
        $view =  view('admin.user-management.add-user');
        return $view;
    }

    //Function for submit add new user
    public function submit_add_new(Request $request){
        request()->validate([
            'email' => 'required', 'string', 'max:255',
            'password' => 'required', 'string', 'max:255'
        ]);
        $birth_date = null;
        if($request['birth_date']){
            $birth_date = Carbon::parse($request['birth_date']);
        }

        //Check if employee code is exit or not
        $IsEmployeeExits = User::where('emp_code',$request['employee_code'])->exists();
        if($IsEmployeeExits){
            return back()->with('unsuccess','Employee code is already exits.')->withInput($request->input());
        } else {
            //Check if email is exit or not
            $IsEmailExits = User::where('email',$request['email'])->exists();
            if($IsEmailExits){
                return back()->with('unsuccess','Email is already Taken. Please try With new email.')->withInput($request->input());
            } else {

                $region = implode(',', $request['region']);
                $edit_from_access = implode(',',$request['edit_form_access']);
                //Create new user
                $create_user = User::create([
                    'name' => $request['first_name'].' '.$request['last_name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'emp_code' => $request['employee_code'],
                    'birth_date' => $birth_date,
                    'company_rule' => $request['company_rule'],
                    'cost_centre' => $request['cost_center'],
                    'department' => $request['department'],
                    'team' => $request['team'],
                    'user_type' => 'Admin',
                    'edit_form_access' => $edit_from_access ,
                    'user_status' => $request['user_status'],
                    'regions' => $region,
                ]);
                //Check if new user is created
                if($create_user) {
                    return back()->with('success','New User Is Created Successfully.');
                } else {
                    return back()->with('unsuccess','These credentials do not match our records.!');
                }
            }
        }
    }

    //Function for show allnew user
    public function all_user_list(){
        $all_users = User::where('user_type', 'admin')->paginate(15);
        $view =  view('admin.user-management.all-user',compact('all_users'));
        return $view;
    }
    
    //Function for show single user
    public function single_user($id){
        $user = User::where('id',$id)->where('user_type', 'admin')->first();
        $view =  view('admin.user-management.single-user',compact('user'));
        // echo '<pre>'; print_r($user); echo '</pre>'; exit;
        return $view;
    }

    //Function for delete single user
    public function delete_user($id){
        $user = User::where('id',$id)->where('user_type', 'admin')->delete();
       //Check if user is deleted or not
       if($user){
            return back()->with('success','User Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //Function for update  user
    public function update_user(Request $request){
        $birth_date = null;
        if($request['birth_date']){
            $birth_date = Carbon::parse($request['birth_date']);
        }
        //Update user
        $edit_form_access = "";
        if($request['edit_form_access']){
        $edit_form_access = implode(',', $request['edit_form_access']);
        }
        $region = "";
        if($request['region']){
        $region = implode(',', $request['region']);
        }
        $update_user = User::where('id', $request['id'])->update([
            'name' => $request['first_name'].' '.$request['last_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $birth_date,
            'company_rule' => $request['company_rule'],
            'cost_centre' => $request['cost_center'],
            'department' => $request['department'],
            'team' => $request['team'],
            'edit_form_access' => $edit_form_access,
            'regions' => $region,
            'user_status' => $request['user_status'],
        ]);
       
        //Check if new user is update
        if($update_user) {
            return back()->with('success','User Is Updated Successfully.');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

       //function for search records
       public function search_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        
        $all_records = User::where('name','like','%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%')->orWhere('department', 'like', '%'.$keyword.'%')->orWhere('edit_form_access', 'like', '%'. $keyword.'%')->paginate(50);
        $view =  view('admin/user-management/search-list', compact('all_records'));
        return $view;
    }

    //function for export users
    public function export_user() {
     return Excel::download(new UsersExport, 'users.xlsx');
    }

    // function for reset password
    public function reset_password(){
        $view =  view('admin/user-management/resset-password');
        return $view;  
    }

   // function for check email for reset password
   public function check_email(Request $request){
    $email = $request->input('email');
    $update_request_type = $request->input('update_request_type');
    $password = $request->input('password');
    //Check if request type is matched or not
    if($update_request_type == 'is_email_check'){
        //Chec k if is email exit or not
        $IsEmailExits = User::where('email',$email)->exists();
        if($IsEmailExits){
            echo "Please Enter New Password";
            echo' <div class="form-group" id="password-cls">
            <label for="password"> Reset Password</label>
            <input type="password" name="password" value="" id="password" class="form-control">
            </div>';
            echo '<script>jQuery("#update_request_type").val("is_update_password");</script>';
        }  else {
            echo "Email You Entered is Wrong Does Not Match Our Data";
        }
    } elseif($update_request_type == 'is_update_password'){
        //Chec k if is email exit or not
        $IsEmailExits = User::where('email',$email)->exists();
        if($IsEmailExits){
            $update_user = User::where('email', $email)->update([
                'password' => Hash::make($password),
            ]);
            echo "Password Updated Successfully";
            echo '<script>setTimeout(function(){
                window.location.reload();
             }, 2000);</script>';
        }  else {
            echo "Oops something went wrong !";
        }
    } else{
        echo "Oops something wrong!";
    }
   }

       // function for add client as user
       public function view_client_page(){
        $records = Customer::orderBy('name')->get();
        $view =  view('admin.user-management.add-client-user',compact('records'));
        return $view;
    }

    //function for submit client as user
    public function submit_user_client(Request $request){
        request()->validate([
            'client_name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'max:255',
            'password' => 'required', 'string', 'max:255'
        ]);
     
     
            //Check if email is exit or not
            $IsEmailExits = User::where('email',$request['email'])->exists();
            if($IsEmailExits){
                return back()->with('unsuccess','Email is already Taken. Please try With new email.')->withInput($request->input());
            } else {

                $create_user = User::create([
                    'client_name' => $request['client_name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
                //Check if new user is created
                if($create_user) {
                    return back()->with('success','New User Is Created Successfully.');
                } else {
                    return back()->with('unsuccess','These credentials do not match our records.!');
                }
    }
  }
}
