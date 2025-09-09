<?php require_once('template/head.php'); ?>

<?php require_once('template/header.php'); ?>

<script src="https://cdn.tailwindcss.com"></script>

<body class=" text-gray-800 font-sans" id="detalhes">


    <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Imagens -->
        <div style="padding-bottom: 44%;">
            <img id="imagem-principal" src="<?= URL_BASE ?>assets/img/<?= $imovel['url_foto_imovel']; ?>" alt="Crisântemos" class="rounded-2xl shadow-md w-full h-auto" />

            <div class="flex space-x-2 mt-4">
                <img src="<?= URL_BASE ?>assets/img/<?= $imovel['url_foto_imovel']; ?>" class="w-20 h-20 object-cover rounded-xl ring-2 ring-orange-500 cursor-pointer miniatura" />
                <img src="<?= URL_BASE ?>assets/img/<?= $imovel['url_foto_imovel']; ?>" class="w-20 h-20 object-cover rounded-xl cursor-pointer miniatura" />
                <img src="<?= URL_BASE ?>assets/img/imovel1_1.jpg" class="w-20 h-20 object-cover rounded-xl cursor-pointer miniatura" />
                <img src="<?= URL_BASE ?>assets/img/<?= $imovel['url_foto_imovel']; ?>" class="w-20 h-20 object-cover rounded-xl cursor-pointer miniatura" />
            </div>
        </div>

        <!-- Informações -->
        <div>
            <p class="text-sm text-blue-600 font-medium mb-1">
                👁 <?= $imovel['visualizacoes']; ?> visualizando
            </p>
            <h1 class="text-3xl font-semibold text-gray-900"><?= $imovel['nome_imovel']; ?></h1>

            <div class="flex items-center mt-2">
                <div class="flex text-yellow-400 text-lg">
                    ★★★★☆
                </div>
                <span class="ml-2 text-gray-600 text-sm">4.6 (78 vendidos)</span>
            </div>

            <div class="mt-4">
                <span class="line-through text-gray-500 text-lg"><?= $imovel['preco_imovel']; ?></span>
                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-sm ml-2">-25% OFF</span>
                <div class="text-3xl font-bold text-orange-600 mt-2"><?= $imovel['preco_imovel']; ?></div>
            </div>

            <p class="text-gray-700 mt-4"><?= $imovel['descricao_imovel']; ?></p>

            <div class="flex items-center space-x-6 mt-4 text-sm text-gray-600">
                <p>🏠<strong><?= $imovel['complemento_imovel']; ?></strong></p>
                <p>Bairro <strong><?= $imovel['bairro_imovel']; ?></strong></strong></p>
            </div>


            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button class="bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-semibold flex items-center justify-center" style="width: 535px;">
                    Adquirir o Imóvel
                </button>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <button class="border border-orange-500 text-orange-500 rounded-xl py-2 font-medium flex items-center justify-center">
                    ❤️ Favoritar
                </button>
                <a
                    href="https://wa.me/5511976836178?text=Olá, tenho interesse no imóvel <?= $imovel['nome_imovel']; ?>"
                    target="_blank"
                    class="border border-blue-500 text-blue-500 rounded-xl py-2 font-medium flex items-center justify-center"
                    style="text-decoration: none;"
                >
                    📱 WhatsApp
                </a>
            </div>

            <div class="mt-6">
                <p class="text-sm text-gray-600 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 11h.01M7 15h.01M11 7h.01M11 11h.01M11 15h.01M15 7h.01M15 11h.01M15 15h.01" stroke-linecap="round" stroke-linejoin="round"/><rect width="20" height="20" x="2" y="2" rx="5" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                    Tags:
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium transition hover:bg-orange-500 hover:text-white cursor-pointer shadow-sm">tradicional</span>
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium transition hover:bg-orange-500 hover:text-white cursor-pointer shadow-sm">prosperidade</span>
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium transition hover:bg-orange-500 hover:text-white cursor-pointer shadow-sm">dourado</span>
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium transition hover:bg-orange-500 hover:text-white cursor-pointer shadow-sm">fortuna</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Seleciona todas as miniaturas
        document.querySelectorAll('.miniatura').forEach(function(img) {
            img.addEventListener('click', function() {
                document.getElementById('imagem-principal').src = this.src;
            });
        });
    </script>
</body>

<?php require_once('template/footer.php'); ?>