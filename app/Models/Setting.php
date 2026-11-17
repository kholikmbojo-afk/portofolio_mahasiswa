<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Ambil nilai setting berdasarkan key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting !== null ? $setting->value : $default;
    }

    /**
     * Simpan atau update nilai setting
     */
    public static function set(string $key, $value, ?string $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => (string) $value,
                'description' => $description ?? ($key === 'auto_review' ? 'Status Mode Review Otomatis' : null),
            ]
        );
    }

    /**
     * Cek apakah Review Otomatis sedang aktif
     */
    public static function isAutoReviewEnabled(): bool
    {
        return static::get('auto_review', '0') === '1';
    }
}
