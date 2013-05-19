add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('dispo_produit', 'Disponibilité du produit', 'dispo_produit', 'produit', 'side');
}

function dispo_produit($post){
  $dispo = get_post_meta($post->ID,'_dispo_produit',true);
  echo '<label for="dispo_meta">Indiquez la disponibilité du produit :</label>';
  echo '<select name="dispo_produit">';
  echo '<option ' . selected( 'dispo', $dispo, false ) . ' value="dispo">En stock</option>';
  echo '<option ' . selected( 'encours', $dispo, false ) . ' value="encours">En cours d\'approvisionnement</option>';
  echo '<option ' . selected( 'indispo', $dispo, false ) . ' value="indispo">En rupture</option>';
  echo '</select>';

}

add_action('save_post','save_metabox');
function save_metabox($post_id){
if(isset($_POST['dispo_produit']))
  update_post_meta($post_id, '_dispo_produit', $_POST['dispo_produit']);
}