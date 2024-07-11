<?php 
namespace App\Service;

Class FormatDate
{

    function __construct()
    {
        
    }

    function formatDateInFrench($date)
    {
      
        $englishMonths = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
    
        $frenchMonths = [
            'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin',
            'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'
        ];

       $formattedDate = $date->format('d M, Y');

       return $formattedDate ;str_replace($englishMonths, $frenchMonths,$formattedDate);

    }



}