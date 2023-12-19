<?php
/*
Plugin Name: Funções de Usuários Customizados
Description: Cria novas funções de usuários customizados.
Version: 1.0
Author: Teqii
*/

if (!defined('ABSPATH')) {
  exit; 
}
class MeuPluginUsuarios {
    public function __construct()
    {
        add_action('admin_menu', array($this, 'adicionarMenuAdmin'));
        add_action('admin_menu', [$this, 'visualizarTodosUsuarios']);
        add_filter('editable_roles', [$this,'personalizar_opcoes_usuario_admin_amalfis']);
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
    }

    public function enqueueStyles() {
        wp_enqueue_style('meu-plugin-estilos', plugin_dir_url(__FILE__) . 'src/css/created-user.css');
    }

    public function adicionarMenuAdmin()
    {
        add_menu_page('Novo Usuário', 'Novo Usuário', 'manage_options', 'novo-usuario', array($this, 'paginaAdmin'));
    }

    public function paginaAdmin()
    {
        $roles = get_editable_roles();
        if (function_exists('get_field_object')) {
            $field_key = "field_615f3394ab724"; 
            $field = get_field_object($field_key);
        
            if ($field) {
                $unidades = get_posts(array(
                    'post_type' => $field['post_type'][0], 
                    'posts_per_page' => -1,
                    'post_status' => 'publish' 
                ));
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this -> processarFormulario();
        }
        include_once('src/formulario-usuario.php');
    }

    private function processarFormulario()
    {
        $nome = sanitize_text_field($_POST['nome']);
        $email = sanitize_email($_POST['email']);
        $username = sanitize_user($_POST['usuario']);
        $password = $_POST['senha'];
        $role = $_POST['role'];
        $userdata = array(
            'user_login' => $username,
            'user_pass' => $password,
            'user_email' => $email,
            'first_name' => $nome,
            'role' => $role
        );
        
        $user_id = wp_insert_user($userdata);
        
        if (!is_wp_error($user_id)) {
            
            $empresa_id = intval($_POST['empresa']);
        
            update_field('unidades_usuario', $empresa_id, 'user_' . $user_id);
        } else {
            echo 'Erro: ' . $user_id->get_error_message();
        }
    }

    public function visualizarTodosUsuarios() {
        add_menu_page('Ver Usuários',
        'Ver Usuários',
        'manage_options',
        'todos-usuarios',
        array($this, 'manageAllUsers'),
        'dashicons-admin-users',
        );
    }

    public function manageAllUsers() {
        $current_user = wp_get_current_user();
        $user_units = get_user_meta($current_user->ID, 'unidades_usuario', true);
    
        if ($user_units) {
            $role_filter = isset($_GET['role']) ? $_GET['role'] : '';
            $allowed_roles = array('gerente_loja', 'cliente');
    
            $args = array(
                'meta_query' => array(
                    array(
                        'key' => 'unidades_usuario',
                        'value' => $user_units, // Utilize o valor direto, não serializado
                        'compare' => '=', // Se for um valor exato, como um ID
                    ),
                ),
                'fields' => 'all',
            );
    
            if (!empty($role_filter) && in_array($role_filter, $allowed_roles)) {
                $args['role__in'] = array($role_filter);
            }
    
            $users = get_users($args);
        }
    
        include('src/all-user.php');
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->processarFormulario();
            wp_redirect(admin_url('admin.php?page=todos-usuarios'));
            exit;
        }
    }
    
    public function personalizar_opcoes_usuario_admin_amalfis($all_roles) {
        $current_user = wp_get_current_user();
        include_once('src/function-user.php');
    
        if (in_array('administrator', $current_user->roles)) {
            $all_roles['administrator']['capabilities']['edit_users'] = true;
        }
    
        $roles_personalizadas = personalizar_roles_usuario($current_user, $all_roles);
    
        return $roles_personalizadas;
    }
}
function run_meu_plugin_usuarios()
{
    $plugin = new MeuPluginUsuarios();
}
run_meu_plugin_usuarios();
