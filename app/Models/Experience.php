<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
        'cta_text',
        'cta_link',
        'created_by', // Add created_by to fillable
    ];

    /**
     * Get the user who created the experience.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
