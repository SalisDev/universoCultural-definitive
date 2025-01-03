<?php
class Livro
{
    public static function cadastrarLivro($capa, $imagem, $autor, $editora, $ISBN, $paginas, $subtitulo, $estoque, $idioma, $genero, $anoLancamento)
    {
        try {
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $nomeImagem = 'app1.' . $extensao; // Nome fixo da imagem
                $diretorio = 'uploads/capas/';

                // Cria o diretório se não existir
                if (!is_dir($diretorio)) {
                    mkdir($diretorio, 0777, true);
                }

                // Move o arquivo para o diretório de uploads
                move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem);

                // Atribui o caminho do arquivo à variável $capa
                $imagem = $diretorio . $nomeImagem; // Aqui você passa o caminho do arquivo como imagem
            } else {
                $imagem = 'uploads/capas/default.jpg'; // Caminho default, se não houver imagem
            }


            // Conecta ao banco de dados
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO tbLivro (capa, imagem, autor, editora, ISBN, paginas, subtitulo, estoque, idioma, genero, anoLancamento) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Agora incluindo todos os parâmetros corretamente
            $sql->execute([$capa, $imagem, $autor, $editora, $ISBN, $paginas, $subtitulo, $estoque, $idioma, $genero, $anoLancamento]);

            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar livro: " . $e->getMessage());
            return false;
        }
    }


    public static function atualizarLivro($id, $capa, $autor, $editora, $ISBN, $paginas, $subtitulo, $estoque, $idioma, $genero, $anoLancamento)
    {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("UPDATE tbLivro 
                                  SET capa = ?, autor = ?, editora = ?, ISBN = ?, paginas = ?, subtitulo = ?, estoque = ?, idioma = ?, genero = ?, anoLancamento = ? 
                                  WHERE cod = ?");
            $sql->execute([$capa, $autor, $editora, $ISBN, $paginas, $subtitulo, $estoque, $idioma, $genero, $anoLancamento, $id]);
            return $sql->rowCount() > 0; // Verifica se houve alteração no banco
        } catch (PDOException $e) {
            error_log("Erro ao atualizar livro: " . $e->getMessage());
            return false;
        }
    }

    public static function excluirLivro($id)
    {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM tbLivro WHERE cod = ?");
            $sql->execute([$id]);
            return $sql->rowCount() > 0; // Verifica se o registro foi excluído
        } catch (PDOException $e) {
            error_log("Erro ao excluir livro: " . $e->getMessage());
            return false;
        }
    }
    public static function listarLivros()
    {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->query("SELECT * FROM tbLivro");
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar livros: " . $e->getMessage());
            return false;
        }
    }

    public static function buscarLivroPorId($id)
    {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("SELECT * FROM tbLivro WHERE cod = ?");
            $sql->execute([$id]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar livro por ID: " . $e->getMessage());
            return false;
        }
    }
}
?>