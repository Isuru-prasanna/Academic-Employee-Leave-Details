<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpLeaveController extends Controller
{
    
  public function EmpleaveView(){

   $leaveTypes = DB::table('leave_types')->get();

    return view('pages\leave\leaveTypeView')->with('leaveTypes',$leaveTypes);
}

    public function EmpleaveSave(Request $request){

        DB::table('leave_types')->insert([
            'leavetypes' => $request->leatype
        ]);
        return redirect()->back();
    }

    public function delete_leave($id){
        DB::delete('delete from leave_types where id = ?', [$id]);
        return redirect()->back();
    }
       /**
     * view into Employee leave types data.
     * @param Request $id get request with data
     * @return view $leaveTypesup  Leave type view.
     */
    public function updateempleaveview($id){

        $leaveTypesup = DB::table('leave_types')->where('id','=',$id)->get()->first();
        return view('pages\leave\leaveTypeUpdate')->with('leaveTypesup',$leaveTypesup);

    }
      /**
     * Update into Employee leave types data.
     * @return view Leave view redirection.
     */
    public function updateempleave(Request $request){
        DB::update('update leave_types set leavetypes = ?  where id = ?', 
        [$request->leatype,$request->id]);
        return redirect('/Emplevtype');
    }
        /**
     * Returns the view for Employee leave details data
     * @return view Leave Details view
     */
    public function EmplevDetails(){
        $employee = DB::table('employees as emp')
        ->leftJoin('designations as des','des.id','=','emp.empDesig')
        ->leftJoin('departments as dep','dep.id','=','emp.empDept')
        ->leftJoin('faculties as fac','fac.id','=','dep.fid')->get();
            return view('pages.leave.leaveDetails.acedemicLeaveDetails')->with('employee',$employee);
    }
         /**
   * View the given employee Leave Details
   * @param Request $epf get request with data
   * @return View $employee get into database employee Details.
   * $leavetyp get into database leavetyps.
   * $empleavedetails get into database data.
   */
    public function epmleaveview($epf){
        $employee = Employee::where('empepf', '=', $epf)->first(); 
        $leavetyp = DB::table('leave_types')->get();
        $empleavdetails = DB::table('leave_details as levde')
                        ->leftJoin('employees as emp','emp.empepf','=','levde.empepf')
                         ->where('levde.empepf','=',$epf)
                        ->get();
         return view('pages.leave.leaveDetails.academicleaveViewDetails')->with('employee', $employee)->with('leavetyp',$leavetyp)->with('empleavdetails', $empleavdetails);
        }
        /**
   * Save the given employee Leave Details
   * @param Request $request post request with data
   * @return View Leave view redirection
   */
    public function leaveSave(Request $request){
        
        DB::table('leave_details')->insert([
            'empepf' => $request->upfno,
            'leave_type' => $request->leavetyp,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'duration' =>$request->duration,
            'dateleave' =>$request->dateforleave,
            'year'=>$request->year
        ]);
        return redirect()->back();
    }
      /**
   * Delete the given employee Leave Details
   * @param Request $empepf get request with data
   * @return View Leave view redirection
   */
    public function delete_Leave_details($empepf){
        DB::delete('delete from leave_details where empepf = ?', [$empepf]);
        return redirect()->back();
    }
    /**
     * Update View get Employee leave Details data.
     * @param Request $empepf get request with data
     * @return view $levupdeview  Leave details view.
     */
    public function update_Leave_details_view($empepf){
        $leavetyp = DB::table('leave_types')->get();
        $levupdeview = DB::table('leave_details')->where('empepf','=',$empepf)->get()->first();
        return view('pages.leave.leaveDetails.academicLeaDetaUpdateView')->with('levupdeview',$levupdeview)->with('leavetyp', $leavetyp);
    }
     /**
     * Update into Employee leave Details data.
     * @return view Leave details view.
     */
    public function leaveDetailsUpdate(Request $request)
    {
        DB::update('update leave_details set leave_type = ? , startdate = ? , enddate = ? , duration = ? , dateleave  = ? , year = ? where empepf = ?', 
        [$request->leavetyp,$request->startdate,$request->enddate,$request->duration,$request->dateforleave,$request->year,$request->upfnos]);
        return redirect()->back();
    }
}

