<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormData;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    //
    public function ageGroups()
    {
        return view('admin_panel.age_groups');

    }

    public function attributes()
    {
        return view('admin_panel.attributes');

    }

    public function formAttributes()
    {
        return view('admin_panel.form_attributes');

    }

    public function addFormAttributes()
    {
        return view('admin_panel.add_form_attribute');

    }

    public function editFormAttributes($form_id)
    {

        return view('admin_panel.edit_form_attribute', ['form_id' => $form_id]);
    }

    public function createForm($form_attributes_id)
    {

        return view('admin_panel.create_form', ['form_attributes_id' => $form_attributes_id]);

    }

    public function createFormData()
    {

        return view('admin_panel.form_data', ['form' => null]);

    }

    public function editFormData($form_id)
    {

        $form = Form::findOrFail($form_id);

        return view('admin_panel.form_data', ['form' => $form]);

    }

    public function reportList()
    {

        return view('admin_panel.report_list');
    }

    public function reportListComment($form)
    {

        return view('admin_panel.report_list_comment', compact('form'));
    }

    public function report()
    {
        $formdata = FormData::all();

        $res = Form::where('status', true)->get();
        // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
        //     return $group->sortBy('age_group.min')->unique('age_group.min');
        // });

        $quartile = ['2023-12-07 10:20:34', '2023-12-07 10:20:37'];
        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
            ->select('attribute_id', 'age_group_id',
                DB::raw('SUM(male) as male'),
                DB::raw('SUM(female) as female')
            )->whereBetween('created_at', $quartile)
            ->get();

        $users = User::all();

        return view('admin_panel.report', [
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users,
        ]);

    }

    public function viewReport($form) {
        $form = Form::findOrFail($form);

        return view('admin_panel.single_form', ['form' => $form]);

    }

    public function reportComment($report)
    {
        $formdata = FormData::all();

        $res = Form::where('status', true)->get();
        // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
        //     return $group->sortBy('age_group.min')->unique('age_group.min');
        // });

        $quartile = ['2023-12-07 10:20:34', '2023-12-07 10:20:37'];
        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
            ->select('attribute_id', 'age_group_id',
                DB::raw('SUM(male) as male'),
                DB::raw('SUM(female) as female')
            )->whereBetween('created_at', $quartile)
            ->get();

        $users = User::all();

        return view('admin_panel.report_comment', [
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users,
            'report' => $report,
        ]);
    }

    public function admins()
    {

        return view('admin_panel.admin_list');
    }

    public function addAdmin()
    {
        return view('admin_panel.add_admin');

    }

    public function editAdmin($admin_id)
    {

        return view('admin_panel.edit_admin', ['admin_id' => $admin_id]);
    }

    public function deactivatedAdmins()
    {

        $admins_status = false;

        return view('admin_panel.deactivated_admin_list', ['admins_status' => $admins_status]);
    }

    public function staffs()
    {

        return view('admin_panel.staff_list');
    }

    public function addStaff()
    {
        return view('admin_panel.add_staff');

    }

    public function editStaff($staff_id)
    {

        return view('admin_panel.edit_staff', ['staff_id' => $staff_id]);
    }

    public function deactivatedStaffs()
    {

        $staffs_status = false;

        return view('admin_panel.deactivated_staff_list', ['staffs_status' => $staffs_status]);
    }

    public function roles()
    {
        return view('admin_panel.roles');

    }

    public function permissions()
    {
        return view('admin_panel.permissions');

    }

    public function permissionsToRoles()
    {
        return view('admin_panel.permissions_to_role_list');

    }

    public function addPermissionsToRole()
    {
        return view('admin_panel.add_permissions_to_role');

    }

    public function editPermissionsToRole($role_id)
    {
        return view('admin_panel.edit_permissions_to_role', ['role_id' => $role_id]);

    }

}