$(document).ready(function () {
    $('.caixas').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
$('.carrossel').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
  });

  document.addEventListener('DOMContentLoaded', () => {
    const textareas = document.querySelectorAll('textarea');
  
    textareas.forEach((textarea) => {
      textarea.addEventListener('click', () => {
        textarea.classList.toggle('active');
      });
    });
  });

  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header');
    const scrollThreshold = 650;

    if (window.scrollY > scrollThreshold) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const modalContainer = document.getElementById('modalContainer');
    const openLoginModal = document.getElementById('openLoginModal');

    let modal; // vai guardar o modal carregado

    openLoginModal.addEventListener('click', async (e) => {
        e.preventDefault();

        // Se o modal já foi carregado, só mostra
        if (modal) {
            modal.style.display = 'flex';
            return;
        }

        // Carrega o HTML do modal via fetch
        try {
            const response = await fetch('Login');

            const html = await response.text();

            // Insere o modal no container
            modalContainer.innerHTML = html;

            // Agora pega o modal e os elementos para a lógica
            modal = document.getElementById('loginModal');
            const fecharBtn = modal.querySelector('.fechar');
            const btnLogin = modal.querySelector('#btnLogin');
            const btnCadastro = modal.querySelector('#btnCadastro');
            const formLogin = modal.querySelector('#formLogin');
            const formCadastro = modal.querySelector('#formCadastro');

            // Exibe o modal
            modal.style.display = 'flex';

            // Eventos para fechar modal
            fecharBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Alternar para login
            btnLogin.addEventListener('click', () => {
                btnLogin.classList.add('active');
                btnCadastro.classList.remove('active');
                formLogin.style.display = 'block';
                formCadastro.style.display = 'none';
            });

            // Alternar para cadastro
            btnCadastro.addEventListener('click', () => {
                btnCadastro.classList.add('active');
                btnLogin.classList.remove('active');
                formLogin.style.display = 'none';
                formCadastro.style.display = 'block';
            });

        } catch (error) {
            console.error('Erro ao carregar modal:', error);
        }
    });
});



