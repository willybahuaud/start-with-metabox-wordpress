add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('conditionnement_vin', 'Conditionnements disponnibles pour ce vin', 'conditionnement_vin', 'vins', 'side');
}
// cette fonction me sert à inscrire checked, si jamais la valeur est coché
function check($cible,$test){
  if(in_array($test,$cible)){return 'checked';}
}
function conditionnement_vin($post){
  $cond = get_post_meta($post->ID,'_conditionnement_vin',false);
  echo 'Indiquez la Conditionnements disponibles :';
  echo '<label><input type="checkbox" name="cond[]" value="5" /> Mignonette 5cl</label>';
  echo '<label><input type="checkbox" name="cond[]" value="35" /> Demi-bouteille 35cl</label>';
  echo '<label><input type="checkbox" name="cond[]" value="37" /> Fillette 37.5cl</label>';
  echo '<label><input type="checkbox" name="cond[]" value="50" /> Désirée 50cl</label>';
  echo '<label><input type="checkbox" name="cond[]" value="75" /> Bouteille 75cl</label>';
  echo '<label><input type="checkbox" name="cond[]" value="150" /> Magnum 150cl</label>';
}

add_action('save_post','save_metabox');
function save_metabox($post_id){
  if(isset($_POST['cond'])){
    // je supprime toutes les entrées pour cette meta
    delete_post_meta($post_id, '_conditionnement_vin');
    // et pour chaque conditionnement coché, j'ajoute une metadonnée
    foreach($_POST['cond'] as $c){
      add_post_meta($post_id, '_conditionnement_vin', intval($c) )
    }
  }
}