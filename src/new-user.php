<?php

$role = get_role('adminis_amalfis');
if (!$role) {
    add_role(
        'adminis_amalfis',
        'Administrador amalfis',
        array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => true,
            'create_posts' => true,
            'edit_others_posts' => true,
            'publish_posts' => true,
            'manage_options' => true,
        )
    );
}

$admin_loja = get_role('administrador_loja');
if (!$admin_loja) {
    add_role(
        'administrador_loja',
        'Administrador Loja',
        array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => true,
            'create_users', true,
        )
    );
}

$gerente_loja = get_role('gerente_loja');
if (!$gerente_loja) {
    add_role(
        'gerente_loja',
        'Gerente Loja',
        array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => false,
        )
    );
}


$teste = get_role('teste');
if (!$teste) {
    add_role(
        'teste',
        'Teste Etion',
        array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => false,
        )
    );
}