// init
add_action('add_meta_boxes','initialisation_metaboxes');
function initialisation_metaboxes(){

}

// add meta box
add_action('add_meta_boxes','initialisation_metaboxes');
function initialisation_metaboxes(){
  //on utilise la fonction add_metabox() pour initialiser une metabox
  add_meta_box('id_ma_meta', 'Ma metabox', 'ma_meta_function', 'post', 'side', 'high');
}

// build meta box
function ma_meta_function(){
  echo '<label for="mon_champ">Mon champ : </label>';
  echo '<input id="mon_champ" type="text" name="mon_champ" />';
}

// build meta box, and get meta
function ma_meta_function($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  $val = get_post_meta($post->ID,'_ma_valeur',true);
  echo '<label for="mon_champ">Mon champ : </label>';
  echo '<input id="mon_champ" type="text" name="mon_champ" value="'.$val.'" />';
}

// save meta box
add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){

}

// save meta box with update
add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){
  // si la metabox est définie, on sauvegarde sa valeur
  if(isset($_POST['mon_champ'])){
    update_post_meta($post_ID,'_ma_valeur', esc_html($_POST['mon_champ']));
  }
}

// get post meta
$val = get_post_meta($post->ID,'_ma_valeur',true);
// $val renverra 'la valeur de mon champ'
$val = get_post_meta($post->ID,'_ma_valeur',false);
// $val renverra array('la valeur de mon champ','la seconde valeur', 'une autre valeur')

// get post meta ordered
//vals correspond au tableau qui nous sera renvoyé
$vals= '';
$sql = "SELECT m.meta_value FROM ".$wpdb->postmeta." m where m.meta_key = '_ma_valeur' and m.post_id = '".$post->ID."' order by m.meta_id";
$results = $wpdb->get_results( $sql );
foreach( $results as $result ){
  $vals[] = $result->meta_value;
}