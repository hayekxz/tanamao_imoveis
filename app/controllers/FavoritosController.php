<?php

class FavoritosController extends Controller
{

    public function getFavoritos()
    {
        return array(); 
    }
    public function getTodosFavoritos()
    {
        return array(); 
    }

    private $modelFavorito;

    //Construir algo automaticamente - executa todos os dados | Instanciou uma classe e será executado 
    public function __construct()
    {

        $this->modelFavorito = new Favoritos();
    }
    public function index($id)
    {
        $dados = array();

        $todosOsFavoritos = $this->modelFavorito->getFavoritosImovel($id);
        $dados["favoritos"] = $todosOsFavoritos;

        $this->carregarViews('admin/favoritos/listar', $dados);

    }

    public function listar(){
        
        $dados = array();

        $dados['conteudo'] = 'admin/favoritos/listar';

        $anuncios = $this->modelFavorito->getTodosFavoritos();

        $dados['favoritos'] = $anuncios;

        $this->carregarViews('admin/dash', $dados);

    }

}