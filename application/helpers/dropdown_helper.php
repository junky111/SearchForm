<?php
function dd_list($name = null , $options = null, $default = null ){
    if( !empty( $options ) ) {
        $options = array_merge($default, $options);
    } else {
        $options = $default;
    }
    echo form_dropdown($name, $options, '');
}