<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'category_label',
        'project_type',
        'description',
        'tech_stack',
        'demo_url',
        'github_url',
        'youtube_url',
        'drive_url',
        'image_path',
        'status',
        'admin_notes',
        'likes_count',
        'views_count',
        'is_featured',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collaborators()
    {
        return $this->hasMany(ProjectCollaborator::class)->orderBy('order');
    }

    public function isKolaborasi(): bool
    {
        return $this->project_type === 'kolaborasi';
    }

    public function getTechArrayAttribute(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tech_stack));
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image_path)) {
            return null;
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        $cleanPath = ltrim($this->image_path, '/');
        $publicFile = public_path($cleanPath);
        $baseFile = base_path($cleanPath);

        // Pastikan file tersinkronisasi di public/ dan root folder
        if (@file_exists($publicFile) && !@file_exists($baseFile)) {
            @mkdir(dirname($baseFile), 0777, true);
            @copy($publicFile, $baseFile);
        } elseif (@file_exists($baseFile) && !@file_exists($publicFile)) {
            @mkdir(dirname($publicFile), 0777, true);
            @copy($baseFile, $publicFile);
        }

        if (request()->hasHeader('host')) {
            $root = request()->root();
            return rtrim($root, '/') . '/' . $cleanPath;
        }

        return asset($cleanPath);
    }

    public function getCategoryIconAttribute(): string
    {
        return match ($this->category) {
            'desain'    => 'fa-bezier-curve',
            'website'   => 'fa-globe',
            'seni'      => 'fa-palette',
            'fotografi' => 'fa-camera-retro',
            'iot'       => 'fa-microchip',
            'mobile'    => 'fa-mobile-screen',
            'game'      => 'fa-gamepad',
            'riset'     => 'fa-flask',
            default     => 'fa-folder-open',
        };
    }

    public function getCategoryGradientAttribute(): string
    {
        return match ($this->category) {
            'desain'    => 'linear-gradient(135deg, #831843, #500724)',
            'website'   => 'linear-gradient(135deg, #064e3b, #022c22)',
            'seni'      => 'linear-gradient(135deg, #1e3a8a, #172554)',
            'fotografi' => 'linear-gradient(135deg, #374151, #111827)',
            'iot'       => 'linear-gradient(135deg, #701a75, #4a044e)',
            'mobile'    => 'linear-gradient(135deg, #854d0e, #713f12)',
            'game'      => 'linear-gradient(135deg, #1e1b4b, #0f172a)',
            'riset'     => 'linear-gradient(135deg, #134e4a, #042f2e)',
            default     => 'linear-gradient(135deg, #1e293b, #0f172a)',
        };
    }
}
