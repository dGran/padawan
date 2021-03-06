<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
	protected $fillable = ['name', 'img', 'color', 'slug'];
    public $timestamps = false;

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function img()
    {
        $default = asset('img/platforms/default.png');
        $custom = asset('img/platforms/' . $this->img);

        if ($this->img) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
		return $default;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        $headers = get_headers($image);
        return stripos($headers[0], "200 OK") ? TRUE : FALSE;
    }

    public function color_name() {
        switch ($this->color) {
            case 'yellow':
                return "Amarillo";
                break;
            case 'blue':
                return "Azul";
                break;
            case 'indigo':
                return "Azul Oscuro";
                break;
            case 'gray':
                return "Gris";
                break;
            case 'orange':
                return "Naranja";
                break;
            case 'purple':
                return "Púrpura";
                break;
            case 'red':
                return "Rojo";
                break;
            case 'pink':
                return "Rosa";
                break;
            case 'green':
                return "Verde";
                break;
            case 'teal':
                return "Verde azulado";
                break;
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
