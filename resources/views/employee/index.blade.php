@extends('welcome')
@section('content')
    @include('employee.modal_employee')
    <button class="btn btn-info" onclick="openModalEmployee()">AGREGAR EMPLEADO</button>
    <h3 class="text-center">LISTA DE EMPLEADOS</h3>
    <div class="d-flex justify-content-center text-center">
        <div>
            <small>inicio Contrato:</small>
            <input type="date" class="form-control mr-3 border-info" name="filter_contract_start_date" id="filter_contract_start_date">
        </div>
        <div>
            <small>fin Contrato:</small>
            <input type="date" class="form-control border-info" name="filter_contract_end_date" id="filter_contract_end_date">
        </div>
        <div>
            <small class="text-center">nacimiento:</small>
            <input type="date" class="form-control border-info" name="filter_birth_date" id="filter_birth_date">
        </div>
        <div>
            <small>Cargo:</small>
            <select class="form form-control border-info" name="filter_charge" id="filter_charge">
                <option value="">TODOS</option>
                <option value="programador">PROGRAMADOR</option>
                <option value="contador">CONTADOR</option>
                <option value="administrador">ADMINISTRADOR</option>
                <option value="administrador">SECRETARIA</option>
            </select>
        </div>
        <div>
            <small>área:</small>
            <select class="form form-control border-info" name="filter_area" id="filter_area">
                <option value="">TODOS</option>
                <option value="informatica">INFORMATICA</option>
                <option value="producción">PRODUCCIÓN</option>
                <option value="finanzas">FINANZAS</option>
                <option value="ventas">VENTAS</option>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-2 mb-4">
        <button class="btn btn-info w-25" onclick="search()">BUSCAR</button>
    </div>
    <div class="table table-responsive">
        <table class="table" id="table_employee">
            <thead class="table-info">
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>DNI</th>
                    <th>CORREO</th>
                    <th>FECHA DE NACIMIENTO</th>
                    <th>CARGO</th>
                    <th>AREA</th>
                    <th>INICIO CONTRATO</th>
                    <th>FIN CONTRATO</th>
                    <th>TIPO CONTRATO</th>
                    <th style="width: 250px">OPCIONES</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('app/js/employee.js')}}"></script>
@endsection
