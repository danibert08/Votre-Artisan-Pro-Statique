<?php

 echo'<pre>'; var_dump($_POST); '</pre>';
print_r ($_REQUEST);

/**
 * Undocumented function
 *
 * @param [type] $nb1 true
 * @param [type] $nb2 true
 * @return void
 */
function total($nb1, $nb2){
    echo $nb1+$nb2;
}