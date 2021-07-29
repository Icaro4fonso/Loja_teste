<?php

namespace App\Http\Controllers;

use App\Models\Roupas;
use App\Models\Estampas;
use App\Models\Produtos;
use Illuminate\Http\Request;
use PDO;

class LojaController extends Controller
{
    private $estado;

    public function index()
    {
        return "Bem-vindo a criação de produtos";    
    }


    //Inicio do CRUD para roupas
    public function criar_roupa(Request $request)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $tipo = $request['tipo'];
            $tamanho = $request['tamanho'];
            $cor = $request['cor'];
            $stmt = $pdo->prepare("
            SELECT * FROM roupas WHERE tipo = '$tipo' AND tamanho = '$tamanho' AND cor ='$cor'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Esta roupa já foi cadastrada";
            }

            Roupas::create($request->all());
            return "Roupa cadastrada com sucesso" ;
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }   
    }

    public function encontrar_roupa($id)
    {
        try{
            return Roupas::findOrFail($id);
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function atualizar_roupa(Request $request, $id)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $tipo = $request['tipo'];
            $tamanho = $request['tamanho'];
            $cor = $request['cor'];
            $stmt = $pdo->prepare("
            SELECT * FROM roupas WHERE tipo = '$tipo' AND tamanho = '$tamanho' AND cor ='$cor'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Esta roupa já foi cadastrada";
            }
            $roupa = Roupas::findOrFail($id);
            $roupa->update($request->all());
            return "Roupa atualizada com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function excluir_roupa($id)
    {
        try{
            $roupa = Roupas::findOrFail($id);
            $roupa->delete();
            return "Roupa excluida com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    //Fim do CRUD para roupas



    //Inicio do CRUD para estampas
    public function criar_estampa(Request $request)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $categoria = $request['categoria'];
            $nome = $request['nome'];
            $stmt = $pdo->prepare("
            SELECT * FROM estampas WHERE categoria = '$categoria' AND nome = '$nome'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Esta estampa já foi cadastrada";
            }

            Estampas::create($request->all());
            return "Estampa cadastrada com sucesso" ; 
        }  
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function encontrar_estampa($id)
    {
        try{
            $data = Estampas::findOrFail($id);
            return $data;
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function atualizar_estampa(Request $request, $id)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $categoria = $request['categoria'];
            $nome = $request['nome'];
            $stmt = $pdo->prepare("
            SELECT * FROM estampas WHERE categoria = '$categoria' AND nome = '$nome'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Esta estampa já foi cadastrada";
            }   

            $estampa = Estampas::findOrFail($id);
            $estampa->update($request->all());
            return "Estampa atualizado com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function excluir_estampa($id)
    {
        try{
            $estampa = Estampas::findOrFail($id);
            $estampa->delete();
            return "Estampa excluida com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        
    }
    //Fim do CRUD para estamapas



    //Inicio do CRUD para produtos
    public function criar_produto(Request $request)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $id_roupa = $request['id_roupa'];
            $id_estampa = $request['id_estampa'];
            $horario = date("Y-m-d H:i:s");
            $stmt = $pdo->prepare("
            SELECT * FROM produtos WHERE id_roupa = '$id_roupa' AND id_estampa = '$id_estampa'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Este produto já foi cadastrado";
            }
            $roupa = Roupas::findOrFail($id_roupa);
            $estampa = Estampas::findOrFail($id_estampa);
            $valor_produto = $estampa['valor'] + $roupa['valor'];
            $SKU = $estampa['categoria']. "_" . $estampa['nome']. "_". $roupa['tipo'] ."_". $roupa['tamanho'] ."_". $roupa['cor'];
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $stmt = $pdo->prepare("
            INSERT INTO produtos(id_roupa,id_estampa,valor,SKU,created_at,updated_at) VALUE('$id_roupa','$id_estampa','$valor_produto','$SKU','$horario','$horario')
            ");
            $stmt->execute(); 
            return "Produto cadastrado com sucesso";
            
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function encontrar_produto(Request $request, $id)
    {
        try{
             $produto = Produtos::findOrFail($id);
             $id_estampa = $produto['id_estampa'];
             $id_roupa = $produto['id_roupa'];
             $horario = date("Y-m-d H:i:s");
             $roupa = Roupas::findOrFail($id_roupa);
             $estampa = Estampas::findOrFail($id_estampa);
             $valor_produto = $estampa['valor'] + $roupa['valor'];
             $SKU = $estampa['categoria']. "_" . $estampa['nome']. "_". $roupa['tipo'] ."_". $roupa['tamanho'] ."_". $roupa['cor'];
             $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
             $stmt = $pdo->prepare("
             UPDATE produtos 
             SET valor = '$valor_produto' ,SKU = '$SKU',updated_at ='$horario'
             WHERE id = '$id'
             ");
             $stmt->execute();
            return Produtos::findOrFail($id);

        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function atualizar_produto(Request $request, $id)
    {
        try{
            Produtos::findOrFail($id);
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $id_estampa = $request['id_estampa'];
            $id_roupa = $request['id_roupa'];
            $horario = date("Y-m-d H:i:s");
            $stmt = $pdo->prepare("
            SELECT * FROM produtos WHERE id_roupa = '$id_roupa' AND id_estampa = '$id_estampa'
            ");
            $stmt->execute();

            if($stmt->rowCount() == 1){
                return "Desculpe, Este produto já foi cadastrado";
            }
            $roupa = Roupas::findOrFail($id_roupa);
            $estampa = Estampas::findOrFail($id_estampa);
            $valor_produto = $estampa['valor'] + $roupa['valor'];
            $SKU = $estampa['categoria']. "_" . $estampa['nome']. "_". $roupa['tipo'] ."_". $roupa['tamanho'] ."_". $roupa['cor'];
            $pdo = new PDO('mysql:host=localhost;dbname=loja_teste', 'root', '');
            $stmt = $pdo->prepare("
            UPDATE produtos 
            SET id_roupa = '$id_roupa' ,id_estampa ='$id_estampa' , valor = '$valor_produto' ,SKU = '$SKU',updated_at ='$horario'
            WHERE id = '$id'
            ");
            $stmt->execute(); 
            return "Produto atualizado com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    public function excluir_produto($id)
    {
        try{
            $produto = Produtos::findOrFail($id);
            $produto->delete();
            return "Produto excluido com sucesso";
        }
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
    }
    //Fim do CRUD para produtos

}
