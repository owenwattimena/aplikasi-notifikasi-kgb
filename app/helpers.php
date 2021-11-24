<?php 

function masaBerakhirTMT($date)
{
    $tmtDate = new DateTime($date);
    $today = new DateTime();
    $difference = $today->diff($tmtDate);
    return ($tmtDate < $today) ? '-' . $difference->format("%a") : '' . $difference->format("%a");
}