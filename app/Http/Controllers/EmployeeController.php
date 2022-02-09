<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use App\services\EmployeeService;
class EmployeeController extends Controller
{
    private $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;

    }
    public function employee()
    {
        return view('employee.index');
    }

    public function index(Request $request)
    {
        $listEmployees = $this->employeeService->listEmployee($request);
        return response()->json($listEmployees);
    }

    public function store(StoreEmployeeRequest $request){
      $response = $this->employeeService->storeEmployee($request->validated());
      return response()->json(['employee' => $response['employee']],$response['status']);
    }
    public function update(StoreEmployeeRequest $request, $id){
        $response = $this->employeeService->updateEmployee($request->validated(), $id);
        return response()->json(['employee' => $response['employee']],$response['status']);
    }
    public function delete($id)
    {
        $response = $this->employeeService->deleteEmployee($id);
        return response()->json(['success' => $response['success']],$response['status']);

    }
    public function disabled($id, $status)
    {
        $response = $this->employeeService->disabledEmployee($id, $status);
        return response()->json(['employee' => $response['employee']],$response['status']);

    }

}
