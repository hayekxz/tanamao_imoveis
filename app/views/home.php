<?php require_once('template/head.php'); ?>
<div class="banner_img">
    <?php require_once('template/header.php'); ?>

    <body>

        <section class="banner">
            <h2>A procura de um lugar... <strong>Tanamão!</strong></h2>


            <form method="GET" action="<?= URL_BASE ?>Imovel">
                <div class="filtro-container">
                    <input type="text" name="busca" class="filtro-input" placeholder="Digite sua pesquisa...">

                    <div class="filtro-botao-container">
                        <button type="submit" class="filtro-botao-pesq">    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg></button>
                    </div>
                </div>
            </form>



            <div class="botoes-adicionais">
                <a href="<?= URL_BASE ?>Imovel?tipo=venda" class="botao-adicional">Comprar</a>
                <a href="<?= URL_BASE ?>Imovel?tipo=aluguel" class="botao-adicional">Alugar</a>
                <a href="<?= URL_BASE ?>Imovel?tipo=venda" class="botao-adicional">Venda</a>
                <a href="<?= URL_BASE ?>Imovel?tipo=venda" class="botao-adicional">Ver Mais</a>
            </div>
        </section>

</div>
<section class="destaque">
    <div class="site">
        <div class="carrossel">
            <div class="fundodestaque">
                <img src="<?= URL_BASE; ?>assets/img/imovel1_1.jpg" alt="">
                <div class="infodestaque">
                    <a href="<?= URL_BASE; ?>imovel">Saiba Mais</a>
                </div>
            </div>
            <div class="fundodestaque">
                <img src="<?= URL_BASE; ?>assets/img/imovel4_1.jpg" alt="">
                <div class="infodestaque">
                    <a href="<?= URL_BASE; ?>imovel">Saiba Mais</a>
                </div>
            </div>
        </div>
        <div class="msgdestaque">
            <h3>Comprar um imóvel para chamar de lar</h3>
            <div>
                <h4 class="h4">Na <strong>Tanamão Imóveis</strong>, Garantimos uma experiência segura e sem
                    complicações <br> na compra ou venda do seu imóvel, com assessoria especializada <br> e analise
                    detalhada de toda a documentação.</h4>
            </div>
            <a href="<?= URL_BASE; ?>imovel">VER CASAS A VENDA</a>
        </div>
    </div>
    </div>
</section>



<section class="ofertas">
    <div class="site">
        <div class="linha-com-texto">
            <span>Em Oferta</span>
        </div>

        <div class="caixas" data-slick='{"slidesToShow": 2, "slidesToScroll": 2}'>

            <div class="caixa1">

                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel1_2.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific">

                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo-2">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>80 m²</p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="caixa2">
                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel2_1.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific2">

                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>60 m²</p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="caixa1">
                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel1_2.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific">
                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>80 m²</p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="caixa2">
                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel2_1.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific2">
                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>


                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>60 m²</p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="caixa1">
                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel1_2.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific">
                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>


                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>80 m²</p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="caixa2">
                <a href="imovel"> <img src="<?= URL_BASE; ?>assets/img/imovel2_1.jpg" alt="Imagem 1"> </a>
                <img src="<?= URL_BASE; ?>assets/img/queimar.png" alt="">

                <div class="especific2">
                    <div class="info">
                        <p>Guarulhos</p>
                        <h2>Apartamento | R$ 4.000</h2>
                        <p>Zona Leste - SP</p>
                    </div>


                    <div class="parte-baixo">

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/cama-de-hotel.png" alt="">
                            <p>2 Quarto(s)</p>

                        </div>

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/car.png" alt="">
                            <p>1 Garegem</p>

                        </div>

                    </div>

                    <div class="parte-baixo">

                        <div class="img-texto2">

                            <img src="<?= URL_BASE; ?>assets/img/chuveiro.png" alt="">
                            <p>1 Suite(s)</p>

                        </div>

                        <div class="img-texto1">

                            <img src="<?= URL_BASE; ?>assets/img/shape.png" alt="">
                            <p>60 m²</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<section class="intereses">
    <div>
        <img src="<?= URL_BASE; ?>assets/img/imovel2_1.jpg" alt="">
        <a href="#">Comprar ou alugar em São Miguel</a>

    </div>
    <div>
        <img src="<?= URL_BASE; ?>assets/img/imovel1_2.jpg" alt="">
        <a href="#">Apartamentos em Guarulhos</a>

    </div>
    <div>
        <img src="<?= URL_BASE; ?>assets/img/imovel4_1.jpg" alt="">
        <a href="#">Casa para chamar de sua</a>

    </div>
</section>

<section class="contato">
    <div class="site">
        <div class="informacoes">
            <h3>Fale Conosco</h3>

            <?php if (!empty($_SESSION['msg_contato'])): ?>
                <div class="alerta-vazio" style="color:green; font-weight:bold; margin:10px 0;">
                    <?= $_SESSION['msg_contato'];
                    unset($_SESSION['msg_contato']); ?>
                </div>
            <?php endif; ?>

            <form style="display: contents;" method="post" action="<?= URL_BASE ?>home/enviarContato">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="telefone" placeholder="Telefone">
                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" placeholder="" required></textarea>
                <button type="submit" class="btn-enviar">Enviar</button>
            </form>
        </div>
        <div class="contate">
            <h3>Nossos Contatos</h3>
            <p><a href="#">Email: tanamaoimoveis@gmail.com</a></p>
            <p><a href="#">Telefone: (55+) 11 96588-8821</a></p>
        </div>
    </div>
</section>

<?php require_once('template/footer.php'); ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= URL_BASE; ?>assets/js/slick.min.js"></script>
<script src="<?= URL_BASE; ?>assets/js/lity.min.js"></script>
<script src="<?= URL_BASE; ?>assets/js/wow.min.js"></script>
<script src="<?= URL_BASE; ?>assets/js/animacao.js"></script>

</body>

</html>