add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('url_crea', 'URL du site', 'url_crea', 'portfolio', 'side');
}

function url_crea($post){
  $url = get_post_meta($post->ID,'_url_crea',true);
  echo '<label for="url_meta">URL du site cré :</label>';
  echo '<input id="url_meta" type="url" name="url_site" value="'.$url.'" />';
}

add_action('save_post','save_metabox');
function save_metabox($post_id){
if(isset($_POST['url_site']))
  update_post_meta($post_id, '_url_crea', esc_url($_POST['url_site']));
}