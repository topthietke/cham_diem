<?php
function e(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function badge_class(string $difficulty): string
{
    return match ($difficulty) {
        'Dễ' => 'bg-success',
        'Khó' => 'bg-danger',
        default => 'bg-warning text-dark',
    };
}

function is_admin_logged_in(): bool
{
    return isset($_SESSION['admin_id']);
}

function require_admin_login(): void
{
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
