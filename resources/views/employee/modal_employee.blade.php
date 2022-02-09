<div class="modal fade" id="modal-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pb-1 pt-1">
                <h5 class="modal-title text-light" style="font-size: 25px" id="modal-employee-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-employee">
                    <div class="row">
                        <p>DATOS PERSONALES:</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" class="form-control " name="name" id="name" placeholder="ingrese el nombre">
                                <small id="name_error"></small>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control " name="last_name" id="last_name" placeholder="ingrese el apellido">
                                <small id="last_name_error"></small>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control " name="dni" id="dni" placeholder="ingrese el número de dni">
                                <small id="dni_error"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="ingrese el correo">
                                <small id="email_error"></small>
                            </div>
                            <div class="mb-3">
                                <label>Fecha de nacimiento:</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="ingrese la fecha nacimiento">
                                <small id="birth_date_error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p>DATOS EMPRESARIALES:</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Cargo:</label>
                                <select class="form form-control" name="charge" id="charge">
                                    <option value="">SELECCIONAR</option>
                                    <option value="programador">PROGRAMADOR</option>
                                    <option value="contador">CONTADOR</option>
                                    <option value="administrador">ADMINISTRADOR</option>
                                    <option value="administrador">SECRETARIA</option>
                                </select>
                                <small id="charge_error"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Área:</label>
                                <select class="form form-control" name="area" id="area">
                                    <option value="">SELECCIONAR</option>
                                    <option value="informatica">INFORMATICA</option>
                                    <option value="producción">PRODUCCIÓN</option>
                                    <option value="finanzas">FINANZAS</option>
                                    <option value="ventas">VENTAS</option>
                                </select>
                                <small id="area_error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p>CONTRATO:</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Fecha Inicio:</label>
                                <input type="date" class="form-control" name="contract_start_date" id="contract_start_date">
                                <small id="contract_start_date_error"></small>
                            </div>
                            <div class="mb-3">
                                <label>TIPO:</label>
                                <select class="form form-control" id="type_contract" name="type_contract">
                                    <option value="">SELECCIONAR</option>
                                    <option value="temporal">TEMPORAL</option>
                                    <option value="ocasional">OCASIONAL</option>
                                    <option value="practicas">PRÁCTICAS</option>
                                </select>
                                <small id="type_contract_error"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Fecha fin:</label>
                                <input type="date" class="form-control" name="contract_end_date" id="contract_end_date">
                                <small id="contract_end_date_error"></small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_create_employee_message"></button>
                <button type="button" class="btn btn-success" id="btn_create_employee"></button>
            </div>
        </div>
    </div>
</div>
