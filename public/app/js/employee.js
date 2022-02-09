let validations = [
    {'input': "name"},
    {'input': "last_name"},
    {'input': "dni"},
    {'input': "email"},
    {'input': "birth_date"},
    {'input': "charge"},
    {'input': "area"},
    {'input': "contract_start_date"},
    {'input': "type_contract"},
    {'input': "contract_end_date"},
];
let listEmployee = [];
let tableEmployee;
$(document).ready(function () {
    tableEmployee = $('#table_employee').DataTable({
        dom: 'rtip',
        paging: true,
        processing: true,
        serverSide: true,
        ajax: function (data, callback, settings) {
            $.get('employee', {
                contract_start_date: $('#filter_contract_start_date').val(),
                contract_end_date: $('#filter_contract_end_date').val(),
                birth_date: $('#filter_birth_date').val(),
                charge: $('#filter_charge').val(),
                area: $('#filter_area').val(),
            }, function (res) {
                listEmployee = []
                res.data.forEach(element => {
                    listEmployee[element.id] = element;
                });
                callback({
                    recordsTotal: res.total,
                    recordsFiltered: res.total,
                    data: res.data
                });
            })
        },
        dataSrc: '',
        columns: [
            {data: 'name'},
            {data: 'last_name'},
            {data: 'dni'},
            {data: 'email'},
            {data: 'birth_date'},
            {data: 'charge'},
            {data: 'area'},
            {data: 'contract_start_date'},
            {data: 'contract_end_date'},
            {data: 'type_contract'},
            {data: function (data) {
                let option = '<div style="width: 250px"><button style="margin-right: 2px" class="btn btn-dark btn-sm mr-2" onclick="openModalEmployeeEdit(' + data.id +')">EDITAR</button><button style="margin-right: 2px" class="btn btn-danger btn-sm mr-2" onclick="deleteEmployee(' + data.id +')">ELIMINAR</button><button style="margin-right: 2px" class="btn btn-danger btn-sm mr-2" onclick="disabledEmployee(' + data.id + ',' + 0 + ')">DESACTIVAR</button></div>'
                if (data.status == 0){
                    option = '<div style="width: 250px"><button style="margin-right: 2px" class="btn btn-dark btn-sm mr-2" onclick="openModalEmployeeEdit(' + data.id +')">EDITAR</button><button style="margin-right: 2px" class="btn btn-danger btn-sm mr-2" onclick="deleteEmployee(' + data.id +')">ELIMINAR</button><button style="margin-right: 2px" class="btn btn-danger btn-sm mr-2" onclick="disabledEmployee(' + data.id + ',' + 1 + ')">ACTIVAR</button></div>'
                }
                   return option;
            }},
        ],
        rowCallback: function( row, data, index ) {
            $(row).css('background-color', 'transparent');
            if (data.status == 0) {
                $(row).css('background-color', '#F4DEDC');
            }
        }
    });
});

function search() {
    tableEmployee.ajax.reload();
}

function resetValidateFormEmployee() {
    validations.forEach(function (field) {
        document.getElementById(field.input).style.borderColor = 'blue';
        document.getElementById(field.input + '_error').style.display = 'none';
    })
}

function openModalEmployee() {
    resetValidateFormEmployee();
    document.getElementById('form-employee').reset();
    let btnCreateEmployee = document.getElementById('btn_create_employee');
    document.getElementById('dni').readOnly = false;
    btnCreateEmployee.disabled = false;
    btnCreateEmployee.onclick = function () {
        saveEmployee();
    };
    let btnCreateEmployeeMessage = document.getElementById('btn_create_employee_message');
    btnCreateEmployee.innerText = 'GUARDAR';
    btnCreateEmployee.style.background = '#03a9f3';
    btnCreateEmployeeMessage.style.display = 'none';
    document.getElementById('modal-employee-title').innerText = 'NUEVO EMPLEADO'
    $('#modal-employee').modal('show')
}

