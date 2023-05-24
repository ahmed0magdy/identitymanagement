<?php

namespace App\Enums;

enum Datatype: string
{

    case string = 'alpha:ascii';
    case numeric = 'numeric';
    case boolean = 'boolean';
    case date = 'date_format:m/d/Y';


}
