<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
      <br>
      <a href="<?php echo base_url(); ?>index.php/administration/cliente/index">
        <button type="button" class="btn btn-success">
          Lista De Halibitados
        </button>
      </a>
      <br> <br>
      <h2 class="titulos_centro"> TABLA DE CLIENTES DESHABILITADOS </h2>
      <table class="table" id="my-table">
        <thead>
          <tr>
            <th>#</th>
            <th>NOMBRES</th>
            <th>1° APELLIDO</th>
            <th>2° APELLIDO</th>
            <th>CI / NIT</th>
            <th>TELEFONO</th>
            <th>REFERENCIAS</th>
            <th>RAZON SOCIAL</th>
            <th>HABILITAR</th>

          </tr>
        </thead>
        <tbody>

          <?php
            $indice=1;
            foreach($clientes->result() as $row)
            {//impresion de valores de la data
              //acontinuacion de como se carga una tabla
          ?>
          
          <tr>
            <th><?php echo $indice; ?></th>
            <td><?php echo $row->nombre; ?></td>
            <td><?php echo $row->primerApellido; ?></td>
            <td><?php echo $row->segundoApellido; ?></td>
            <td><?php echo $row->ciNit; ?></td>
            <td><?php echo $row->telefono; ?></td>
            <td><?php echo $row->direccion; ?></td>
            <td><?php echo $row->razonSocial; ?></td>
            <td>
              
              <?php
                echo form_open_multipart('administration/cliente/habilitarbd');
            ?>

              <input type="hidden" value="<?php echo $row->id; ?>" name="idcliente">
              <button type="submit" class="btn btn-warning">Habilitar</button>

            <?php
                echo form_close();
            ?>

            </td>
         </tr>

          <?php
            $indice++;
            }
          ?>

          
        </tbody>
      </table>

      <!--PARA ALMACENAR LOS VALORES DE PAGINAS SIGUIENTES-->
      <div class="pagination" id="pagination-container">
      </div> <br> <br>

    </div>
  </div>
</div>

<!--STYLE PARA EL CAMBIO DE PAGINA-->
<style>

  .pagination {
      display: inline-block;
  }
  .pagination a {
      text-decoration: none;
      font-weight: bold;
      padding: 8px 16px;
      background-color: #f2f2f2;
      color: black;
      border: 1px solid #ddd;
      border-radius: 20%;
  }
  .pagination a.active {
      background-color: gray;
      color: white;
  }
</style>

<!--JS-->

<script src="<?php echo base_url();?>bootstrap/js/tablas/pagina.js"></script>