<?php

if(!empty($_POST))
{
// echo "<p>".$_POST["RoundID"]."</p>";
print_r(array_values($_POST));
foreach ($_POST as $key)
{
    
    echo "<p>".$key."</p>";
}
}
else
{
    echo "<p>EMPTY!</p>";
}



?>