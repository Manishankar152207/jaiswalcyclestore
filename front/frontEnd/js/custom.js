

function sorting(cat_id){
    var product_sort_id=jQuery('#product_sort').val();
    window.location.href="http://localhost:1080/jaiswal/front/frontEnd/categorie.php?id="+cat_id+"&sort="+product_sort_id;
}

