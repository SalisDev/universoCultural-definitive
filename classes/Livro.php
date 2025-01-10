<?php 
class Livro
{
    public static function cadastrarLivro($nome,$estoque, $preco, $tipo_capa, $imagem, $autor, $editora, $ISBN, $paginas, $subtitulo, $idioma, $genero, $anoLancamento)
    {
        try {
            // Conecta ao banco de dados
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO tbLivro (nome, capa, imagem, autor, editora, ISBN, paginas, subtitulo, estoque, preco, idioma, genero, anoLancamento) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Agora incluindo todos os parâmetros corretamente
            $sql->execute([$nome, $tipo_capa, $imagem, $autor, $editora, $ISBN, $paginas, $subtitulo, $estoque, $preco, $idioma, $genero, $anoLancamento]);

            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar livro: " . $e->getMessage());
            return $e->getMessage();
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

    public static function listarLivros($idUsuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("SELECT 
                                      l.cod, 
                                      l.nome, 
                                      l.imagem, 
                                      l.preco, 
                                      l.subtitulo, 
                                      (CASE WHEN f.cod_livro IS NOT NULL THEN 1 ELSE 0 END) AS is_favorite
                                  FROM tbLivro l
                                  LEFT JOIN tbfavorito f ON l.cod = f.cod_livro AND f.cod_usuario = ?");
            $sql->execute([$idUsuario]);
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

            // Verifica se encontrou algum livro
            $livro = $sql->fetch(PDO::FETCH_ASSOC);
            if ($livro) {
                return $livro;
            } else {
                // Caso não encontre, retorne false ou uma mensagem
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erro ao buscar livro por ID: " . $e->getMessage());
            return false;
        }
    }

public static function buscarDetalhes($id)
{
    try {
        $pdo = MySql::conectar();
        $sql = $pdo->prepare("SELECT 
                                  l.cod, 
                                  l.nome, 
                                  l.capa, 
                                  l.imagem, 
                                  l.autor, 
                                  l.editora, 
                                  l.ISBN, 
                                  l.paginas, 
                                  l.subtitulo, 
                                  l.estoque, 
                                  l.preco, 
                                  l.idioma, 
                                  l.genero, 
                                  l.anoLancamento,
                                  (CASE WHEN f.cod_livro IS NOT NULL THEN 1 ELSE 0 END) AS is_favorite
                              FROM tbLivro l
                              LEFT JOIN tbfavorito f ON l.cod = f.cod_livro AND f.cod_usuario = ?
                              WHERE l.cod = ?");
        $sql->execute([$id]);
        $detalhes = $sql->fetch(PDO::FETCH_ASSOC);
        return $detalhes ? $detalhes : false;
    } catch (PDOException $e) {
        error_log("Erro ao buscar detalhes do livro: " . $e->getMessage());
        return false;
    }
}
}
?>