<?php namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/*
 * Simple implementation to partially emulate JSON querying. It will essentially load the .json file to memory and when
 * the function "query" is called, it will retrieve a \Illuminate\Support\Collection with the loaded data.
 */
abstract class JsonModel{

    protected $source = '';
    protected $data;

    protected function getClassName(): string {
        $reflect = new \ReflectionClass(static::class);
        return strtolower(Str::plural($reflect->getShortName()));
    }

    public function __construct(){
        $file_path = storage_path('json'.DIRECTORY_SEPARATOR.($this->source ?: ($this->getClassName() . '.json' )));
        $data = [];
        if(file_exists($file_path)){
            $json = json_decode(file_get_contents($file_path));
            if($json!==null && is_array($json))$data = $json;
        }
        $this->data = collect($data);
    }

    public function query(): Collection {
        return $this->data;
    }

}
