<?php
function truncate(string $texto, int $cantidad) : string
{
    if(strlen($texto) >= $cantidad) {
        return "<span title='$texto'>" . substr($texto, 0, $cantidad) . " ...</span>";
    } else {
        return $texto;
    }
}