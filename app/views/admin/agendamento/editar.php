<div class="card card-info card-outline mb-4">

    <div class="card-header">
        <div class="card-title">Editar Agendamento</div>
    </div>

    <form class="needs-validation" method="POST" action="<?= URL_BASE ?>agendamento/editar/<?= $carregarDadosAgendamento['id_agendamento'] ?>" enctype="multipart/form-data" novalidate>
        <div class="card-body">
            <div class="row g-3">

                <!-- Cliente (readonly) -->
                <div class="col-md-6">
                    <label for="nome_cliente" class="form-label">Cliente:</label>
                    <input type="text" id="nome_cliente" class="form-control"
                        value="<?= htmlspecialchars($carregarDadosAgendamento['nome_cliente']) ?>" readonly>
                    <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($carregarDadosAgendamento['id_cliente']) ?>">
                </div>

                <!-- Imóvel (nome) -->
                <div class="col-md-6">
                    <label for="nome_imovel" class="form-label">Nome do Imóvel:</label>
                    <input type="text" name="nome_imovel" id="nome_imovel" class="form-control"
                        value="<?= htmlspecialchars($carregarDadosAgendamento['nome_imovel']) ?>" required>
                    <input type="hidden" name="id_imovel" value="<?= htmlspecialchars($carregarDadosAgendamento['id_imovel']) ?>">
                </div>

                <!-- Proprietário (nome) -->
                <div class="col-md-6">
                    <label for="nome_proprietario" class="form-label">Nome do Proprietário:</label>
                    <input type="text" name="nome_proprietario" id="nome_proprietario" class="form-control"
                        value="<?= htmlspecialchars($carregarDadosAgendamento['nome_proprietario']) ?>" required>
                    <input type="hidden" name="id_proprietario" value="<?= htmlspecialchars($carregarDadosAgendamento['id_proprietario']) ?>">
                </div>

                <!-- Data da Visita -->
                <div class="col-md-6">
                    <label for="data_visita" class="form-label">Data e Hora da Visita:</label>
                    <input type="datetime-local" name="data_visita" id="data_visita" class="form-control"
                        value="<?= date('Y-m-d\TH:i', strtotime($carregarDadosAgendamento['data_visita'])) ?>" required>
                </div>

            </div>
        </div>

        <div class="card-footer" style="display:flex; justify-content:flex-end;">
            <button type="submit" class="btn btn-info" style="width: 100px;">Salvar</button>
        </div>
    </form>


    <!--end::Form-->
</div>

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