<div class="card mb-10">
  <div class="card-header">
    <h3 class="card-title">Listar Agendamentos</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id . Agendamento</th>
          <th>Cliente</th>
          <th>Imovel</th>
          <th>Proprietario</th>
          <th>Data da Visita</th>
          <th>Status</th>
          <th>Agendar</th>
          <th>Editar</th>
          <th>Desativar</th>
        </tr>
      </thead>
      <tbody>

        <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

        <?php foreach ($agendamentos as $linha): ?>



          <tr class="align-middle">
            <td> <?= $linha['id_agendamento']; ?> </td>
            <td> <?= $linha['nome_cliente']; ?> </td>
            <td> <?= $linha['nome_imovel']; ?> </td>
            <td> <?= $linha['nome_proprietario']; ?> </td>
            <td> <?= $linha['data_visita']; ?> </td>
            <td> <?= $linha['status_agendamento']; ?> </td>
            <!-- <td><span class="badge text-bg-danger">55%</span></td> -->

            <td style="text-align: center;">
              <input
                class="form-check-input toggle-status"
                type="checkbox"
                role="switch"
                data-id="<?= $linha['id_agendamento'] ?>"
                <?= $linha['status_agendamento'] === 'Confirmado' ? 'checked' : '' ?>>
            </td>

            <td><a href="<?= URL_BASE ?>agendamento/editar/<?= $linha['id_agendamento'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>

            <td><a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?= $linha['id_agendamento']; ?>); return false;">
                <i class="bi bi-x-circle"></i></a></td>
          </tr>


        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="desativarAgendamento" tabindex="-1" role="dialog" aria-labelledby="desativarAgendamentoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarAgendamentoLabel">Desativar Agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir esse Agendamento?</p>
        <input type="hidden" id="idAgendamento" value="">
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
      const status = this.checked ? 'Confirmado' : 'Pendente';

      //requisição AJAX com fetch
      fetch('<?= URL_BASE ?>agendamento/atualizarStatus', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/jason'
          },
          body: JSON.stringify({
            id_agendamento: id,
            status_agendamento: status
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
  function abrirModalDesativar(idAgendamento) {


    if ($('#desativarAgendamento').hasClass('show')) {
      return;
    }

    // ao clicar no botão SIM - pega iD
    document.getElementById('idAgendamento').value = idAgendamento
    $('#desativarAgendamento').modal('show');

    document.getElementById('simDesativar').addEventListener('click', function() {
      const idAgendamento = document.getElementById('idAgendamento').value

      if (idAgendamento) {
        desativarAgendamento(idAgendamento)
      }

    })

    //função em AJAX para realizar uma solicitação ao ControllerCurso, chamando o método desativar


    // `` usando isso, conseguimos utilizar tanto variavel quanto escrita no mesmo ligar
    function desativarAgendamento(idAgendamento) {
      fetch(`<?= URL_BASE ?>agendamento/desativar/${idAgendamento}`, {
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
            console.log("Exclusão de Agendamento Feita com Sucesso!")
            $('#desativarAgendamento').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 500) //Delay de carregamento

          } else {
            console.log("Ocorreu um erro ao excluir o Agendamento!")
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

<?php if (!empty($_SESSION['mensagem'])): ?>
    <div id="mensagem-flash" style="position:fixed;top:20px;right:20px;z-index:9999;
        background:<?= $_SESSION['mensagem']['tipo'] == 'sucesso' ? '#4caf50' : '#f44336' ?>;
        color:#fff;padding:15px 30px;border-radius:5px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">
        <?= $_SESSION['mensagem']['texto'] ?>
    </div>
    <script>
        setTimeout(function() {
            var msg = document.getElementById('mensagem-flash');
            if(msg) msg.style.display = 'none';
        }, 3000);
    </script>
    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>