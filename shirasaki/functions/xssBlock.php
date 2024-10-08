
<?php
function str2html(String $string) :string{
            return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
        }