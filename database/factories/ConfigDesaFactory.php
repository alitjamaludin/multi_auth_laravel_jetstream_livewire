<?php

namespace Database\Factories;

use App\Models\ConfigDesa;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigDesaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConfigDesa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_desa' => 'Sanding',
            'kode_desa' => '12345',
            'nama_kepala_desa' => 'Heri Supriadi, S.Pd',
            'nip_kepala_desa' => '012345',
            'kode_pos' => '44188',
            'nama_kecamatan' => 'Malangbong',
            'kode_kecamatan' => '0012345',
            'nama_kepala_camat' => 'Tatan Burhan',
            'nip_kepala_camat' => '0054321',
            'nama_kabupaten' => 'Garut',
            'kode_kabupaten' => '00012345',
            'nama_provinsi' => 'Jawa barat',
            'kode_provinsi' => '000012345',
            'logo' => '',
            'alamat_kantor' => 'Kp. Sukabatu Desa Sanding Kec. Malangbong Kab. Garut',
            'email_desa' => 'sanding@gmail.com',
            'telepon' => '085123456789',
            'website' => 'www.sanding.go.id',
            'kantor_desa' => '',
        ];
    }
}
