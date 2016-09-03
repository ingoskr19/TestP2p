<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" href="bootstrap-3.1.1/css/Personalizado.css">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js"></script>

  <title>P2P - LISTA TRANSACCIONES</title>
</head>
<body>
  <header class="page-header text-center">
    <div id="titulo">
    <h1>TRANSACCIONES</h1>
    </div>
  </header>
  <main>

  <!-- Modal -->
    <div class="bd-example">
      <div class="modal fade" id="popupNewTransaccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="exampleModalLabel">Realizar Transaccion Demo</h4>
            </div>
            <div class="modal-body">
              <form id="form_buying" method="POST" target="_blank">
                <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="recipient-name" class="form-control-label">Referencia de pago:</label>
                  <input type="text" class="form-control" name="reference" id="reference" required>
                </div>
                <div class="form-group">
                  <label for="message-text" class="form-control-label">Valor Compra: &#36;</label>
                  <input class="form-control" type="number" name="mount" id="mount" step="0.001" required>
                </div>
                <div class="form-group">
                  <label for="buyer" class="form-control-label">Digite su E-mail:</label>
                  <input id="buyer" class="form-control" value="@hotmail.com" type="text" name="buyer" style="" required>
                </div>
                <div class="form-group">
                  <label for="banco" class="form-control-label">Banco:</label>
                  <select id="banco" data-style="btn-primary" title="Seleccione un banco..." name="banco" data-size="8" class="form-control" required>
                  </select>
                  <img id="loading" src="/load.gif" alt="Cargando..." height="32" width="32" style="display: block;">
                  <label id="errorGetBankList" style="display: none;">No se pudo obtener el listado de bancos, por favor intente mas tarde.</label>
                </div>
                <div class="form-group">
                  <label class="radio-inline">
                    <input type="radio" checked="checked" value="0" name="tipo">Persona Natural
                  </label>
                  <label class="radio-inline">
                    <input type="radio" value="1" name="tipo">Persona Juridica
                  </label>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="cancelPay" data-dismiss="modal">Cancelar</button>
              <button id="pagar" type="button" class="btn btn-success">Pagar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="center-block">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupNewTransaccion" data-newTransaccion="newTransaccion">Nueva Transaccion Demo</button>
        </div>
      </div>
    </div>
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Estado Transacciones</h3>
      </div>
      <div class="panel-body">
        <div class="center-block">
            <table class="table table-hover">
            <thead>
                <th>Id Transaccion</th>
                <th>Estado</th>
                <th>Fecha transaccion</th>
                <th>Response Code</th>
                <th>Response Text</th>
            </thead>
            <tbody>
          @forelse($transacciones as $transaccion)
              <tr>
                <td>{{ $transaccion->transaccion_id }}</td>
                <td>{{ $transaccion->status }}</td>
                <td>{{ $transaccion->created_at }}</td>
                <td>{{ $transaccion->responseCode }}</td>
                <td>{{ $transaccion->responseReasonText }}</td>
              </tr>
          @empty
            <tr><td colspan="5">No hay transacciones realizadas</d></tr>
          @endforelse
            </tbody>
            </table>
        </div>
      </div>
    </div>

  </main>
  <footer class="panel panel-default">
    <div class="panel-body">
      <h6 class="panel-title text-center">Todos Los derechos Reservados</h6>
    </div>
  </footer>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
</body>
</html>