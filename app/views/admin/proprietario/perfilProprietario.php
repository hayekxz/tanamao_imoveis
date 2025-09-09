<div class="container mt-4">
    <h2>Meu Perfil</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <td><?= $proprietario['nome_proprietario'] ?? 'Não disponível' ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $proprietario['email_proprietario'] ?? 'Não disponível' ?></td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td><?= $proprietario['telefone_proprietario'] ?? 'Não disponível' ?></td>
        </tr>
    </table>
</div>
