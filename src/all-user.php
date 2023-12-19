<!-- all-user.php -->
<div class="wrap">
    <h2>Todos os Usuários</h2>
    <div class="tablenav top">
        <div class="alignleft actions">
            <a href="users.php?role=gerente_empresa" class="button">Gerente Empresa</a>
            <a href="users.php?role=cliente" class="button">Cliente</a>
        </div>
    </div>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th class="manage-column column-username">Nome do usuário</th>
                <th class="manage-column column-name">Nome</th>
                <th class="manage-column column-email">E-mail</th>
                <th class="manage-column column-role">Função</th>
                <th class="manage-column column-edit">Editar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="manage-column column-username">Nome do usuário</th>
                <th class="manage-column column-name">Nome</th>
                <th class="manage-column column-email">E-mail</th>
                <th class="manage-column column-role">Função</th>
                <th class="manage-column column-edit">Editar</th>
            </tr>
        </tfoot>
        <tbody id="the-list">
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="username column-username"><?php echo esc_html($user->user_login); ?></td>
                        <td class="name column-name"><?php echo esc_html($user->display_name); ?></td>
                        <td class="email column-email"><?php echo esc_html($user->user_email); ?></td>
                        <td class="role column-role"><?php echo esc_html(implode(', ', $user->roles)); ?></td>
                        <td class="edit column-edit">
                            <a href="<?php echo esc_url(get_edit_user_link($user->ID)); ?>">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
 