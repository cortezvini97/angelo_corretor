<?php

function decimal(float $decimal)
{
    return number_format($decimal,2, ",", ".");
}


function inFavorites($url)
{
    if(isset($_SESSION['favorites']))
    {
        if(in_array($url, $_SESSION['favorites']))
        {
            return true;
        }else
        {
            return false;
        }

    }else
    {
        return false;
    }
}

function html($html)
{
    echo $html;
}