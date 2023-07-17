<?php
    if ($errors->any())
    {
        foreach ($errors->all() as $error)
        {
            alert()->error($error);
        }
    }
?>
