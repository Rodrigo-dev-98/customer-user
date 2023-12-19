<?php

function personalizar_roles_usuario($current_user, $all_roles) {
    $roles_personalizadas = array();

    if (in_array('administrator', (array) $current_user->roles)) {
        return $all_roles;
    }

    if (in_array('adminis_amalfis', (array) $current_user->roles)) {
        $roles_personalizadas = array(
            'administrador_loja' => $all_roles['administrador_loja'],
            'gerente_loja' => $all_roles['gerente_loja'],
            'customer' => $all_roles['customer'],
        );
    } elseif (in_array('administrador_loja', (array) $current_user->roles)) {
        $roles_personalizadas = array(
            'gerente_loja' => $all_roles['gerente_loja'],
            'customer' => $all_roles['customer'],
        );
    } elseif (in_array('gerente_loja', (array) $current_user->roles)) {
        $roles_personalizadas = array(
            'customer' => $all_roles['customer'],
        );
    }

    return $roles_personalizadas;
}
