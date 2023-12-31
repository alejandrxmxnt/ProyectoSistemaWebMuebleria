<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
      <br>
      <a href="<?php echo base_url(); ?>index.php/administration/categoria/agregar">
        <button type="button" class="btn btn-primary" style="color">
          Nueva Categoria
        </button>
      </a>
      <a href="<?php echo base_url(); ?>index.php/administration/categoria/deshabilitados">
        <button type="button" class="btn btn-warning">
          Categoria Deshalibitadas
        </button>
      </a>
      <br> <br>
      <h2 class="titulos_centro" > CATEGORIAS </h2>
      <table class="table" id="my-table"> <!-- FONDO A LA TABLA -->
        <thead >
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Creado</th>
            <th>Actualizar</th>
            <th>Deshabilitar</th>
          </tr>
        </thead>
        <tbody>

          <?php
            $indice=1;
            foreach($categorias->result() as $row)
            {//impresion de valores de la data
              //acontinuacion de como se carga una tabla
          ?>
          
          <tr>
            <th><?php echo $indice; ?></th>
            <td><?php echo $row->nombre; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->fechaRegistro; ?></td>
            <td>
              <?php
                echo form_open_multipart('administration/categoria/modificar');
            ?>

              <input type="hidden" value="<?php echo $row->id; ?>" name="idcategoria">
              <button type="submit" class="btn btn-success">Modificar</button>

            <?php
                echo form_close();
            ?>
            </td>

            <td>
              
              <?php
                echo form_open_multipart('administration/categoria/deshabilitarbd');
            ?>

              <input type="hidden" value="<?php echo $row->id; ?>" name="idcategoria">
              <button type="submit" class="btn btn-warning">Deshabilitar</button>

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
<!--
<script src="<?php echo base_url();?>bootstrap/js/tablas/pagina.js"></script>
-->
<script>
  const table = document.getElementById('my-table');
  const rows = table.getElementsByTagName('tr');
  const rowsPerPage = 5;//cantidad de filas a visualizar
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  let currentPage = 1;

  function showPage(page) {
      for (let i = 0; i < rows.length; i++) {
          if (i < (page * rowsPerPage) && i >= ((page - 1) * rowsPerPage)) {
              rows[i].style.display = '';
          } else {
              rows[i].style.display = 'none';
          }
      }
  }

  function generatePagination() {
      const paginationContainer = document.getElementById('pagination-container');
      let paginationHTML = '';

      for (let i = 1; i <= totalPages; i++) {
          paginationHTML += `<a href="#" onclick="changePage(${i})" ${i === currentPage ? 'class="active"' : ''}>${i}</a>`;
      }

      paginationContainer.innerHTML = paginationHTML;
  }

  function changePage(page) {
      currentPage = page;
      showPage(page);
      generatePagination();
  }

  showPage(currentPage);
  generatePagination();
</script>