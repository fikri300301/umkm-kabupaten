<?php

namespace App\Enum;

enum StatusTim: string {
     case Waiting = 'menunggu verifikasi';
     case Failed = 'pendaftaran gagal';
     case Success = 'pendaftaran berhasil';
}
