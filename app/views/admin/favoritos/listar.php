<div class="card mb-10">
  <div class="card-header">
    <h3 class="card-title">Listar Clientes</h3>

    <div class="ajusteNOVO">

      <a href="<?= URL_BASE ?>cliente/adicionar" class="btn btn-primary ">

        <i class="bi bi-clipboard2-plus-fill"></i>
        Novo Imovel

      </a>

    </div>

  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Senha</th>
          <th>Cep</th>
          <th>Editar</th>
          <th>Desativar</th>
        </tr>
      </thead>
      <tbody>

        <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

        <?php foreach ($clientes as $linha): ?>



          <tr class="align-middle">
            <td><img style="width: 100px" src="<?= URL_BASE ?>assets/img/<?= $linha['foto_cliente'] ?>" alt=""></td>
            <td> <?= $linha['nome_cliente']; ?> </td>
            <td> <?= $linha['email_cliente']; ?> </td>
            <td> <?= $linha['senha_cliente']; ?> </td>
            <td> <?= $linha['cep_cliente']; ?> </td>
            <!-- <td><span class="badge text-bg-danger">55%</span></td> -->

            <td><a href="<?= URL_BASE ?>cliente/editar/<?= $linha['id_cliente'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>

            <td><a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?= $linha['id_cliente']; ?>); return false;">
                <i class="bi bi-x-circle"></i></a></td>
          </tr>


        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="desativarCliente" tabindex="-1" role="dialog" aria-labelledby="desativarClienteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarClienteLabel">Desativar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja desativar esse usuario?</p>
        <input type="hidden" id="idCliente" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="simDesativar">Sim</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.toggle-status').forEach(input => {
    input.addEventListener('change', function() {

      const id = this.dataset.id;
      const status = this.checked ? 'Ativo' : 'Pendente';

      //requisição AJAX com fetch
      fetch('<?= URL_BASE ?>cliente/atualizarStatus', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/jason'
          },
          body: JSON.stringify({
            id_cliente: id,
            status_cliente: status
          })

        })

        .then(response => response.json()) // Corrigido "=" para "=>"
        .then(data => {
          if (!data.sucesso) {
            alert('Erro ao atualizar status');
            this.checked = !this.checked;
          }
        })
        .catch(() => { // Corrigido "cath" para "catch"
          alert('Erro de comunicação'); // Corrigido "comunicaçao" para "comunicação" (opcional, se quiser corrigir o português)
          this.checked = !this.checked;
        });

    })
  })

  // script para abrir o modal e desativar o curso
  function abrirModalDesativar(idCliente) {


    if ($('#desativarCliente').hasClass('show')) {
      return;
    }

    // ao clicar no botão SIM - pega iD
    document.getElementById('idCliente').value = idCliente
    $('#desativarCliente').modal('show');

    document.getElementById('simDesativar').addEventListener('click', function() {
      const idCliente = document.getElementById('idCliente').value

      if (idCliente) {
        desativarCliente(idCliente)
      }

    })

    //função em AJAX para realizar uma solicitação ao ControllerCurso, chamando o método desativar


    // `` usando isso, conseguimos utilizar tanto variavel quanto escrita no mesmo ligar
    function desativarCliente(idCliente) {
      fetch(`<?= URL_BASE ?>cliente/desativar/${idCliente}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'

          }
        })

        .then(response => {
          //se o código de resposta não for OK - exibir ERRO

          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`)

          }
          return response.json()
        })

        .then(data => {
          // se a resposta for OK, Fechar 0 modal e atualiza a página
          if (data.sucesso) {
            console.log("Usuario desativado com sucesso!")
            $('#desativarCliente').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 500) //Delay de carregamento

          } else {
            console.log("Ocorreu um erro ao desativar o usuario!")
            alert(data.mensagem)
          }

        })

        .catch(error => {
          console.error('Erro: ', error)
          alert(data.mensagem)
        })

    }

  }
</script>