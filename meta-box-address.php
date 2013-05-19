add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('info_client', 'Informations sur le client', 'info_client', 'ouvrage', 'side');
}

function info_client($post){
  $nom      = get_post_meta($post->ID,'_nom',true);
  $prenom   = get_post_meta($post->ID,'_prenom',true);
  $civilite = get_post_meta($post->ID,'_civilite',true);
  $societe  = get_post_meta($post->ID,'_societe',true);
  $adresse  = get_post_meta($post->ID,'_adresse',true);
  $mail     = get_post_meta($post->ID,'_mail',true);
  $tel      = get_post_meta($post->ID,'_tel',true);
  ?>
  <input id="" style="width: 50px;" type="text" name="civilite" value="<?php echo $civilite; ?>" />
  <input id="" type="text" name="prenom" value="<?php echo $prenom; ?>" />
  <input id="" type="text" name="nom" value="<?php echo $nom; ?>" />
  <textarea id="" style="width: 280px;" name="adresse"><?php echo $adresse; ?></textarea>
  <input id="" type="text" name="mail" value="<?php echo $mail; ?>" />
  <input id="" type="text" name="tel" value="<?php echo $tel; ?>" />
  <input id="" type="text" name="societe" value="<?php echo $societe; ?>" />
  <?php 
}

add_action('save_post','save_metabox');
function save_metabox($post_id){
  if(isset($_POST['civilite'])){
    update_post_meta($post_id, '_civilite', sanitize_text_field($_POST['civilite']));
  }
  if(isset($_POST['prenom'])){
    update_post_meta($post_id, '_prenom', sanitize_text_field($_POST['prenom']));
  }
  if(isset($_POST['societe'])){
    update_post_meta($post_id, '_societe', sanitize_text_field($_POST['societe']));
  }
  if(isset($_POST['nom'])){
    update_post_meta($post_id, '_nom', sanitize_text_field($_POST['nom']);
  }
  if(isset($_POST['adresse'])){
    update_post_meta($post_id, '_adresse', esc_textarea($_POST['adresse']));
  }
  if(isset($_POST['mail'])){
    update_post_meta($post_id, '_mail', is_email($_POST['mail']));
  }
  if(isset($_POST['tel'])){
    update_post_meta($post_id, '_tel', esc_html($_POST['tel']));
  }
}