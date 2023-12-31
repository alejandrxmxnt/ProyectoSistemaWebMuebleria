<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!--scrip para el funcionamiento necesario-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <div class="regform">
                <h1>Formulario de ventas</h1>
            </div>
            <main class="main">

                <div class="col-sm-12">
                    <div class="card-box table-responsive"> 
                        <div class="x_panel">
                            <!--BOTON DE RETROCEDER RETORNA A LISTA DE VENTAS-->
                            <div class="x_title">
                                <a href="<?php echo base_url();?>index.php/administration/ventas/index">
                                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Volver"><i class="fa fa-mail-reply-all"></i></button>
                                </a>
                                <br>
                                <div style="text-align: left;">
                                    <!--
                                    <label style="color: white;">Atendido por:</label>
                                    <input type="text" value="Usuario: <?php echo $this->session->userdata('login'); ?>" readonly style="background: transparent; color: white; border-color: transparent;">
                                    <br> -->
                                    <label style="color: white;">Fecha de Venta:</label>
                                    <input type="date" id="fechaVenta" name="fechaVenta" readonly value="<?php echo date('Y-m-d');?>" style="background: transparent; color: white; border-color: transparent;">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--INICIA CONTENIDO DE PROCESO DE VENTA-->
                            <div class="x_content">
                                <br>
                                <?php
                                echo form_open_multipart('administration/ventas/realizarTransaccionVenta', array('id' => 'ventaForm', 'class' => 'needs-validation', 'method' => 'post'));
                                ?>
                                <!--
                                <form action="<?php// echo base_url();?>index.php/admininistration/ventas/realizarTransaccionVenta" id="ventaForm" class="needs-validation" method="post">
