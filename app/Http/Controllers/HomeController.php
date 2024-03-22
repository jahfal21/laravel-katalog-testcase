<?php

namespace App\Http\Controllers;

use App\Exports\TestCasesExport;
use App\Models\User;
use App\Models\TestCase;
use App\Models\SelectedTestCase;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $data_testcase = TestCase::all();
        return view('homepage_view.home', compact('data_testcase'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('homepage_view.profil', compact('user'));
    }

    public function addTestCase(Request $request)
    {
        $data_testcase = new TestCase([
            'test_domain' => $request->get('test_domain'),
            'module_name' => $request->get('module_name'),
            'test_description' => $request->get('test_description'),
            'test_case_type' => $request->get('test_case_type'),
            'test_step' => $request->get('test_step'),
            'test_data' => $request->get('test_data'),
            'expected_result' => $request->get('expected_result'),
            'actual_result' => $request->get('actual_result')
        ]);
        $data_testcase->save();   
        return redirect()->back()->with('success', 'Test Case saved!');
    }

    public function editTestCase(Request $request, $id)
    {
        $request->validate([
            'test_domain' => 'required',
            'module_name' => 'required',
            'test_description' => 'required',
            'test_case_type' => 'required',
            'test_step' => 'required',
            'test_data' => 'required',
            'expected_result' => 'required',
            'actual_result' => 'nullable',
        ]);

        $data_testcase = TestCase::findOrFail($id);
        $data_testcase->test_domain = $request->test_domain;
        $data_testcase->module_name = $request->module_name;
        $data_testcase->test_description = $request->test_description;
        $data_testcase->test_case_type = $request->test_case_type;
        $data_testcase->test_step = $request->test_step;
        $data_testcase->test_data = $request->test_data;
        $data_testcase->expected_result = $request->expected_result;
        $data_testcase->actual_result = $request->actual_result; 
        $data_testcase->save();   

        return redirect()->back()->with('success', 'Test Case Updated!');
    }

    public function deleteTestCase($id)
    {
        $data_testcase = TestCase::findOrFail($id);
        $data_testcase->delete();

        return redirect()->back()->with('success', 'Test Case Deleted!');
    }

    public function showUser()
    {
        $users = User::where('role_id', 2)->get();
        return view('homepage_view.manage', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id != 1) {
            $user->delete();
            return redirect()->back()->with('success', 'User has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Admin user cannot be deleted.');
        }
    }
}
