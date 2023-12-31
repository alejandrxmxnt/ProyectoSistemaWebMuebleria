<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">MODIFICAR CLIENTE</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-0 col-xlg-3 col-md-12">

        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-12 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">

<?php
    foreach ($infocliente->result() as $row) {
    echo form_open_multipart('administration/cliente/modificarbd');
?>
<input type="hidden" class="form-control p-0 border-0" name="idcliente" value="<?php echo $row->id; ?>"> 

<div class="form-group mb-4">
    <label class="col-md-12 p-0">Nombre Completo</label>
    <div class="col-md-4 border-bottom p-0">
        <input type="text" placeholder="Nombres"
            class="form-control p-0 border-0" name="nombre" value="<?php echo $row->nombre; ?>"> 
    </div>
    <div class="col-md-4 border-bottom p-0">
        <input type="text" placeholder="Primer Apellido"
            class="form-control p-0 border-0" name="apellido1" value="<?php echo $row->primerApellido; ?>"> 
    </div>
    <div class="col-md-4 border-bottom p-0">
        <input type="text" placeholder="segundo Apellido"
            class="form-control p-0 border-0" name="apellido2" value="<?php echo $row->segundoApellido; ?>"> 
    </div>
</div>
<div class="form-group mb-4">
    <label class="col-md-12 p-0">Cedula de Identidad / NIT</label>
    <div class="col-md-12 border-bottom p-0">
        <input type="text" placeholder="Ingrese CI/NIT" name="cinit"
            class="form-control p-0 border-0" value="<?php echo $row->ciNit; ?>"> </div>
</div>
<div class="form-group mb-4">
    <label class="col-md-12 p-0">Telefono/Celular</label>
    <div class="col-md-12 border-bottom p-0">
        <input type="text" placeholder="Ingrese el numero Celular/Telefono" name="celular"
            class="form-control p-0 border-0" value="<?php echo $row->telefono; ?>"> </div>
</div>
<div class="form-group mb-4">
    <label class="col-md-12 p-0">Dirección</label>
    <div class="col-md-12 border-bottom p-0">
        <input type="text" placeholder="Ingrese la Dirección." name="direccion" value="<?php echo $row->direccion; ?>"
            class="form-control p-0 border-0"> </div>
</div>
<div class="form-group mb-4">
    <label class="col-md-12 p-0">Razon Social</label>
    <div class="col-md-12 border-bottom p-0">
        <input type="text" placeholder="Ingrese la Razon Social" name="razonSocial" value="<?php echo $row->razonSocial; ?>"
            class="form-control p-0 border-0"> </div>
</div>
<div class="form-group mb-4">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-success">Modificar</button>
    </div>
</div>
<?php
    echo form_close();
    }
?>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>