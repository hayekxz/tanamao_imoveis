<?php require_once('template/head.php'); ?>

<?php require_once('template/header.php'); ?>

<body class="pgcomprar">

    <section class="secfiltro">
        <div class="site-filtro">
            <div class="infofiltro">
                <form id="filtroForm" method="GET" action="<?= URL_BASE ?>imovel">
                    <div class="filtro-barra">

                        <!-- Localização (fictício por enquanto) -->
                        <div class="icone-local">
                            📍 <span>Qualquer lugar em São Paulo, SP</span>
                        </div>

                        <!-- Dropdown COMPRAR -->
                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuTipo')">Comprar</div>
                            <div class="dropdown-menu" id="menuTipo">
                                <a href="<?= URL_BASE ?>Imovel" class="botao">Todos</a>
                                <a href="<?= URL_BASE ?>Imovel?tipo=aluguel" class="botao">Alugar</a>
                                <a href="<?= URL_BASE ?>Imovel?tipo=venda" class="botao">Comprar</a>
                            </div>
                        </div>

                        <!-- Simulações dos demais botões com dropdowns -->
                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuValor')">Valor do imóvel</div>
                            <div class="dropdown-menu" id="menuValor">
                                <button name="valor" value="0-10000000">Até R$ 1.000</button>
                                <button name="valor" value="1000-5000">R$ 1.000 - R$ 5.000</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuCondominio')">Condomínio + IPTU</div>
                            <div class="dropdown-menu" id="menuCondominio">
                                <button name="condominio" value="sim">Simular</button>
                                <button name="condominio" value="nao">Ignorar</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuTipoImovel')">Tipos de imóvel</div>
                            <div class="dropdown-menu" id="menuTipoImovel">
                                <button name="tipo_imovel" value="apartamento">Apartamento</button>
                                <button name="tipo_imovel" value="casa">Casa</button>
                                <button name="tipo_imovel" value="kitnet">Kitnet</button>

                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuQuartos')">1+ quartos</div>
                            <div class="dropdown-menu" id="menuQuartos">
                                <button name="quartos" value="1">1+ quarto</button>
                                <button name="quartos" value="2">2+ quartos</button>
                                <button name="quartos" value="3">3+ quartos</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuVagas')">Vagas de garagem</div>
                            <div class="dropdown-menu" id="menuVagas">
                                <button name="vagas" value="1">1 vaga</button>
                                <button name="vagas" value="2">2 vagas</button>
                                <button name="vagas" value="3">3+ vagas</button>
                            </div>
                        </div>


                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuComodidade')">Comodidade</div>
                            <div class="dropdown-menu" id="menuComodidade">
                                <button type="submit" name="piscina_imovel" value="1">Piscina</button>
                                <button type="submit" name="academia_imovel" value="1">Academia</button>
                                <button type="submit" name="salao_festas_imovel" value="1">Salão de Festas</button>
                                <button type="submit" name="churrasqueira_imovel" value="1">Churrasqueira</button>
                                <button type="submit" name="quadra_esportes_imovel" value="1">Quadra de Esportes</button>
                                <button type="submit" name="espaco_gourmet_imovel" value="1">Espaço Gourmet</button>
                                <button type="submit" name="brinquedoteca_imovel" value="1">Brinquedoteca</button>
                                <button type="submit" name="playground_imovel" value="1">Playground</button>
                                <button type="submit" name="portaria_24h_imovel" value="1">Portaria 24h</button>
                                <button type="submit" name="seguranca_imovel" value="1">Segurança</button>
                                <button type="submit" name="bicicletario_imovel" value="1">Bicicletário</button>
                                <button type="submit" name="elevador_imovel" value="1">Elevador</button>
                                <button type="submit" name="vaga_visitante_imovel" value="1">Vaga para Visitante</button>
                                <button type="submit" name="gerador_energia_imovel" value="1">Gerador de Energia</button>
                            </div>
                        </div>


                        <!-- Botões de ações -->
                        <button type="button" class="filtro-botao">Mais filtros</button>
                        <button type="button" class="filtro-botao">🔔 Criar alerta de imóvel</button>

                    </div>
                </form>

                <script>
                    function toggleDropdown(id) {
                        const dropdowns = document.querySelectorAll('.dropdown-menu');
                        dropdowns.forEach(menu => {
                            if (menu.id === id) {
                                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
                            } else {
                                menu.style.display = 'none';
                            }
                        });
                    }

                    // Fecha dropdowns ao clicar fora
                    window.addEventListener('click', function(e) {
                        if (!e.target.classList.contains('dropdown-button')) {
                            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                                menu.style.display = 'none';
                            });
                        }
                    });
                </script>

            </div>




    </section>
    <section class="secimoveis">


        <div class="site">
            <div class="insertimovel">
                <?php if (!empty($mensagem)): ?>
                    <div class="alerta-vazio" style="color:red; font-weight:bold; margin:20px 0;">
                        <?= $mensagem ?>
                    </div>
                <?php endif; ?>

                <?php foreach ($imovel as $linha): ?>
                    <?php $link = $this->gerarLinkImovel($linha['id_imovel'], $linha['nome_imovel']); ?>
                    <div class="cartao-imovel">
                        <img src="<?= URL_BASE ?>upload/imovel/<?= $linha['url_foto_imovel'] ?>" alt="<?= $linha['nome_imovel']; ?>">
                        <div class="prop">
                            <p><?= $linha['nome_imovel']; ?></p>
                        </div>
                        <div class="cont">
                            <p><?= $linha['tipo_anuncio_imovel']; ?></p>
                            <p><?= $linha['endereco_imovel']; ?></p>
                            <p>R$ <?= $linha['preco_imovel']; ?></p>
                            <!-- <p>Proprietário: <?= $linha['nome_proprietario']; ?></p> -->
                            <?= $linha['id_imovel']; ?>
                        </div>
                        <a href="<?= URL_BASE ?>imovel/detalhe/<?= $link ?>" class="overlay">Ver Mais</a>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>

    </section>

    <?php require_once('template/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/slick.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/lity.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/wow.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/animacao.js"></script>
</body>

</html>