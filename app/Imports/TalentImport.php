<?php

namespace App\Imports;

use App\Models\Talent;
use Maatwebsite\Excel\Concerns\ToModel;

class TalentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Talent([
            'name' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'place' => $row[4],
            'date' => $row[5],
            'village_id' => $row[6],
            'instagram' => $row[7],
            'engagement' => $row[8],
            'finstagram' => $row[9],
            'rate_igs' => $row[10],
            'rate_igf' => $row[11],
            'rate_igr' => $row[12],
            'rate_igl' => $row[13],
            'tiktok' => $row[14],
            'ftiktok' => $row[15],
            'rate_ttf' => $row[16],
            'rate_ttl' => $row[17],
            'youtube' => $row[18],
            'syoutube' => $row[19],
            'rate_yt' => $row[20],
            'rate_event' => $row[21],
            'talent_exclusive' => $row[22],
            'staff_id' => $row[23],
            'shopee_affiliate' => $row[24],
            'tiktok_affiliate' => $row[25],
            'mcn_tiktok' => $row[26], 
        ]);
    }
}