function saveEmployee() {
    let btnCreateEmployee = document.getElementById('btn_create_employee');
    btnCreateEmployee.disabled = true;
    let dataSend = {};
    dataSend.name = document.getElementById('name').value;
    dataSend.last_name = document.getElementById('last_name').value;
    dataSend.dni = document.getElementById('dni').value;
    dataSend.email = document.getElementById('email').value;
    dataSend.birth_date = document.getElementById('birth_date').value;

    dataSend.charge = document.getElementById('charge').value;
    dataSend.area = document.getElementById('area').value;

    dataSend.contract_start_date = document.getElementById('contract_start_date').value;
    dataSend.type_contract = document.getElementById('type_contract').value;
    dataSend.contract_end_date = document.getElementById('contract_end_date').value;
    btnCreateEmployee.disabled = true;
    $.ajax({
        method: 'POST',
        data: dataSend,
        url: 'employee',
        statusCode: {
            422: function (response) {
                let errors = response.responseJSON.errors;
                resetValidateFormEmployee();
                validations.forEach(function (field) {
                    let value = field.input;
                    if (errors[value]) {
                        document.getElementById(field.input + '_error').style.display = 'block';
                        document.getElementById(value).style.borderColor = 'red';
                        document.getElementById(value + '_error').innerText = errors[value];
                        document.getElementById(value + '_error').style.color = 'red';
                        console.log(errors[value]);
                    }
                })
                let btnCreateEmployee = document.getElementById('btn_create_employee');
                btnCreateEmployee.disabled = false;
            },
            200: function (response) {
                resetValidateFormEmployee();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'El empleado  fue registrado correctamente',
                    icon: 'success',
                    customClass: 'swal-height'
                }).then((result) => {
                    $('#modal-employee').modal('hide')
                    if (result.isConfirmed) {
                        search();
                    }
                })
            },
            500: function () {
                resetValidateFormEmployee();
                Swal.fire({
                    title: 'Error!',
                    text: 'Se tubo problemas al registrar al empleado. Consulte con soporte..!',
                    icon: 'error',
                    customClass: 'swal-height'
                })
                let btnCreateEmployee = document.getElementById('btn_create_employee');
                btnCreateEmployee.disabled = false;
            }
        }
    });
}
function openModalEmployeeEdit(id){
    let employee = listEmployee[id];
    resetValidateFormEmployee();
    document.getElementById('form-employee').reset();
    let btnCreateEmployee = document.getElementById('btn_create_employee');
    btnCreateEmployee.disabled = false;
    btnCreateEmployee.onclick = function () {
        updateEmployee(id);
    };
    //add values
    document.getElementById('name').value = employee.name;
    document.getElementById('last_name').value = employee.last_name;
    document.getElementById('dni').value = employee.dni;
    document.getElementById('dni').readOnly = true;
    document.getElementById('email').value = employee.email;
    document.getElementById('birth_date').value = employee.birth_date;

    document.getElementById('charge').value = employee.charge;
    document.getElementById('area').value = employee.area;

    document.getElementById('contract_start_date').value = employee.contract_start_date;
    document.getElementById('type_contract').value = employee.type_contract;
    document.getElementById('contract_end_date').value = employee.contract_end_date;

    let btnCreateEmployeeMessage = document.getElementById('btn_create_employee_message');
    btnCreateEmployee.innerText = 'GUARDAR';
    btnCreateEmployee.style.background = '#03a9f3';
    btnCreateEmployeeMessage.style.display = 'none';
    document.getElementById('modal-employee-title').innerText = 'NUEVO EMPLEADO'
    $('#modal-employee').modal('show')
}
function updateEmployee(id)
{
    let btnCreateEmployee = document.getElementById('btn_create_employee');
    btnCreateEmployee.disabled = true;
    let dataSend = {};
    dataSend.name = document.getElementById('name').value;
    dataSend.last_name = document.getElementById('last_name').value;
    dataSend.dni = document.getElementById('dni').value;
    dataSend.email = document.getElementById('email').value;
    dataSend.birth_date = document.getElementById('birth_date').value;

    dataSend.charge = document.getElementById('charge').value;
    dataSend.area = document.getElementById('area').value;

    dataSend.contract_start_date = document.getElementById('contract_start_date').value;
    dataSend.type_contract = document.getElementById('type_contract').value;
    dataSend.contract_end_date = document.getElementById('contract_end_date').value;
    btnCreateEmployee.disabled = true;
    $.ajax({
        method: 'PUT',
        data: dataSend,
        url: 'employee/' + id,
        statusCode: {
            422: function (response) {
                let errors = response.responseJSON.errors;
                resetValidateFormEmployee();
                validations.forEach(function (field) {
                    let value = field.input;
                    if (errors[value]) {
                        document.getElementById(field.input + '_error').style.display = 'block';
                        document.getElementById(value).style.borderColor = 'red';
                        document.getElementById(value + '_error').innerText = errors[value];
                        document.getElementById(value + '_error').style.color = 'red';
                        console.log(errors[value]);
                    }
                })
                let btnCreateEmployee = document.getElementById('btn_create_employee');
                btnCreateEmployee.disabled = false;
            },
            200: function (response) {
                resetValidateFormEmployee();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'El empleado  fue registrado correctamente',
                    icon: 'success',
                    customClass: 'swal-height'
                }).then((result) => {
                    $('#modal-employee').modal('hide')
                    if (result.isConfirmed) {
                        search();
                    }
                })
            },
            500: function () {
                resetValidateFormEmployee();
                Swal.fire({
                    title: 'Error!',
                    text: 'Se tubo problemas al registrar al empleado. Consulte con soporte..!',
                    icon: 'error',
                    customClass: 'swal-height'
                })
                let btnCreateEmployee = document.getElementById('btn_create_employee');
                btnCreateEmployee.disabled = false;
            }
        }
    });
}

function deleteEmployee(id)
{
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'si, borralo!',
        cancelButtonText: 'No, cancelar!',
        customClass: 'swal-height'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'DELETE',
                url: 'employee/' + id,
                statusCode: {
                    200: function (response) {
                        Swal.fire({
                            title: 'Borrado!',
                            text: 'el empleado fue eliminado..',
                            icon: 'success',
                            customClass: 'swal-height'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                search();
                            }
                        })
                    },
                    500: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error, Hubo un problema',
                            icon: 'error',
                            customClass: 'swal-height'
                        })
                    }
                }
            })
        }
    })
}
function disabledEmployee(id, status)
{
    Swal.fire({
        title: '¿Está seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'si, Cambiar!',
        cancelButtonText: 'No, cancelar!',
        customClass: 'swal-height'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'GET',
                url: 'employee/' + id + '/' + status,
                statusCode: {
                    200: function (response) {
                        Swal.fire({
                            title: 'ESTADO CAMBIADO!',
                            text: 'el empleado fue cambiado de estado ..',
                            icon: 'success',
                            customClass: 'swal-height'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                search();
                            }
                        })
                    },
                    500: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error, Hubo un problema',
                            icon: 'error',
                            customClass: 'swal-height'
                        })
                    }
                }
            })
        }
    })

}
