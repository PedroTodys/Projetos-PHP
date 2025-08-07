<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função para verificar se o usuário está logado
function verificar_login() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

// Função para verificar se o usuário é admin
function verificar_admin() {
    verificar_login(); // garante que está logado
    if ($_SESSION['usuario_tipo'] !== 'admin') {
        echo "Acesso negado. Somente administradores.";
        exit;
    }
}
