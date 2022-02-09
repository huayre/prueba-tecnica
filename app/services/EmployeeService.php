<?php

namespace App\services;

use App\models\Employee;
use Illuminate\Support\Facades\Log;

class EmployeeService
{
    public function listEmployee($filters)
    {
        $contractStartDate = isset($filters->contract_start_date) ? $filters->contract_start_date : false;
        $contractEndDate = isset($filters->contract_end_date) ? $filters->contract_end_date : false;
        $birthDate = isset($filters->birth_date) ? $filters->birth_date : false;
        $charge = isset($filters->charge) ? $filters->charge : false;
        $area = isset($filters->area) ? $filters->area : false;

        return Employee::whereNull('deleted_at')
            ->when($contractStartDate,function ($query, $contractStartDate){
                return $query->where('contract_start_date', $contractStartDate);
            })
            ->when($contractEndDate,function ($query, $contractEndDate){
                return $query->where('contract_end_date', $contractEndDate);
            })
            ->when($birthDate,function ($query, $birthDate){
                return $query->where('birth_date', $birthDate);
            })
            ->when($charge,function ($query, $charge){
                return $query->where('charge', $charge);
            })
            ->when($area,function ($query, $area){
                return $query->where('area', $area);
            })
            ->orderBy('created_at','desc')
            ->paginate(10000);

    }

    public function storeEmployee($data)
    {
        $response = ['employee' => null, 'status' => 500];
        try {
            $employee = Employee::create($data);
            $response['employee'] = $employee;
            $response['status'] = 200;

        } catch (Exception $e) {
            Log::error('error al crear el empleado: ' . $e->getTrace() . ' ' . $e->getMessage());
        }
        return $response;

    }
    public function updateEmployee($data ,$id)
    {
        $response = ['employee' => null, 'status' => 500];
        try {
            $employeeFind = Employee::find($id);
            $employee = $employeeFind->update($data);
            $response['employee'] = $employee;
            $response['status'] = 200;

        } catch (Exception $e) {
            Log::error('error al actualizar el empleado: ' . $e->getTrace() . ' ' . $e->getMessage());
        }
        return $response;

    }

    public function deleteEmployee($id)
    {
        $response = ['success' => false, 'status' => 500];
        try {
            $employeeFind = Employee::find($id);
            $employeeFind->delete();
            $response['success'] = true;
            $response['status'] = 200;

        } catch (Exception $e) {
            Log::error('error al eliminar el empleado: ' . $e->getTrace() . ' ' . $e->getMessage());
        }
        return $response;

    }

    public function disabledEmployee($id, $status)
    {
        $response = ['employee' => null, 'status' => 500];
        try {
            $employeeFind = Employee::find($id);
            $employeeFind->status = (int)$status;
            $employeeFind->save();
            $response['employee'] = $employeeFind;
            $response['status'] = 200;

        } catch (Exception $e) {
            Log::error('error al eliminar el empleado: ' . $e->getTrace() . ' ' . $e->getMessage());
        }
        return $response;

    }

}
