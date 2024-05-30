<?php

namespace App\Exports;

use App\Models\Talent;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TalentExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Talent::query();
    }

    public function map($talent): array
    {
        return [
            $talent->id,
            $talent->name,
            $talent->email,
            $talent->phone,
            $talent->place,
            $talent->date,
            $talent->village->province->name,
            $talent->categories->implode('name', ', '),
            $talent->engagement,
            $talent->instagram,
            $talent->tiktok,
            $talent->youtube,
            $talent->finstagram == 0 ? '0' : $talent->finstagram,
            $talent->rate_igs,
            $talent->rate_igf,
            $talent->rate_igr,
            $talent->rate_igl,
            $talent->ftiktok == 0 ? '0' : $talent->ftiktok,
            $talent->rate_ttf,
            $talent->rate_ttl,
            $talent->syoutube == 0 ? '0' : $talent->syoutube,
            $talent->rate_yt,
            $talent->rate_event,
            $talent->talent_exclusive ? 'Ya' : 'Tidak',
            $talent->staff->name,
            $talent->shopee_affiliate ? 'Ya' : 'Tidak',
            $talent->tiktok_affiliate ? 'Ya' : 'Tidak',
            $talent->mcn_tiktok ? 'Ya' : 'Tidak',
            $talent->status ? 'Aktif' : 'Tidak Aktif'
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Talent',
            'Email',
            'Nomor HP',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Domisili',
            'Kategori',
            'Engagement Rate',
            'Instagram',
            'Tiktok',
            'Youtube',
            'Instagram Followers',
            'Rate Instagram Story',
            'Rate Instagram Feed',
            'Rate Instagram Reels',
            'Rate Instagram Live',
            'Tiktok Followers',
            'Rate Tiktok Feed',
            'Rate Tiktok Live',
            'Youtube Subscribers',
            'Rate Youtube',
            'Rate Event Attendance',
            'Talent Exclusive',
            'PIC',
            'Shopee Affiliate',
            'Tiktok Affiliate',
            'MCN TIKTOK',
            'Status'
        ];
    }
}
