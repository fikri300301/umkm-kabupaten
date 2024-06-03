<?php

namespace App\Enum;

enum TypeEvent: string {
     case Harian = 'harian';
     case Internal = 'internal';
     case Eksternal = 'eksternal';
}