-->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Seleccione un cliente:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9"> 
                                            <!--
                                            <input type="text" id="autouser">
                                            <input type="text" id="cliente" value='0' name="cliente"> -->
                                            <!--Lista de clientes por el momento es busqueda manual de lista-->
                                            
                                            <select class="form-control" name="cliente" id="cliente" required="required">
                                                <option value="" disabled selected>Lista de clientes</option>
                                                <?php 
                                                foreach ($clientes->result() as $row){ 
                                                ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->ciNit." - ".$row->nombre." ".$row->primerApellido." ".$row->segundoApellido; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>  
                                            <!--Fin de seleccion de clientes-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Seleccione un producto:</label> 
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="hidden" name="detalle_data" id="detalle_data" value="">
                                            <!--Seleccionar productos en lista-->
                                            <select class="form-control" name="producto" id="producto" required="required">
                                                <option value="" disabled selected>Listado de productos</option>
                                                <?php
                                                foreach ($productos->result() as $row){
                                                ?>
                                                    <option value="<?php echo $row->id; ?>">
                                                        <?php echo $row->nombre; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <!--Fin de busqueda de productos en lista-->
                                        </div>
                                        <!--agregar mediante este boton a la tabla-->
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <button id="btn-agregar" type="button" class="btn btn-success">Agregar</button>
                                            <button type="button" class="btn btn-primary" id="btn-buscar-producto" data-toggle="modal" data-target="#modal-buscar-producto">Buscar</button>
                                        </div>
                                        <!--Fin de boton para agregado a la tabla-->
                                    </div>

                                    <div class="x_title">
                                        <h2>Tabla de ventas <small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="tabla-ventas" style="background-color: white; border-radius: 5px 5px;">
                                        <table class="table table-striped" id="tabla-ventas">
                                            <thead>
                                                <tr>
                                                    <th style="color: black; font-weight: 600;">N°</th>
                                                    <th style="color: black; font-weight: 600;"></th> <!--id de producto-->
                                                    <th style="color: black; font-weight: 600;">Producto</th>
                                                    <th style="color: black; font-weight: 600;">P/U</th><!--Precio Unitario-->
                                                    <th style="color: black; font-weight: 600;">stock</th>
                                                    <th style="color: black; font-weight: 600;">Descuento</th>
                                                    <th style="color: black; font-weight: 600;">Cantidad</th>
                                                    <th style="color: black; font-weight: 600;">SubTotal</th> <!--importe de cada producto-->
                                                    <th style="color: black; font-weight: 600;">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list-product">
                                                <tr id="fila-ejemplo" style="display: none;">
                                                    <td style="color: black; font-weight: 600;"></td> <!-- contador - indice -->
                                                    <td><input type="hidden" class="producto-id" name="producto_id[]"></td> <!--captura del id del producto-->
                                                    <td></td><!--Nombre producto-->
                                                    <td></td><!--Precio Unitario-->
                                                    <td></td><!--Stock disponible-->
                                                    <td><input style="width: 70px;" type="number" required="required" value="0" class="form-control descuento" name="descuento[]" id="descuento"></td> <!--descuento-->
                                                    <td><input style="width: 70px;" type="number" required="required" value="0" class="form-control cantidad" name="cantidad[]" id="cantidad"></td> <!--cantidad para llevar-->
                                                    <td></td><!--Sub total - importe de venta de cada producto -->
                                                    <td><button class="btn btn-danger btn-remove"><span class="glyphicon glyphicon-trash"> <!--BOTON DE ELIMINAR-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                        </svg> 
                                                    </span></button></td> <!-- Accion de eliminar -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2" style="text-align: center;">
                                            <input type="number" name="total" id="total" class="form-control" style="text-align: center;"><strong><samp>TOTAL(Bs.)</samp></strong>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2" style="text-align: center;">
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-info btn-block" id="btn-guardar"><strong>Guardar</strong></button>
                                            <br>
                                        </div>
                                    </div>
                                    <!--
                                </form> 
-->
                                <?php echo form_close(); ?>                              
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>


<!-- Modal para la búsqueda de producto -->
<div class="modal fade" id="modal-buscar-producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style=" background-color: rgb(223, 100, 9);">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black; font-weight: 700;">Lista de productos</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Contenido de búsqueda de producto aquí -->
          <table class="table" id="my-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Agregar</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio U/N</th> 
                <th>Imagen</th>
              </tr>
            </thead>
            <tbody>
    
              <?php
                $indice=1;
                
                foreach($productos->result() as $row){ 
                  //impresion de valores de la data
                  //acontinuacion de como se carga una tabla
              ?>
              
              <tr>
                <th><?php echo $indice; ?></th>
                <td><button id="btn-agregar" type="button" class="btn btn-success" data-dismiss="modal">Agregar</button></td>
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $row->stock; ?></td>
                <td><?php echo $row->precioUnitario; ?></td>
                <td>
                    <?php 
                    $foto=$row->foto;
                    if($foto=="")//si foto esta igual a vacion sin imagen
                    {//cargar una imagen en caso de no tener una imagen que sea vacio
                        ?>
                        <img width="80" src="<?php echo base_url(); ?>uploads/productos/vacio.jpg">
                        <?php
                    }else {//caso contrario se proyectara la imagen
                        ?>
                        <img width="80" src="<?php echo base_url(); ?>uploads/productos/<?php echo $foto; ?>">
                        <?php
                    }
                    ?>
                </td>
              </tr>
    
              <?php
                $indice++;
                } 
              ?>
    
              
            </tbody>
          </table> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {

        var contadorFilas = 1; //para contar la filas en la tabla 
            //Funcion para calcular el importe de cada producto

        // Initialice el autocompletado en el primer elemento de texto
        
        function calcularImporte(fila) {
            var descuento =parseInt(fila.find("td:eq(5) input").val()); //descuento
            var cantidad = parseInt(fila.find("td:eq(6) input").val()); //cantidad
            var precioUnitario = parseFloat(fila.find("td:eq(3)").text()); //precio unitario 
            
            if(cantidad>=1 && descuento==0){
                var importe = cantidad * precioUnitario;
                fila.find("td:eq(7)").text(importe);
                return importe;
            }else{
                if(cantidad>=1 && descuento>0){
                    var des = descuento / 100;
                    var subtotal = des * precioUnitario;
                    var importe = cantidad * (precioUnitario-subtotal);
                    fila.find("td:eq(7)").text(importe);
                    return importe;
                }else{
                    if(cantidad<=0){
                        alert("La cantidad no puede ser menor a 1.");
                    }else{
                        if(descuento<0){
                            alert("El descuento no puede ser menor a 0.");
                        }else{
                            alert("Cantidad y descuento no validos.");
                        }
                    }
                }
                
            }
        }
        //calcular total
        function calcularTotal() {
            var total = 0;
            $(".added-row").each(function() {
                total += calcularImporte($(this));
            });
            //$("#total").val(total);
            $("#total").val(total.toFixed(2));
        }
        //calcular total cada que la cantidad se actualice
        $(document).on("input", ".cantidad", function() {
            var fila = $(this).closest("tr");
            calcularImporte(fila);

            calcularTotal();
        });
        //calcular total cada que el descuento se actualice
        $(document).on("input", ".descuento", function() {
            var fila = $(this).closest("tr");
            calcularImporte(fila);

            calcularTotal();
        });

        //METODO PARA CARGAR LA TABLA 
        $("#btn-agregar").on("click", function() { //accion de agregado
            var producto_id = $("#producto").val(); //guardar el id del producto seleccionado
            var cliente_id = $("#cliente").val(); //guardar el id del producto seleccionado

            if (producto_id && cliente_id) { //control que se hallan llenado los valores de producto y un cliente sea seleccionado

                var fila = $("#fila-ejemplo").clone().removeAttr("id");

                $.getJSON('<?php echo base_url() ?>index.php/administration/ajax/obtenerProductoPorId/' + producto_id, function(data) {
                    
                    if (data) {

                        fila.find("td:eq(0)").text(contadorFilas);
                        fila.find("td:eq(1) input").val(producto_id);
                        fila.find("td:eq(2)").text(data[0].nombre);
                        fila.find("td:eq(3)").text(data[0].precioUnitario);
                        fila.find("td:eq(4)").text(data[0].stock);
                        fila.find("td:eq(5) input").val(0); //descuento
                        fila.find("td:eq(6) input").val(1); //cantidad
                        fila.find("td:eq(7)").text(data[0].precioUnitario); //

                        contadorFilas++;

                        fila.addClass("added-row");

                        fila.show();
                        $(".list-product").append(fila);

                        calcularImporte(fila);
                        calcularTotal();
                    } else {
                        alert("No se encontraron detalles del producto.");
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Error en la solicitud AJAX: " + errorThrown);
                });
            } else {
                //alert("Seleccione un Producto.");
                alert("Seleccione un cliente y el producto a comprar");
            }
        });

        $(document).on("click", ".btn-remove", function() {
            var fila = $(this).closest("tr");
            fila.remove();

            calcularTotal();
        });

        calcularTotal();
    });

    //METODO PARA GUARDAR LA DATA A LA BASE DE DATOS
    $("#btn-guardar").on("click", function() { //el evento click para iniciar el guardado
        var datos = []; // Array para almacenar los datos de todas las filas

        // Recorre cada fila con la clase "added-row"
        $(".list-product .added-row").each(function() { 
            var fila = $(this); //se guarda todas las filas
            var cantidad = parseInt(fila.find("td:eq(6) input").val()); //recupera el valor de la cantidad
            var descuento = parseInt(fila.find("td:eq(5) input").val()); //recupera el valor del descuento
            //var precioUnitario = parseFloat(fila.find("td:eq(4)").text());
            //var importe = cantidad * precioUnitario; // Calcula el importe 
            var importe = parseFloat(fila.find("td:eq(7)").text()); //recupera el valor de importe de cada uno

            var filaData = {
                idProducto: fila.find("td:eq(1) input").val(), //recupera el id de producto
                descuento: descuento,
                cantidad: cantidad,
                importe: importe
            };
            datos.push(filaData); //vamos a cargar con un push nuestros datos el filaData en el array que creamos

            //console.log(datos);
        });

        // Muestra el contenido del array en un alert
        //alert(JSON.stringify(datos, null, 2));

        // Convierte el array a una cadena JSON
        var datosJSON = JSON.stringify(datos);

        // Asigna la cadena JSON al campo de entrada
        $("#detalle_data").val(datosJSON);
    });
</script>
<!--Funcion para buscador autocompletado de cliente-->

<script src="<?php echo base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>