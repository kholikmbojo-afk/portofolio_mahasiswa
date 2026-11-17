<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectCollaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'nim',
        'jobdesk',
        'order',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
