<?php 
class Compra {
        public static function cadastrarCompra($entrega, $hora, $dataCompra, $quantidade, $livro, $usuario) {
            try {
                $pdo = MySql::conectar();
                $sql = $pdo->prepare("INSERT INTO tbcompra (entrega, hora, dataCompra, quantidade, livro, usuario) VALUES (?, ?, ?, ?, ?, ?)");
                $sql->execute([$entrega, $hora, $dataCompra, $quantidade, $livro, $usuario]);
                return $pdo->lastInsertId();
            } catch (PDOException $e) {
                error_log("Erro ao cadastrar compra: " . $e->getMessage());
                return false;
            }
        }
    
        public static function atualizarCompra($id, $entrega, $hora, $dataCompra, $quantidade, $livro, $usuario) {
            try {
                $pdo = MySql::conectar();
                $sql = $pdo->prepare("UPDATE tbcompra SET entrega = ?, hora = ?, dataCompra = ?, quantidade = ?, livro = ?, usuario = ? WHERE cod = ?");
                $sql->execute([$entrega, $hora, $dataCompra, $quantidade, $livro, $usuario, $id]);
                return true;
            } catch (PDOException $e) {
                error_log("Erro ao atualizar compra: " . $e->getMessage());
                return false;
            }
        }
    
        public static function excluirCompra($id) {
            try {
                $pdo = MySql::conectar();
                $sql = $pdo->prepare("DELETE FROM tbcompra WHERE cod = ?");
                $sql->execute([$id]);
                return true;
            } catch (PDOException $e) {
                error_log("Erro ao excluir compra: " . $e->getMessage());
                return false;
            }
        }
    
        // Função para finalizar a compra
        public static function finalizarCompra($usuario) {
            try {
                // Primeiramente, recupere os livros no carrinho para o usuário
                $pdo = MySql::conectar();
                $sql = $pdo->prepare("SELECT * FROM tbcarrinho WHERE cod_usuario = ?");
                $sql->execute([$usuario]);
                $carrinho = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch ao invés de fetchAll
    
                if ($carrinho) {
                    // Percorra os livros no carrinho e cadastre cada compra
                    do {
                        $livro = $carrinho['cod_livro']; // O ID do livro
                        
                        // Verificar se 'quantidade' existe e, se não, definir como 1
                        $quantidade = isset($carrinho['quantidade']) ? $carrinho['quantidade'] : 1; 
    
                        $hora = date("H:i:s"); // Hora da compra
                        $dataCompra = date("Y-m-d"); // Data da compra
                        $entrega = "Pendente"; // Status da entrega, pode ser alterado conforme necessário
    
                        // Verificar se o livro já foi comprado anteriormente
                        $sqlCheck = $pdo->prepare("SELECT * FROM tbcompra WHERE livro = ? AND usuario = ?");
                        $sqlCheck->execute([$livro, $usuario]);
                        $livroExistente = $sqlCheck->fetch(PDO::FETCH_ASSOC);
    
                        if (!$livroExistente) {
                            // Chame a função para cadastrar a compra para cada item
                            $compraId = self::cadastrarCompra($entrega, $hora, $dataCompra, $quantidade, $livro, $usuario);
        
                            // Após registrar a compra, remova o livro do carrinho
                            $sqlDelete = $pdo->prepare("DELETE FROM tbcarrinho WHERE cod_usuario = ? AND cod_livro = ?");
                            $sqlDelete->execute([$usuario, $livro]);
                        } else {
                            // Livro já comprado anteriormente, não adiciona novamente
                            echo '<script>alert("Este livro já foi comprado anteriormente!");</script>';
                        }
    
                    } while ($carrinho = $sql->fetch(PDO::FETCH_ASSOC)); // Processa todos os itens do carrinho
        
                    return true; // Compra finalizada com sucesso
                }
                return false; // Carrinho vazio, não pode finalizar compra
            } catch (PDOException $e) {
                error_log("Erro ao finalizar compra: " . $e->getMessage());
                return false;
            } finally {
                $pdo = null; // Fecha a conexão com o banco de dados
            }
        }
    }
    