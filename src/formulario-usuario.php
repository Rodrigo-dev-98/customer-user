<div class="content-title">
  <div class="body-content-title">
    <h2 class="title">Cadastro de Usuário</h2>
  </div>
</div>
<form method="post" action="<?php echo esc_url(admin_url('admin.php?page=todos-usuarios')); ?>">
  <div class="content-form">
    <div class="body-content">
      <h3 class="title">Informações Básicas</h3>
      <div class="form-row">
        <div class="form-column">
          <label for="nome">Nome Completo</label>
          <input type="text" id="nome" name="nome">
        </div>
        <div class="form-column">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email">
        </div>
      </div>

      <div class="form-row">
        <div class="form-column">
          <label for="usuario">Usuário</label>
          <input type="text" id="usuario" name="usuario">
        </div>
        <div class="form-column">
          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha" required>
          <div class="mostrar-gerar">
            <span><input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha </span>
            <button type="button" onclick="gerarSenha()" class="button wp-generate-pw hide-if-no-js" aria-expanded="true">Gerar senha</button>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-column">
          <label for="role">Perfil</label>
          <select name="role" id="role">
            <?php foreach ($roles as $role => $details) { ?>
              <option value="<?php echo esc_attr($role); ?>"><?php echo translate_user_role($details['name']); ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-column">
          <label for="empresa">Empresa</label>
          <select name="empresa" id="empresa">
            <?php 
            if (isset($unidades) && !empty($unidades)) {
              foreach ($unidades as $unidade) { ?>
                <option value="<?php echo esc_attr($unidade->ID); ?>"><?php echo esc_html($unidade->post_title); ?></option>
              <?php 
              } 
            } ?>
          </select>
        </div>
      </div>
      <input class="button-cadastrar" type="submit" value="Cadastrar Usuário">
    </div>
  </div>
</form>

<script>
  function mostrarOcultarSenha() {
    var senha = document.getElementById("senha");
    if (senha.type === "password") {
      senha.type = "text";
    } else {
      senha.type = "password";
    }
  }

    function gerarSenha() {
    var senha = document.getElementById("senha");
    var comprimentoSenha = 16; 
    var caracteresEspeciais = "!@#$%&()_+{}[]|:;<>?";
    var senhaAleatoria = "";

    for (var i = 0; i < comprimentoSenha; i++) {
      var randomIndex = Math.floor(Math.random() * (caracteresEspeciais.length + 26)); 
      if (randomIndex < caracteresEspeciais.length) {
        senhaAleatoria += caracteresEspeciais[randomIndex];
      } else {
        senhaAleatoria += String.fromCharCode(97 + Math.floor(Math.random() * 26));
      }
    }

    senha.value = senhaAleatoria;
  }

</script>