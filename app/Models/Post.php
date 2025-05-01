<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','title', 'slug', 'content', 'image', 'published'];
    protected $casts = [
        'published' => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function canDelete(): bool
    {
        return $this->tags()->count() === 0;
    }

    protected static function boot()
    {
        parent::boot();

        // Al actualizar: comparar contenido viejo y nuevo, y eliminar imágenes que ya no se usan
        static::updating(function ($post) {
            self::eliminarImagenesRemovidas($post->getOriginal('content'), $post->content);
        });



        // Al eliminar: borrar la imagen del campo `image` y todas las del RichEditor
        static::deleting(function ($post) {
            if ($post->image && \Storage::disk('public')->exists($post->image)) {
                \Storage::disk('public')->delete($post->image);
            }

            $post->tags()->detach();

            self::eliminarImagenesRemovidas($post->content, '');
        });
    }

    protected static function eliminarImagenesRemovidas(string $contenidoAnterior, string $contenidoNuevo)
    {
        preg_match_all('/storage\/imgcontentarticles\/([a-zA-Z0-9_\-\.]+\.(jpg|jpeg|png|gif|webp|svg))/i', $contenidoAnterior, $imagenesAnteriores);
        preg_match_all('/storage\/imgcontentarticles\/([a-zA-Z0-9_\-\.]+\.(jpg|jpeg|png|gif|webp|svg))/i', $contenidoNuevo, $imagenesActuales);

        $archivosAnteriores = $imagenesAnteriores[1] ?? [];
        $archivosActuales = $imagenesActuales[1] ?? [];

        $archivosAEliminar = array_diff($archivosAnteriores, $archivosActuales);

        foreach ($archivosAEliminar as $archivo) {
            $ruta = 'imgcontentarticles/' . $archivo;
            if (\Storage::disk('public')->exists($ruta)) {
                \Storage::disk('public')->delete($ruta);
            }
        }
    }


}
